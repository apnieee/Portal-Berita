<?php

namespace App\Filament\Author\Pages;

use App\Models\User;
use Filament\Pages\Page;
use Filament\Schemas\Schema;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Illuminate\Validation\Rule;

class EditProfil extends Page implements HasSchemas
{
    use InteractsWithSchemas;

    protected string $view = 'filament.author.pages.edit-profil';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill(auth()->user()->only([
            'nama',
            'email',
            'foto_profil',
            'bio',
        ]));
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama')
                    ->label('Nama')
                    ->required(),

                TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->required()
                    ->unique(
                        table: 'user',
                        column: 'email',
                        ignorable: auth()->user(),
                    ),

                FileUpload::make('foto_profil')
                    ->label('Foto Profil')
                    ->image()
                    ->disk('public')
                    ->directory('foto-profil'),

                Textarea::make('bio')
                    ->label('Bio')
                    ->rows(4),
            ])
            ->statePath('data');
    }

    public function simpan(): void
    {
        $data = $this->form->getState();

        auth()->user()->update($data);

        $this->form->fill($data);

        \Filament\Notifications\Notification::make()
            ->title('Profil berhasil diperbarui')
            ->success()
            ->send();
    }

    public function getTestSchema(): string
    {
        return $this->form ? 'Schema terbaca' : 'Schema kosong';
    }
}