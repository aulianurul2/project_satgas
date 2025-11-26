<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Recruitment;

class RiwayatPendaftaranController extends Controller
{
    public function index()
    {
        // Ambil user yang sedang login
        $user = Auth::user();

        // Ambil data pendaftaran milik user berdasarkan nama atau nim (tergantung data kamu)
        $pelamars = Recruitment::where('nim', $user->nim ?? '')
                               ->orWhere('nama', $user->name ?? '')
                               ->get();

        return view('user.laporan.riwayatpendaftaran', compact('pelamars'));
    }
}
