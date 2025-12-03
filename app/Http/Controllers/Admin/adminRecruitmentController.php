<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Recruitment;

class AdminRecruitmentController extends Controller
{
    /**
     * Menampilkan daftar semua pendaftar recruitment.
     */
    public function index()
    {
        // Ambil semua data pelamar, urutkan terbaru
        $pelamars = Recruitment::latest()->paginate(10);

        // Tampilkan ke view admin.laporan.adminrecruitment
        return view('admin.laporan.adminrecruitment', compact('pelamars'));
    }

    /**
     * Menampilkan halaman tambah data (jika diperlukan).
     */
    public function create()
    {
        return view('admin.laporan.adminrecruitment');
    }

    /**
     * Mengupdate status pelamar.
     */
    public function updateStatus(Request $request, $id)
    {
        // ✅ Validasi input status
        $request->validate([
            'status' => 'required|in:Seleksi,Lolos Wawancara,Diterima',
        ]);

        // ✅ Cari pelamar berdasarkan ID
        $pelamar = Recruitment::findOrFail($id);

        // ✅ Update status
        $pelamar->status = $request->status;
        $pelamar->save();

        // ✅ Kembalikan ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Status pelamar berhasil diperbarui!');
    }
}
