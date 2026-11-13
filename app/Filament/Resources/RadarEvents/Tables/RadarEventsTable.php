<?php

namespace App\Filament\Resources\RadarEvents\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class RadarEventsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_event')
                    ->label('Nama Event')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('artis_grup')
                    ->label('Artis / Grup')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('jenis_event')
                    ->label('Jenis Event')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'comeback' => 'Comeback',
                        'debut' => 'Debut',
                        'concert' => 'Konser',
                        'fanmeeting' => 'Fan Meeting',
                        default => 'Lainnya',
                    }),

                TextColumn::make('tanggal_event')
                    ->label('Tanggal')
                    ->date('d M Y')
                    ->sortable(),

                TextColumn::make('lokasi')
                    ->label('Lokasi')
                    ->placeholder('-')
                    ->searchable(),

                IconColumn::make('is_published')
                    ->label('Publikasi')
                    ->boolean(),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('tanggal_event', 'asc')
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