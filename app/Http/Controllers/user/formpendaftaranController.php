<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        // Tampilkan view form pendaftaran
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
            'cv'           => 'required|file|mimes:pdf|max:100000',
            'essay'        => 'required|file|mimes:pdf|max:100000',
            'pas_foto'     => 'required|image|mimes:jpg,jpeg,png|max:10000',
        ]);

        try {
            // ✅ Simpan file ke storage/app/public/uploads/
            $cvPath    = $request->file('cv')->store('uploads/cv', 'public');
            $essayPath = $request->file('essay')->store('uploads/essay', 'public');
            $fotoPath  = $request->file('pas_foto')->store('uploads/foto', 'public');

            // ✅ Simpan data ke database dengan user_id dari user login
            Recruitment::create([
                'user_id'      => Auth::id(), // ← penting untuk riwayat!
                'nama'         => $validated['nama'],
                'nim'          => $validated['nim'],
                'jurusan'      => $validated['jurusan'],
                'prodi'        => $validated['prodi'],
                'ipk_terakhir' => $validated['ipk_terakhir'],
                'no_wa'        => $validated['no_wa'],
                'cv'           => $cvPath,
                'essay'        => $essayPath,
                'pas_foto'     => $fotoPath,
                'tanggal_pendaftaran' => now(),
                // status otomatis "Seleksi" (default dari migration)
            ]);

            // ✅ Redirect ke halaman riwayat pendaftaran dengan pesan sukses
            return redirect()
                ->route('user.riwayatpendaftaran.index')
                ->with('success', '✅ Pendaftaran berhasil dikirim!');
        } 
        catch (QueryException $e) {
            // ❌ Jika error database
            return back()->withErrors(['db_error' => 'Gagal menyimpan ke database: ' . $e->getMessage()]);
        } 
        catch (\Exception $e) {
            // ❌ Jika error umum lain
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
}
