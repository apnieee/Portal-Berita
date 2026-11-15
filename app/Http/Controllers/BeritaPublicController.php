<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Berita;
use App\Models\Kategori;
use App\Models\User;
use App\Models\AuthorApplication;
use App\Models\RadarEvent;
use Illuminate\Http\Request;

class BeritaPublicController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->query('q');
        $idKategori = $request->query('kategori');

        $beritas = Berita::with(['kategoris', 'user'])
            ->published()
            ->search($keyword)
            ->when($idKategori, fn ($q) => $q->whereHas(
                'kategoris',
                fn ($kategoriQuery) => $kategoriQuery->where(
                    'kategori.id_kategori',
                    $idKategori
                )
            ))
            ->latest('tanggal')
            ->paginate(9)
            ->withQueryString();

        $kategoris = Kategori::orderBy('nama_kategori')->get();

        $banners = Banner::where('status', 1)
            ->orderBy('id_banner', 'desc')
            ->get();

        $featured = Berita::published()
            ->where('featured', true)
            ->latest('tanggal')
            ->take(5)
            ->get();

        $radarEvents = RadarEvent::where('is_published', true)
            ->whereDate('tanggal_event', '>=', now()->toDateString())
            ->orderBy('tanggal_event', 'asc')
            ->take(5)
            ->get();

        $behindStories = Berita::with(['kategoris', 'user'])
            ->published()
            ->whereHas('kategoris', function ($query) {
                $query->where('nama_kategori', 'Behind the Story');
            })
            ->latest('tanggal')
            ->take(3)
            ->get();

        // Menampilkan semua akun dengan role author
        $featuredAuthors = User::where('role', 'author')
            ->orderBy('nama')
            ->get();

        $myAuthorApplication = $request->user()
            ? AuthorApplication::where(
                'id_user',
                $request->user()->id_user
            )->first()
            : null;

        return view('berita.index', compact(
            'beritas',
            'kategoris',
            'banners',
            'featured',
            'featuredAuthors',
            'myAuthorApplication',
            'keyword',
            'radarEvents',
            'idKategori',
            'behindStories'
        ));
    }

    public function show(Berita $berita)
    {
        abort_unless($berita->status === 'published', 404);

        $berita->increment('views');

        $terkait = Berita::with('kategoris')
            ->published()
            ->whereHas('kategoris', function ($query) use ($berita) {
                $query->whereIn(
                    'kategori.id_kategori',
                    $berita->kategoris()->pluck('kategori.id_kategori')
                );
            })
            ->where('id_berita', '!=', $berita->id_berita)
            ->take(4)
            ->get();

        return view('berita.show', compact('berita', 'terkait'));
    }
}