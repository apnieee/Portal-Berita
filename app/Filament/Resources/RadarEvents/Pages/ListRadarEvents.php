<?php

namespace App\Filament\Resources\RadarEvents\Pages;

use App\Filament\Resources\RadarEvents\RadarEventResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListRadarEvents extends ListRecords
{
    protected static string $resource = RadarEventResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
