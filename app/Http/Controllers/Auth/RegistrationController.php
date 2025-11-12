<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Registration;

class RegistrationController extends Controller
{
    public function create()
    {
        return view('user.pendaftaran.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|max:20',
            'jurusan' => 'required|string|max:100',
            'prodi' => 'nullable|string|max:100',
            'alasan' => 'required|string',
        ]);

        Registration::create($request->all());

        return redirect()->route('user.dashboard')->with('success', 'Pendaftaran berhasil dikirim.');
    }
}
