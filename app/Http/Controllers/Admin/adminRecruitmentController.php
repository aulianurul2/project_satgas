<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Recruitment;
use App\Models\Member;
use App\Models\Setting;

class AdminRecruitmentController extends Controller
{
    /**
     * Menampilkan daftar semua pendaftar recruitment dengan filter tanggal.
     */
    public function index(Request $request)
    {
        // 1. Inisialisasi query untuk Model Recruitment
        $query = Recruitment::latest();

        // 2. Logika Filter Tanggal Pendaftaran (created_at)
        if ($request->filled('start_date')) {
            // Filter pelamar yang dibuat mulai dari tanggal ini (00:00:00)
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            // Filter pelamar yang dibuat sampai dengan tanggal ini (23:59:59)
            // Tambahkan 1 hari atau gunakan <= end_date pada kolom date time jika ingin akurat
            $query->whereDate('created_at', '<=', $request->end_date);
        }
        
        // 3. Eksekusi query dengan pagination
        $pelamars = $query->paginate(10)->withQueryString();

        // Data lain yang diperlukan
        $members = Member::latest()->paginate(10);

        // Ambil status pendaftaran
        $pendaftaranAktif = (bool) Setting::where('key', 'pendaftaran_aktif')->value('value');
        
        return view('admin.laporan.adminrecruitment', compact('pelamars', 'members', 'pendaftaranAktif'));
    }


    /**
     * Menampilkan halaman tambah data (jika diperlukan).
     */
    public function create()
    {
        $pendaftaranAktif = (bool) Setting::where('key', 'pendaftaran_aktif')->value('value');

        return view('admin.laporan.adminrecruitment', compact('pendaftaranAktif'));
    }


    /**
     * Mengupdate status pelamar.
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Seleksi,Lolos Wawancara,Diterima,Ditolak', // Menambahkan Ditolak
        ]);

        $pelamar = Recruitment::findOrFail($id);
        $pelamar->status = $request->status;
        $pelamar->save();

        return redirect()->back()->with('success', 'Status pelamar berhasil diperbarui!');
    }

    /**
     * Mengubah status pendaftaran aktif/tidak aktif.
     */
    public function toggle(Request $request)
    {
        $action = $request->input('action'); // 'open' atau 'close'

        Setting::updateOrCreate(
            ['key' => 'pendaftaran_aktif'],
            ['value' => $action === 'open' ? 1 : 0]
        );

        return back()->with('success', 'Status pendaftaran berhasil diubah.');
    }
}