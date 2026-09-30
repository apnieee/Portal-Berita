<x-filament-panels::page>

    <x-filament::section>
        <x-slot name="heading">
            Laporan Berita
        </x-slot>

        <x-slot name="description">
            Filter berita berdasarkan kategori dan tanggal.
        </x-slot>

        <form
            method="GET"
            action="{{ url('/admin/laporan/cetak') }}"
            target="_blank"
        >

            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px;">

                <div>
                    <label style="display:block; margin-bottom:8px; font-weight:600;">
                        Kategori
                    </label>

                    <select
                        name="id_kategori"
                        style="width:100%; padding:10px 12px; border-radius:8px; border:1px solid #52525b; background:#18181b; color:white;"
                    >
                        <option value="">Semua Kategori</option>

                        @foreach(\App\Models\Kategori::orderBy('nama_kategori')->get() as $kat)
                            <option value="{{ $kat->id_kategori }}">
                                {{ $kat->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label style="display:block; margin-bottom:8px; font-weight:600;">
                        Dari Tanggal
                    </label>

                    <input
                        type="date"
                        name="dari"
                        style="width:100%; padding:10px 12px; border-radius:8px; border:1px solid #52525b; background:#18181b; color:white;"
                    >
                </div>

                <div>
                    <label style="display:block; margin-bottom:8px; font-weight:600;">
                        Sampai Tanggal
                    </label>

                    <input
                        type="date"
                        name="sampai"
                        style="width:100%; padding:10px 12px; border-radius:8px; border:1px solid #52525b; background:#18181b; color:white;"
                    >
                </div>

            </div>

            <div style="display:flex; gap:10px; margin-top:24px;">

                <x-filament::button type="submit">
                    Lihat / Cetak
                </x-filament::button>

                <x-filament::button
                    type="button"
                    color="success"
                    onclick="exportPdf()"
                >
                    Export PDF
                </x-filament::button>

            </div>

        </form>
    </x-filament::section>

    <script>
        function exportPdf() {
            const form = document.querySelector('form');
            const params = new URLSearchParams(new FormData(form));

            window.location.href =
                "{{ url('/admin/laporan/export-pdf') }}?" + params.toString();
        }
    </script>

</x-filament-panels::page>