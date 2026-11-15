<?php

namespace App\Filament\Resources\DictionaryTerms\Pages;

use App\Filament\Resources\DictionaryTerms\DictionaryTermResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDictionaryTerms extends ListRecords
{
    protected static string $resource = DictionaryTermResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
