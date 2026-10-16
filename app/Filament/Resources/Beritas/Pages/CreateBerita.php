<?php

namespace App\Filament\Resources\Beritas\Pages;

use App\Filament\Resources\Beritas\BeritaResource;
use Filament\Resources\Pages\CreateRecord;

class CreateBerita extends CreateRecord
{
    protected static string $resource = BeritaResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $kategoriIds = $this->data['kategoris'] ?? [];

        if (empty($kategoriIds)) {
            throw new \RuntimeException('Pilih minimal satu kategori berita.');
        }

        $data['id_kategori'] = $kategoriIds[0];

        return $data;
    }
}

