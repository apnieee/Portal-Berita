<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->query('q');

        $beritas = Berita::with(['kategoris', 'user'])
            ->search($keyword)
            ->latest('tanggal')
            ->paginate(10)
            ->withQueryString();

        return view('admin.berita.index', compact('beritas', 'keyword'));
    }

    public function create()
    {
        $kategoris = Kategori::orderBy('nama_kategori')->get();

        return view('admin.berita.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategoris' => ['required', 'array', 'min:1'],
            'kategoris.*' => ['required', 'integer', 'distinct', 'exists:kategori,id_kategori'],
            'judul' => ['required', 'string', 'max:255'],
            'isi' => ['required', 'string'],
            'gambar' => ['nullable', 'image', 'max:2048'],
            'status' => ['required', 'in:draft,published'],
            'featured' => ['nullable', 'boolean'],
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('berita', 'public');
        }

        $kategoriIds = $validated['kategoris'];
        unset($validated['kategoris']);

        $validated['id_kategori'] = $kategoriIds[0];
        $validated['id_user'] = $request->user()->id_user;
        $validated['featured'] = $request->boolean('featured');
        $validated['tanggal'] = now();

        $berita = Berita::create($validated);
        $berita->kategoris()->sync($kategoriIds);

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil ditambahkan.');
    }

    public function edit(Berita $berita)
    {
        $kategoris = Kategori::orderBy('nama_kategori')->get();

        $berita->load('kategoris');

        return view('admin.berita.edit', compact('berita', 'kategoris'));
    }

    public function update(Request $request, Berita $berita)
    {
        $validated = $request->validate([
            'kategoris' => ['required', 'array', 'min:1'],
            'kategoris.*' => ['required', 'integer', 'distinct', 'exists:kategori,id_kategori'],
            'judul' => ['required', 'string', 'max:255'],
            'isi' => ['required', 'string'],
            'gambar' => ['nullable', 'image', 'max:2048'],
            'status' => ['required', 'in:draft,published'],
            'featured' => ['nullable', 'boolean'],
        ]);

        if ($request->hasFile('gambar')) {
            if ($berita->gambar) {
                Storage::disk('public')->delete($berita->gambar);
            }

            $validated['gambar'] = $request->file('gambar')->store('berita', 'public');
        }

        $kategoriIds = $validated['kategoris'];
        unset($validated['kategoris']);

        $validated['id_kategori'] = $kategoriIds[0];
        $validated['featured'] = $request->boolean('featured');

        $berita->update($validated);
        $berita->kategoris()->sync($kategoriIds);

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(Berita $berita)
    {
        if ($berita->gambar) {
            Storage::disk('public')->delete($berita->gambar);
        }

        $berita->delete();

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil dihapus.');
    }
}
