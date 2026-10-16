<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Berita;
use App\Models\Kategori;
use App\Models\User;
use App\Models\AuthorApplication;
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
                fn ($kategoriQuery) => $kategoriQuery->where('kategori.id_kategori', $idKategori)
            ))
            ->latest('tanggal')
            ->paginate(9)
            ->withQueryString();

        $kategoris = Kategori::orderBy('nama_kategori')->get();
        $banners = Banner::where('status', 1)->orderBy('id_banner', 'desc')->get();
        $featured = Berita::published()->where('featured', true)->latest('tanggal')->take(5)->get();
        $featuredAuthors = User::where('role', 'author')->where('tampil_di_beranda', true)->orderBy('nama')->get();
        $myAuthorApplication = $request->user()? AuthorApplication::where('id_user', $request->user()->id_user)->first(): null;

        return view('berita.index', compact('beritas', 'kategoris', 'banners', 'featured','featuredAuthors','myAuthorApplication', 'keyword', 'idKategori'));
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
