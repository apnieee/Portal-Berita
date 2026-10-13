<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('profile.edit', [
            'user' => auth()->user(),
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
        ]);

        $user->update($validated);

        return redirect()
            ->route('profile.edit')
            ->with('success', 'Profil berhasil diperbarui!');
    }
}