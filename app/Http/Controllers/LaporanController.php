<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    /**
     * Menampilkan halaman laporan dengan data barang yang telah difilter dan dipaginasi,
     * beserta data kategori dan statistik keseluruhan.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $query = Barang::with('kategori');

        // Filter by category
        if ($request->filled('kategori')) {
            $query->where('id_kategori', $request->kategori);
        }

        // Filter by date range
        if ($request->filled('tgl_awal') && $request->filled('tgl_akhir')) {
            $query->whereBetween('tanggal_masuk', [$request->tgl_awal, $request->tgl_akhir]);
        }

        $barang = $query->paginate(15)->withQueryString();
        $kategoris = Kategori::all();

        // Calculate statistics
        $statistics = [
            'total_barang' => Barang::count(),
            'total_stok' => Barang::sum('stok'),
            'low_stock' => Barang::where('stok', '<=', 10)->count(),
            'total_value' => Barang::all()->sum(function ($item) {
                return $item->stok * $item->harga;
            })
        ];

        return view('laporan.index', compact('barang', 'kategoris', 'statistics'));
    }

    /**
     * Mengekspor data barang yang telah difilter ke dalam format PDF.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function export(Request $request)
    {
        $query = Barang::with('kategori');

        // Filter kategori
        if ($request->filled('kategori')) {
            $query->where('id_kategori', $request->kategori);
        }

        // Filter tanggal masuk
        if ($request->filled('tgl_awal')) {
            $query->whereDate('tanggal_masuk', '>=', $request->tgl_awal);
        }

        if ($request->filled('tgl_akhir')) {
            $query->whereDate('tanggal_masuk', '<=', $request->tgl_akhir);
        }

        $barang = $query->get();

        // Calculate statistics
        $statistics = [
            'total_barang' => $barang->count(),
            'total_stok' => $barang->sum('stok'),
            'total_value' => $barang->sum(function ($item) {
                return $item->stok * $item->harga;
            })
        ];

        $pdf = Pdf::loadView('laporan.pdf', compact('barang', 'statistics', 'request'));

        // return $pdf->download('laporan-barang-' . date('Y-m-d-His') . '.pdf');
        return $pdf->stream('laporan-barang-' . date('Y-m-d-His') . '.pdf');
    }
}
