<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Berita - KWave</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        h2 { text-align: center; margin-bottom: 4px; }
        p.sub { text-align: center; margin-top: 0; color: #555; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #333; padding: 6px; text-align: left; }
        th { background: #eee; }
    </style>
</head>
<body>
    <h2>Laporan Berita - KWave</h2>
    <p class="sub">Dicetak pada {{ now()->translatedFormat('d F Y, H:i') }}</p>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Judul</th>
                <th>Kategori</th>
                <th>Penulis</th>
                <th>Status</th>
                <th>Views</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($beritas as $i => $b)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $b->judul }}</td>
                <td>{{ $b->kategori->nama_kategori }}</td>
                <td>{{ $b->user->nama }}</td>
                <td>{{ $b->status }}</td>
                <td>{{ $b->views }}</td>
                <td>{{ $b->tanggal?->format('d-m-Y') }}</td>
            </tr>
            @empty
            <tr><td colspan="7" style="text-align:center;">Tidak ada data.</td></tr>
            @endforelse
        </tbody>
    </table>

    <p style="margin-top:20px;">Total berita: {{ $beritas->count() }}</p>

    <script>window.onload = () => window.print();</script>
</body>
</html>
