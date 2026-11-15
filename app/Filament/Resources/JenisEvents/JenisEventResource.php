<?php

namespace App\Filament\Resources\JenisEvents;

use App\Filament\Resources\JenisEvents\Pages\CreateJenisEvent;
use App\Filament\Resources\JenisEvents\Pages\EditJenisEvent;
use App\Filament\Resources\JenisEvents\Pages\ListJenisEvents;
use App\Filament\Resources\JenisEvents\Schemas\JenisEventForm;
use App\Filament\Resources\JenisEvents\Tables\JenisEventsTable;
use App\Models\JenisEvent;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class JenisEventResource extends Resource
{
    protected static ?string $model = JenisEvent::class;

    protected static ?string $navigationLabel = 'Jenis Event';

    protected static ?string $modelLabel = 'Jenis Event';

    protected static ?string $pluralModelLabel = 'Jenis Event';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedTag;

    protected static ?string $recordTitleAttribute = 'nama_jenis';

    public static function form(Schema $schema): Schema
    {
        return JenisEventForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return JenisEventsTable::configure($table);
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
            'index' => ListJenisEvents::route('/'),
            'create' => CreateJenisEvent::route('/create'),
            'edit' => EditJenisEvent::route('/{record}/edit'),
        ];
    }
}
