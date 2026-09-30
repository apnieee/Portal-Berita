<?php

namespace App\Filament\Resources\Beritas\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class BeritaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('id_kategori')
                    ->label('Kategori')
                    ->relationship('kategori', 'nama_kategori')
                    ->required(),
                Select::make('id_user')
                    ->label('Penulis')
                    ->relationship('user', 'nama')
                    ->required(),
                TextInput::make('judul')
                    ->required(),
                Textarea::make('isi')
                    ->required()
                    ->columnSpanFull(),
                FileUpload::make('gambar')
                    ->image()
                    ->label('Gambar')
                    ->disk('public')
                    ->directory('berita'),
                Select::make('status')
                    ->label('Status')
                    ->options([
                        'published' => 'Published',
                        'draft' => 'Draft',
                    ])
                    ->default('draft')
                    ->required(),
                TextInput::make('views')
                    ->label('Views')
                    ->numeric()
                    ->default(0)
                    ->disabled(),
                Toggle::make('featured')
                    ->label('Featured')
                    ->default(false),
                DateTimePicker::make('tanggal')
                    ->label('Tanggal Terbit')
                    ->default(now())
                    ->required(),
            ]);
    }
}
