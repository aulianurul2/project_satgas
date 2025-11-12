<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Report;
use App\Models\Registration;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();

        // Ambil data laporan & pendaftaran milik user
        $reports = Report::where('user_id', $user->idUser ?? $user->id)
            ->latest()
            ->take(5)
            ->get();

        $registration = Registration::where('nama', $user->nama)
            ->latest()
            ->first();

        return view('user.dashboard', compact('user', 'reports', 'registration'));
    }
}
