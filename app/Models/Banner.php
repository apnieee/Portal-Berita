<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $table = 'banner';
    protected $primaryKey = 'id_banner';

    public $timestamps = false;

    protected $fillable = [
        'id_berita',
        'gambar',
        'status',
    ];

    public function berita()
    {
        return $this->belongsTo(
            Berita::class,
            'id_berita',
            'id_berita'
        );
    }
}