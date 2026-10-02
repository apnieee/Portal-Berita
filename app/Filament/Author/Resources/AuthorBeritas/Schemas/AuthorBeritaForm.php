<?php

namespace App\Filament\Author\Resources\AuthorBeritas\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class AuthorBeritaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('id_kategori')
                    ->label('Kategori')
                    ->relationship('kategori', 'nama_kategori')
                    ->searchable()
                    ->preload()
                    ->required(),

                TextInput::make('judul')
                    ->label('Judul')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),

                RichEditor::make('isi')
                    ->label('Isi Berita')
                    ->required()
                    ->columnSpanFull()
                    ->toolbarButtons([
                        'bold',
                        'italic',
                        'underline',
                        'strike',
                        'h2',
                        'h3',
                        'bulletList',
                        'orderedList',
                        'blockquote',
                        'link',
                        'attachFiles',
                        'undo',
                        'redo',
                    ])
                    ->fileAttachmentsDisk('public')
                    ->fileAttachmentsDirectory('berita/content'),

                FileUpload::make('gambar')
                    ->label('Gambar')
                    ->image()
                    ->disk('public')
                    ->directory('berita'),

                Select::make('status')
                    ->label('Status')
                    ->options([
                        'draft' => 'Draft',
                    ])
                    ->default('draft')
                    ->disabled()
                    ->dehydrated(),

                TextInput::make('views')
                    ->label('Views')
                    ->numeric()
                    ->default(0)
                    ->disabled()
                    ->dehydrated(),

                Toggle::make('featured')
                    ->label('Featured')
                    ->default(false)
                    ->disabled()
                    ->dehydrated(),

                DateTimePicker::make('tanggal')
                    ->label('Tanggal')
                    ->default(now())
                    ->required(),
            ]);
    }
}