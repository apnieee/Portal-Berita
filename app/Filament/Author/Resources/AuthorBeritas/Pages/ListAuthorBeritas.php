<?php

namespace App\Filament\Author\Resources\AuthorBeritas\Pages;

use App\Filament\Author\Resources\AuthorBeritas\AuthorBeritaResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAuthorBeritas extends ListRecords
{
    protected static string $resource = AuthorBeritaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
