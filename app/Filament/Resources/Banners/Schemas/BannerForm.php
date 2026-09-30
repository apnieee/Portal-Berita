<?php

namespace App\Filament\Resources\Banners\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class BannerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('id_berita')
                    ->label('Berita')
                    ->relationship('berita', 'judul')
                    ->searchable()
                    ->preload()
                    ->required(),

                FileUpload::make('gambar')
                    ->label('Gambar Banner')
                    ->image()
                    ->disk('public')
                    ->directory('banner')
                    ->required(),

                Select::make('status')
                    ->label('Status')
                    ->options([
                        1 => 'Aktif',
                        0 => 'Nonaktif',
                    ])
                    ->default(1)
                    ->required(),
            ]);
    }
}