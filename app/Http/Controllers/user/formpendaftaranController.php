<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Recruitment;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\QueryException;

class FormPendaftaranController extends Controller
{
    /**
     * Menampilkan halaman form pendaftaran recruitment.
     */
    public function create()
    {
        // Menampilkan halaman form pendaftaran (user/recruitment.blade.php)
        return view('user.laporan.formpendaftaran');
    }

    /**
     * Menyimpan data pendaftar recruitment ke database.
     */
    public function store(Request $request)
    {
        // ✅ Validasi input dari form
        $validated = $request->validate([
            'nama'         => 'required|string|max:255',
            'nim'          => 'required|string|max:50|unique:pelamars,nim',
            'jurusan'      => 'required|string|max:255',
            'prodi'        => 'required|string|max:255',
            'ipk_terakhir' => 'required|numeric|between:0,4',
            'no_wa'        => 'required|string|max:20',
            'cv'           => 'required|file|mimes:pdf|max:2048',
            'essay'        => 'required|file|mimes:pdf|max:2048',
            'pas_foto'     => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        try {
            // ✅ Simpan file ke storage/app/public/uploads/
            $cvPath    = $request->file('cv')->store('uploads/cv', 'public');
            $essayPath = $request->file('essay')->store('uploads/essay', 'public');
            $fotoPath  = $request->file('pas_foto')->store('uploads/foto', 'public');

            // ✅ Simpan data ke database
            Recruitment::create([
                'nama'         => $validated['nama'],
                'nim'          => $validated['nim'],
                'jurusan'      => $validated['jurusan'],
                'prodi'        => $validated['prodi'],
                'ipk_terakhir' => $validated['ipk_terakhir'],
                'no_wa'        => $validated['no_wa'],
                'cv'           => $cvPath,
                'essay'        => $essayPath,
                'pas_foto'     => $fotoPath,
                // status otomatis "Seleksi" dari model
            ]);

            // ✅ Redirect ke halaman form dengan pesan sukses
            return redirect()
            ->route('formpendaftaran.create')
            ->with('success', '✅ Pendaftaran berhasil dikirim!');
        } 

        catch (\Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
}
