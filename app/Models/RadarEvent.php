<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RadarEvent extends Model
{
    protected $table = 'radar_events';

    protected $fillable = [
        'nama_event',
        'artis_grup',
        'jenis_event',
        'tanggal_event',
        'lokasi',
        'deskripsi',
        'is_published',
    ];

    protected $casts = [
        'tanggal_event' => 'date',
        'is_published' => 'boolean',
    ];
}