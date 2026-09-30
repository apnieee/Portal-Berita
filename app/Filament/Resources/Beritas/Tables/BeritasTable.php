<?php

namespace App\Filament\Resources\Beritas\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Table;

class BeritasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('kategori.nama_kategori')
                    ->label('Kategori'),
                TextColumn::make('user.nama')
                    ->label('Penulis'),
                TextColumn::make('judul')
                    ->searchable(),
                ImageColumn::make('gambar')
                    ->label('Gambar'),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge(),
                TextColumn::make('views')
                    ->numeric()
                    ->sortable(),
                IconColumn::make('featured')
                    ->label('Featured')
                    ->boolean()
                    ->sortable(),
                TextColumn::make('tanggal')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
