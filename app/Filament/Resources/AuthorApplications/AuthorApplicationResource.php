<?php

namespace App\Filament\Resources\AuthorApplications;

use App\Filament\Resources\AuthorApplications\Pages\CreateAuthorApplication;
use App\Filament\Resources\AuthorApplications\Pages\EditAuthorApplication;
use App\Filament\Resources\AuthorApplications\Pages\ListAuthorApplications;
use App\Filament\Resources\AuthorApplications\Schemas\AuthorApplicationForm;
use App\Filament\Resources\AuthorApplications\Tables\AuthorApplicationsTable;
use App\Models\AuthorApplication;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AuthorApplicationResource extends Resource
{
    protected static ?string $model = AuthorApplication::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUserGroup;
    protected static ?string $recordTitleAttribute = 'id';

    public static function getNavigationLabel(): string
    {
        return 'Pengajuan Author';
    }

    public static function getModelLabel(): string
    {
        return 'Pengajuan Author';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Pengajuan Author';
    }

    public static function form(Schema $schema): Schema
    {
        return AuthorApplicationForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AuthorApplicationsTable::configure($table);
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
            'index' => ListAuthorApplications::route('/'),
            'create' => CreateAuthorApplication::route('/create'),
            'edit' => EditAuthorApplication::route('/{record}/edit'),
        ];
    }
}
