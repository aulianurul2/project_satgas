<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Recruitment;
use App\Models\Member;

class AdminRecruitmentController extends Controller
{
    /**
     * Menampilkan daftar semua pendaftar recruitment.
     */
    public function index()
    {
        // Ambil semua data pelamar
        $pelamars = Recruitment::latest()->paginate(10);

        // Ambil data member jika diperlukan
        $members = Member::latest()->paginate(10);

        return view('admin.laporan.adminrecruitment', compact('pelamars', 'members'));
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
        $request->validate([
            'status' => 'required|in:Seleksi,Lolos Wawancara,Diterima',
        ]);

        $pelamar = Recruitment::findOrFail($id);
        $pelamar->status = $request->status;
        $pelamar->save();

        return redirect()->back()->with('success', 'Status pelamar berhasil diperbarui!');
    }
}
