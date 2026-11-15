<?php

namespace App\Filament\Resources\JenisEvents\Pages;

use App\Filament\Resources\JenisEvents\JenisEventResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditJenisEvent extends EditRecord
{
    protected static string $resource = JenisEventResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
