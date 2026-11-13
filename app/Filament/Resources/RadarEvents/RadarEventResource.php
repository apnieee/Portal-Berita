<?php

namespace App\Filament\Resources\RadarEvents;

use App\Filament\Resources\RadarEvents\Pages\CreateRadarEvent;
use App\Filament\Resources\RadarEvents\Pages\EditRadarEvent;
use App\Filament\Resources\RadarEvents\Pages\ListRadarEvents;
use App\Filament\Resources\RadarEvents\Schemas\RadarEventForm;
use App\Filament\Resources\RadarEvents\Tables\RadarEventsTable;
use App\Models\RadarEvent;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class RadarEventResource extends Resource
{
    protected static ?string $model = RadarEvent::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'nama_event';

    public static function form(Schema $schema): Schema
    {
        return RadarEventForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RadarEventsTable::configure($table);
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
            'index' => ListRadarEvents::route('/'),
            'create' => CreateRadarEvent::route('/create'),
            'edit' => EditRadarEvent::route('/{record}/edit'),
        ];
    }
}
