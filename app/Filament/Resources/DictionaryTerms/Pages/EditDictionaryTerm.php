<?php

namespace App\Filament\Resources\DictionaryTerms\Pages;

use App\Filament\Resources\DictionaryTerms\DictionaryTermResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditDictionaryTerm extends EditRecord
{
    protected static string $resource = DictionaryTermResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
