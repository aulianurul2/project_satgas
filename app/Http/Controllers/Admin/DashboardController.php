<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Laporan; // Asumsi nama Model Laporan Anda

class DashboardController extends Controller
{
    /**
     * Menampilkan dashboard utama admin dengan statistik.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        // Mendapatkan statistik ringkasan untuk Dashboard
        $totalLaporan = Laporan::count();
        $laporanDiproses = Laporan::where('status', 'Diproses')->count();
        $laporanMenungguVerifikasi = Laporan::where('status', 'Menunggu Verifikasi Admin')->count();
        $laporanSelesai = Laporan::where('status', 'Selesai')->count();

        // Mengambil 5 laporan terbaru untuk ditampilkan di dashboard
        $latestLaporans = Laporan::orderBy('created_at', 'desc')->take(5)->get();

        return view('admin.dashboard', compact(
            'totalLaporan',
            'laporanDiproses',
            'laporanMenungguVerifikasi',
            'laporanSelesai',
            'latestLaporans'
        ));
    }
}