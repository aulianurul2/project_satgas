<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Recruitment;

class RecruitmentController extends Controller
{
    public function create()
    {
        return view('user.recruitment');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'        => 'required|string|max:255',
            'nim'         => 'required|string|unique:members',
            'jurusan'     => 'required|string',
            'prodi'       => 'required|string',
            'ipk_terakhir'=> 'required|numeric|between:0,4',
            'no_wa'       => 'required|string',
            'cv'          => 'required|file|mimes:pdf|max:2048',
            'essay'       => 'required|file|mimes:pdf|max:2048',
            'pas_foto'    => 'required|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        // Upload file
        $cvPath = $request->file('cv')->store('cv', 'public');
        $essayPath = $request->file('essay')->store('essay', 'public');
        $fotoPath = $request->file('pas_foto')->store('foto', 'public');

        // Simpan data
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
        ]);

        return redirect()->route('recruitment.create')->with('success', 'Pendaftaran berhasil dikirim!');
    }
}
