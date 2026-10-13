<?php
namespace App\Http\Controllers;

use App\Models\AuthorApplication;
use Illuminate\Http\Request;

class AuthorApplicationController extends Controller
{
    public function store(Request $request)
    {
        $user = $request->user();

        if ($user->role !== 'user') {
            abort(403, 'Akun ini tidak bisa mengajukan menjadi author.');
        }

        $existingApplication = AuthorApplication::where(
            'id_user',
            $user->id_user
        )->first();

        if ($existingApplication) {
            return back()->with(
                'error',
                'Kamu sudah pernah mengajukan menjadi author.'
            );
        }

        $validated = $request->validate([
            'alasan' => ['required', 'string', 'min:20', 'max:2000'],
        ]);

        AuthorApplication::create([
            'id_user' => $user->id_user,
            'alasan' => $validated['alasan'],
            'status' => 'pending',
        ]);

        return back()->with(
            'success',
            'Pengajuan berhasil dikirim! Tunggu keputusan admin, ya.'
        );
    }
}
