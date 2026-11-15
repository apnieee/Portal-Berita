<?php

namespace App\Filament\Resources\DictionaryTerms;

use App\Filament\Resources\DictionaryTerms\Pages\CreateDictionaryTerm;
use App\Filament\Resources\DictionaryTerms\Pages\EditDictionaryTerm;
use App\Filament\Resources\DictionaryTerms\Pages\ListDictionaryTerms;
use App\Filament\Resources\DictionaryTerms\Schemas\DictionaryTermForm;
use App\Filament\Resources\DictionaryTerms\Tables\DictionaryTermsTable;
use App\Models\DictionaryTerm;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class DictionaryTermResource extends Resource
{
    protected static ?string $model = DictionaryTerm::class;
    
    protected static ?string $navigationLabel = 'Kamus K-Pop';

    protected static ?string $modelLabel = 'Istilah';

    protected static ?string $pluralModelLabel = 'Daftar Istilah';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBookOpen;

    protected static ?string $recordTitleAttribute = 'term';

    public static function form(Schema $schema): Schema
    {
        return DictionaryTermForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DictionaryTermsTable::configure($table);
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
            'index' => ListDictionaryTerms::route('/'),
            'create' => CreateDictionaryTerm::route('/create'),
            'edit' => EditDictionaryTerm::route('/{record}/edit'),
        ];
    }
}
