<?php

namespace App\Filament\Resources\JenisEvents\Pages;

use App\Filament\Resources\JenisEvents\JenisEventResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListJenisEvents extends ListRecords
{
    protected static string $resource = JenisEventResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
