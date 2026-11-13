<?php

namespace App\Filament\Resources\RadarEvents\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class RadarEventForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama_event')
                    ->label('Nama Event')
                    ->required()
                    ->maxLength(255),

                TextInput::make('artis_grup')
                    ->label('Artis / Grup')
                    ->required()
                    ->maxLength(255),

                Select::make('jenis_event')
                    ->label('Jenis Event')
                    ->options([
                        'comeback' => 'Comeback',
                        'debut' => 'Debut',
                        'concert' => 'Konser',
                        'fanmeeting' => 'Fan Meeting',
                        'other' => 'Lainnya',
                    ])
                    ->required(),

                DatePicker::make('tanggal_event')
                    ->label('Tanggal Event')
                    ->required(),

                TextInput::make('lokasi')
                    ->label('Lokasi')
                    ->maxLength(255),

                Textarea::make('deskripsi')
                    ->label('Deskripsi')
                    ->rows(4)
                    ->columnSpanFull(),

                Toggle::make('is_published')
                    ->label('Publikasikan Event')
                    ->default(false),
            ]);
    }
}