<?php

namespace App\Filament\Resources\JenisEvents\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class JenisEventForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama_jenis')
                    ->label('Nama Jenis Event')
                    ->placeholder('Contoh: Award Show')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),
            ]);
    }
}