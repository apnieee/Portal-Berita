<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\HasName;

class User extends Authenticatable implements HasName
{
    use HasFactory, Notifiable;

    protected $table = 'user';
    protected $primaryKey = 'id_user';

    public $timestamps = false;

    protected $fillable = [
        'nama',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
    ];

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function getFilamentName(): string
    {
        return $this->nama;
    }

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
}   