<?php

namespace App\Filament\Resources\DictionaryTerms\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class DictionaryTermForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('term')
                    ->label('Istilah')
                    ->required()
                    ->maxLength(255),

                TextInput::make('slug')
                    ->label('Slug')
                    ->helperText('Kosongkan untuk membuat slug otomatis dari istilah.')
                    ->unique(ignoreRecord: true),

                Select::make('category')
                    ->label('Kategori')
                    ->options([
                        'Music' => 'Music',
                        'Fandom' => 'Fandom',
                        'Industry' => 'Industry',
                        'Performance' => 'Performance',
                        'Merchandise' => 'Merchandise',
                    ])
                    ->searchable(),

                Textarea::make('meaning')
                    ->label('Pengertian')
                    ->required()
                    ->rows(4)
                    ->columnSpanFull(),

                Textarea::make('example')
                    ->label('Contoh Penggunaan')
                    ->rows(3)
                    ->columnSpanFull(),

                Toggle::make('is_published')
                    ->label('Publikasikan')
                    ->default(false),
            ]);
    }
}
