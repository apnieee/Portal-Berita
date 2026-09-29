@extends('layouts.admin')
@section('title', 'Laporan Berita')

@section('content')
<h3>Laporan Berita</h3>
<p class="text-muted">Filter data berita lalu cetak atau ekspor sebagai PDF.</p>

<form method="GET" action="{{ route('admin.laporan.cetak') }}" target="_blank" class="row g-3 bg-white p-3 rounded">
    <div class="col-md-4">
        <label class="form-label">Kategori</label>
        <select name="id_kategori" class="form-select">
            <option value="">-- Semua Kategori --</option>
            @foreach($kategoris as $kat)
                <option value="{{ $kat->id_kategori }}">{{ $kat->nama_kategori }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-3">
        <label class="form-label">Dari Tanggal</label>
        <input type="date" name="dari" class="form-control">
    </div>
    <div class="col-md-3">
        <label class="form-label">Sampai Tanggal</label>
        <input type="date" name="sampai" class="form-control">
    </div>
    <div class="col-md-2 d-flex align-items-end gap-2">
        <button type="submit" class="btn btn-primary w-100">Lihat / Cetak</button>
    </div>
</form>

<form method="GET" action="{{ route('admin.laporan.export-pdf') }}" class="mt-2">
    <input type="hidden" name="id_kategori" id="hid_kategori">
    <button type="button" onclick="exportPdf()" class="btn btn-success">Export PDF</button>
</form>

<script>
    // Kirim filter yang sama ke export PDF
    function exportPdf() {
        const params = new URLSearchParams(new FormData(document.querySelector('form[action="{{ route('admin.laporan.cetak') }}"]')));
        window.location.href = "{{ route('admin.laporan.export-pdf') }}?" + params.toString();
    }
</script>
@endsection
