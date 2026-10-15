<?php

namespace App\Filament\Resources\AuthorApplications\Pages;

use App\Filament\Resources\AuthorApplications\AuthorApplicationResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAuthorApplication extends EditRecord
{
    protected static string $resource = AuthorApplicationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
