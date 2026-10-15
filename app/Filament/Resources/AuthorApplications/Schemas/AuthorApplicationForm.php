<?php

namespace App\Filament\Resources\AuthorApplications\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class AuthorApplicationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('id_user')
                    ->required()
                    ->numeric(),
                Textarea::make('alasan')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('status')
                    ->required()
                    ->default('pending'),
                Textarea::make('catatan_admin')
                    ->columnSpanFull(),
            ]);
    }
}
