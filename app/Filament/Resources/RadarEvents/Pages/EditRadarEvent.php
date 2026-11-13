<?php

namespace App\Filament\Resources\RadarEvents\Pages;

use App\Filament\Resources\RadarEvents\RadarEventResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditRadarEvent extends EditRecord
{
    protected static string $resource = RadarEventResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
