<?php

namespace App\Filament\Author\Resources\AuthorBeritas\Pages;

use App\Filament\Author\Resources\AuthorBeritas\AuthorBeritaResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateAuthorBerita extends CreateRecord
{
    protected static string $resource = AuthorBeritaResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['id_user'] = Auth::id();

        return $data;
    }
}