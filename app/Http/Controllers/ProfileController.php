<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\AuthorApplication;
use App\Models\User;
use App\Models\Berita;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = auth()->user();

        $authorApplication = AuthorApplication::where(
            'id_user',
            $user->id_user
        )->first();

        return view('profile.edit', [
            'user' => $user,
            'authorApplication' => $authorApplication,
        ]);
    }

    public function update(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:100'],
            'email' => [
                'required',
                'email',
                'max:100',
                Rule::unique('user', 'email')->ignore($user->id_user, 'id_user'),
            ],
            'foto_profil' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
            'bio' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ]);

        if ($request->hasFile('foto_profil')) {
            $path = $request->file('foto_profil')
                ->store('foto-profil', 'public');

            if ($user->foto_profil) {
                Storage::disk('public')->delete($user->foto_profil);
            }

            $validated['foto_profil'] = $path;
        }

        $user->update($validated);

        return redirect()
            ->route('profile.edit')
            ->with('success', 'Profil berhasil diperbarui!');
    }

    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'string', 'min:8', 'confirmed', 'different:current_password'],
        ], [
            'current_password.current_password' => 'Kata sandi lama tidak sesuai.',
            'password.min' => 'Kata sandi baru minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi baru tidak cocok.',
            'password.different' => 'Kata sandi baru harus berbeda dari kata sandi lama.',
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()
            ->route('profile.edit')
            ->with('password_success', 'Kata sandi berhasil diperbarui!');
    }

    public function showAuthor($id)
    {
        $author = User::where('id_user', $id)
            ->where('role', 'author')
            ->firstOrFail();

        $beritas = Berita::with('kategoris')
            ->published()
            ->where('id_user', $author->id_user)
            ->latest('tanggal')
            ->paginate(9);

        $totalBerita = Berita::published()
            ->where('id_user', $author->id_user)
            ->count();

        return view('profile.author', compact(
            'author',
            'beritas',
            'totalBerita'
        ));
    }
}