<?php

namespace App\Filament\Author\Resources\AuthorBeritas\Pages;

use App\Filament\Author\Resources\AuthorBeritas\AuthorBeritaResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAuthorBerita extends EditRecord
{
    protected static string $resource = AuthorBeritaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
