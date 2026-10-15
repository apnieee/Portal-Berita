<div class="space-y-4">
    <div>
        <h3 class="font-semibold">Nama Pendaftar</h3>
        <p>{{ $record->user->nama ?? '-' }}</p>
    </div>

    <div>
        <h3 class="font-semibold">Email</h3>
        <p>{{ $record->user->email ?? '-' }}</p>
    </div>

    <div>
        <h3 class="font-semibold">Alasan Bergabung</h3>
        <p class="whitespace-pre-line">{{ $record->alasan }}</p>
    </div>

    <div>
        <h3 class="font-semibold">Status</h3>
        <p>{{ $record->status }}</p>
    </div>

    <div>
        <h3 class="font-semibold">Catatan Admin</h3>
        <p class="whitespace-pre-line">{{ $record->catatan_admin ?: 'Belum ada catatan.' }}</p>
    </div>
</div>
```