<?php

namespace App\Filament\Resources\AuthorApplications\Pages;

use App\Filament\Resources\AuthorApplications\AuthorApplicationResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAuthorApplications extends ListRecords
{
    protected static string $resource = AuthorApplicationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
