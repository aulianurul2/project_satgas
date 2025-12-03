<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Recruitment;
use App\Models\Member;
use App\Models\Setting;
// use App\Http\Controllers\Controller; // <--- TAMBAHKAN BARIS INI
// use Illuminate\Http\Request;
// use App\Models\Member; // Pastikan Model Member juga di-import jika dipakai

class AdminRecruitmentController extends Controller
{
    /**
     * Menampilkan daftar semua pendaftar recruitment.
     */
    public function index()
    {

    $pelamars = Recruitment::latest()->paginate(10);
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
            'status' => 'required|in:Seleksi,Lolos Wawancara,Diterima',
        ]);

        $pelamar = Recruitment::findOrFail($id);
        $pelamar->status = $request->status;
        $pelamar->save();

        return redirect()->back()->with('success', 'Status pelamar berhasil diperbarui!');
    }

     public function toggle(Request $request)
    {
        $action = $request->input('action'); // 'open' atau 'close'

        Setting::updateOrCreate(
            ['key' => 'pendaftaran_aktif'],
            ['value' => $action === 'open' ? 1 : 0]

        );

        return back()->with('success', 'Status pendaftaran berhasil diubah.');
        // Pastikan model Member sudah ada
        $members = Member::latest()->paginate(10); 
        
        // Sesuaikan path view-nya dengan folder view Anda
        return view('admin/laporan/adminrecruitment', compact('members'));
    }
}
