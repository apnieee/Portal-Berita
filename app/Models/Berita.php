<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Berita extends Model
{
    protected $table = 'berita';
    protected $primaryKey = 'id_berita';

    public $timestamps = false;

    protected $fillable = [
        'id_kategori',
        'id_user',
        'judul',
        'isi',
        'gambar',
        'status',
        'views',
        'featured',
        'tanggal',
    ];

    protected $casts = [
        'featured' => 'boolean',
        'tanggal' => 'datetime',
    ];

    public function kategori()
    {
        return $this->belongsTo(
            Kategori::class,
            'id_kategori',
            'id_kategori'
        );
    }

    public function user()
    {
        return $this->belongsTo(
            User::class,
            'id_user',
            'id_user'
        );
    }

    // Scope pencarian judul & isi berita
    public function scopeSearch(Builder $query, ?string $keyword): Builder
    {
        if (!$keyword) {
            return $query;
        }

        return $query->where(function (Builder $q) use ($keyword) {
            $q->where('judul', 'like', "%{$keyword}%")
              ->orWhere('isi', 'like', "%{$keyword}%");
        });
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published');
    }
}