<?php

namespace App\Filament\Resources\AuthorApplications\Tables;

use App\Models\User;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\DB;

class AuthorApplicationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.nama')
                    ->label('Nama Pendaftar')
                    ->searchable(),

                TextColumn::make('user.email')
                    ->label('Email')
                    ->searchable(),

                TextColumn::make('alasan')
                    ->label('Alasan Bergabung')
                    ->limit(60)
                    ->wrap(),

                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'approved' => 'success',
                        'rejected' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pending' => 'Menunggu',
                        'approved' => 'Disetujui',
                        'rejected' => 'Ditolak',
                        default => $state,
                    }),

                TextColumn::make('catatan_admin')
                    ->label('Catatan Admin')
                    ->limit(40)
                    ->placeholder('Belum ada'),

                TextColumn::make('created_at')
                    ->label('Tanggal Pengajuan')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
            ])
            ->recordActions([
                Action::make('setujui')
                    ->label('Setujui')
                    ->color('success')
                    ->requiresConfirmation()
                    ->visible(fn ($record): bool => $record->status === 'pending')
                    ->action(function ($record): void {
                        DB::transaction(function () use ($record): void {
                            $application = $record->newQuery()
                                ->lockForUpdate()
                                ->findOrFail($record->getKey());

                            if ($application->status !== 'pending') {
                                return;
                            }

                            User::where('id_user', $application->id_user)
                                ->update(['role' => 'author']);

                            $application->update([
                                'status' => 'approved',
                                'catatan_admin' => null,
                            ]);
                        });

                        Notification::make()
                            ->title('Pengajuan disetujui')
                            ->success()
                            ->send();
                    }),

                Action::make('tolak')
                    ->label('Tolak')
                    ->color('danger')
                    ->form([
                        Textarea::make('catatan_admin')
                            ->label('Alasan penolakan')
                            ->required()
                            ->minLength(5)
                            ->maxLength(1000),
                    ])
                    ->visible(fn ($record): bool => $record->status === 'pending')
                    ->action(function ($record, array $data): void {
                        if ($record->status !== 'pending') {
                            return;
                        }

                        $record->update([
                            'status' => 'rejected',
                            'catatan_admin' => $data['catatan_admin'],
                        ]);

                        Notification::make()
                            ->title('Pengajuan ditolak')
                            ->success()
                            ->send();
                    }),

                EditAction::make()
                    ->label('Detail'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}