<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Berita;
use App\Models\Kategori;
use Illuminate\Http\Request;

class BeritaPublicController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->query('q');
        $idKategori = $request->query('kategori');

        $beritas = Berita::with(['kategori', 'user'])
            ->published()
            ->search($keyword)
            ->when($idKategori, fn ($q) => $q->where('id_kategori', $idKategori))
            ->latest('tanggal')
            ->paginate(9)
            ->withQueryString();

        $kategoris = Kategori::orderBy('nama_kategori')->get();
        $banners = Banner::where('status', 1)->orderBy('id_banner', 'desc')->get();
        $featured = Berita::published()->where('featured', true)->latest('tanggal')->take(5)->get();

        return view('berita.index', compact('beritas', 'kategoris', 'banners', 'featured', 'keyword', 'idKategori'));
    }

    public function show(Berita $berita)
    {
        abort_unless($berita->status === 'published', 404);

        $berita->increment('views');

        $terkait = Berita::published()
            ->where('id_kategori', $berita->id_kategori)
            ->where('id_berita', '!=', $berita->id_berita)
            ->take(4)
            ->get();

        return view('berita.show', compact('berita', 'terkait'));
    }
}
