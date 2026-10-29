@extends('layouts.admin')
@section('title', 'Laporan Berita')

@section('content')
<h3>Laporan Berita</h3>
<p class="text-muted">Filter data berita lalu cetak atau ekspor sebagai PDF.</p>


<form method="GET" id="formLaporan" class="row g-3 bg-white p-3 rounded">
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
    <div class="col-12 d-flex gap-2">
        <button type="button" class="btn btn-primary" onclick="kirimLaporan('cetak')">Lihat / Cetak</button>
        <button type="button" class="btn btn-success" onclick="kirimLaporan('pdf')">Export PDF</button>
    </div>
</form>

<script>
function kirimLaporan(tujuan) {
    const form = document.getElementById('formLaporan');
    const params = new URLSearchParams();

    params.append('id_kategori', form.querySelector('[name="id_kategori"]').value);
    params.append('dari', form.querySelector('[name="dari"]').value);
    params.append('sampai', form.querySelector('[name="sampai"]').value);

    const url = tujuan === 'pdf'
        ? @json(route('admin.laporan.export-pdf'))
        : @json(route('admin.laporan.cetak'));

    const finalUrl = url + '?' + params.toString();
    console.log('URL laporan:', finalUrl);
    window.open(finalUrl, '_blank');
}
</script>
@endsection
