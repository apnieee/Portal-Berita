<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisEvent extends Model
{
    protected $table = 'jenis_events';

    protected $fillable = [
        'nama_jenis',
    ];
}