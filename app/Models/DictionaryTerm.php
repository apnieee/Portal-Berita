<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class DictionaryTerm extends Model
{
    protected $fillable = [
        'term',
        'slug',
        'category',
        'meaning',
        'example',
        'is_published',
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::creating(function ($dictionaryTerm) {
            if (empty($dictionaryTerm->slug)) {
                $dictionaryTerm->slug = Str::slug($dictionaryTerm->term);
            }
        });
    }
}