<?php

namespace App\Filament\Author\Resources\AuthorBeritas;

use App\Filament\Author\Resources\AuthorBeritas\Pages\CreateAuthorBerita;
use App\Filament\Author\Resources\AuthorBeritas\Pages\EditAuthorBerita;
use App\Filament\Author\Resources\AuthorBeritas\Pages\ListAuthorBeritas;
use App\Filament\Author\Resources\AuthorBeritas\Schemas\AuthorBeritaForm;
use App\Filament\Author\Resources\AuthorBeritas\Tables\AuthorBeritasTable;
use App\Models\AuthorBerita;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AuthorBeritaResource extends Resource
{
    protected static ?string $model = AuthorBerita::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'judul';

    public static function form(Schema $schema): Schema
    {
        return AuthorBeritaForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AuthorBeritasTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAuthorBeritas::route('/'),
            'create' => CreateAuthorBerita::route('/create'),
            'edit' => EditAuthorBerita::route('/{record}/edit'),
        ];
    }
}
