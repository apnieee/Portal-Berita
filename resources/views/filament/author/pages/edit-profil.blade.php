
<x-filament-panels::page>
    <form wire:submit="simpan" class="space-y-6">
        {{ $this->form }}

        <x-filament::button type="submit">
            Simpan Perubahan
        </x-filament::button>
    </form>

    <div class="mt-8 border-t border-gray-200 pt-6 dark:border-gray-700">
        <h2 class="text-lg font-bold mb-4">Ubah Password</h2>

        <form wire:submit="ubahPassword" class="space-y-6">
            {{ $this->passwordForm }}

            <x-filament::button type="submit">
                Ubah Password
            </x-filament::button>
        </form>
    </div>
</x-filament-panels::page>
