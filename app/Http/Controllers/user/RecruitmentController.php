<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Recruitment;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\QueryException;

class RecruitmentController extends Controller
{
    /**
     * Tampilkan form pendaftaran recruitment.
     */
    public function create()
    {
        return view('user.recruitment');
    }

    /**
     * Simpan data pelamar recruitment.
     */
    public function store(Request $request)
    {
        // ✅ Validasi input
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
            // ✅ Simpan file ke storage/app/public/uploads/{folder}
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
                // status otomatis diisi "Seleksi" oleh model
            ]);

            return redirect()
                ->route('user.riwayatpendaftaran.index')
                ->with('success', '✅ Pendaftaran berhasil dikirim!');

        } catch (QueryException $e) {
            // ❌ Jika error database
            return back()->withErrors(['db_error' => 'Gagal menyimpan ke database: ' . $e->getMessage()]);
        } catch (\Exception $e) {
            // ❌ Jika error umum lain
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
}
