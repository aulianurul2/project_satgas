<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Recruitment;

class RiwayatPendaftaranController extends Controller
{
    public function index()
    {
        // Ambil ID user yang sedang login
        $userId = Auth::id();

        // Ambil data pendaftaran milik user login berdasarkan user_id
        $pelamars = Recruitment::where('user_id', $userId)->get();

        // Kirim ke view
        return view('user.laporan.riwayatpendaftaran', compact('pelamars'));
    }
}
