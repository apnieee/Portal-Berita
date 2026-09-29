<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    // Halaman filter laporan
    public function index(Request $request)
    {
        $kategoris = Kategori::orderBy('nama_kategori')->get();
        return view('admin.laporan.index', compact('kategoris'));
    }

    // Ambil data laporan berdasarkan filter tanggal & kategori
    private function getData(Request $request)
    {
        return Berita::with(['kategori', 'user'])
            ->when($request->filled('id_kategori'), fn ($q) => $q->where('id_kategori', $request->id_kategori))
            ->when($request->filled('dari'), fn ($q) => $q->whereDate('tanggal', '>=', $request->dari))
            ->when($request->filled('sampai'), fn ($q) => $q->whereDate('tanggal', '<=', $request->sampai))
            ->orderBy('tanggal')
            ->get();
    }

    // Tampilkan laporan di browser (bisa langsung dicetak/print)
    public function cetak(Request $request)
    {
        $beritas = $this->getData($request);
        return view('admin.laporan.cetak', compact('beritas'));
    }

    // Export laporan sebagai PDF
    public function exportPdf(Request $request)
    {
        $beritas = $this->getData($request);
        $pdf = Pdf::loadView('admin.laporan.cetak', compact('beritas'))->setPaper('a4', 'landscape');
        return $pdf->download('laporan-berita-kwave-' . now()->format('Ymd-His') . '.pdf');
    }
}
