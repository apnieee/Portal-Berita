<?php

namespace App\Filament\Resources\Beritas\Pages;

use App\Filament\Resources\Beritas\BeritaResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditBerita extends EditRecord
{
    protected static string $resource = BeritaResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $kategoriIds = $this->data['kategoris'] ?? [];

        if (! empty($kategoriIds)) {
            $data['id_kategori'] = $kategoriIds[0];
        }

        return $data;
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}

