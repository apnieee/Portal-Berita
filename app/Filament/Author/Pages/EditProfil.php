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
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class EditProfil extends Page implements HasSchemas
{
    use InteractsWithSchemas;

    protected string $view = 'filament.author.pages.edit-profil';

    public ?array $data = [];

    public ?string $password_sekarang = null;
    public ?string $password_baru = null;
    public ?string $password_baru_confirmation = null;

    public ?array $passwordData = [];

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

    public function passwordForm(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('password_sekarang')
                    ->label('Password Saat Ini')
                    ->password()
                    ->required(),

                TextInput::make('password_baru')
                    ->label('Password Baru')
                    ->password()
                    ->required()
                    ->minLength(8),

                TextInput::make('password_baru_confirmation')
                    ->label('Konfirmasi Password Baru')
                    ->password()
                    ->required()
                    ->same('password_baru'),
            ])
            ->statePath('passwordData');
    }

    public function ubahPassword(): void
    {
        $data = $this->passwordForm->getState();

        if (! Hash::check($data['password_sekarang'], auth()->user()->password)) {
            \Filament\Notifications\Notification::make()
                ->title('Password saat ini tidak sesuai')
                ->danger()
                ->send();

            return;
        }

        auth()->user()->update([
            'password' => Hash::make($data['password_baru']),
        ]);

        $this->passwordForm->fill();

        \Filament\Notifications\Notification::make()
            ->title('Password berhasil diperbarui')
            ->success()
            ->send();
    }
}