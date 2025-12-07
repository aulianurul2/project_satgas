<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;


class ReportController extends Controller
{
    /**
     * Tampilkan form buat laporan baru
     */
    public function create()
    {
        return view('user.laporan.create');
    }

    /**
     * Tampilkan riwayat laporan user
     */
    public function history()
    {
        $user = Auth::user();

        $reports = Report::where('user_id', $user->idUser ?? $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user.laporan.history', compact('reports'));
    }

    /**
     * Simpan laporan baru ke database
     */
  public function store(Request $request)
{
    // Validasi input user
    $validated = $request->validate([
        'nama_pelapor' => 'required|string|max:255',
        'tempat_lahir' => 'required|string|max:255',
        'tanggal_lahir' => 'required|date',
        'agama' => 'required|string|max:255',
        'jk' => 'required|string|max:10',
        'alamat' => 'required|string|max:255',
        'unsur' => 'required|string|max:255',
        'jurusan' => 'nullable|string|max:255',
        'prodi' => 'nullable|string|max:255',
        'no_hp' => 'required|string|max:20',
        'email' => 'required|email|max:255',
        'kedudukan' => 'required|string|max:50',

        // Bagian terlapor
        'pihak_dilaporkan' => 'required|string|max:255',
        'nama_terlapor' => 'nullable|string|max:255',
        'jk_terlapor' => 'nullable|string|max:10',
        'unit_kerja_terlapor' => 'nullable|string|max:255',

        // Bagian peristiwa
        'tanggal_kejadian' => 'required|date',
        'tempat_kejadian' => 'required|string|max:255',
        'kronologi' => 'required|string',
        'bantuan_yang_diperlukan' => 'nullable|string',
        'bukti' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:20000',
    ]);

    $user = Auth::user();
    $buktiPath = null;

    // Simpan file bukti jika ada
    if ($request->hasFile('bukti')) {
        $buktiPath = $request->file('bukti')->store('bukti', 'public');
    }

    // Simpan laporan ke database
    $report = Report::create([
        'user_id' => $user->idUser ?? $user->id,
        'nama_pelapor' => $validated['nama_pelapor'],
        'tempat_lahir' => $validated['tempat_lahir'],
        'tanggal_lahir' => $validated['tanggal_lahir'],
        'agama' => $validated['agama'],
        'jk' => $validated['jk'],
        'alamat' => $validated['alamat'],
        'unsur' => $validated['unsur'],
        'jurusan' => $validated['jurusan'] ?? null,
        'prodi' => $validated['prodi'] ?? null,
        'no_hp' => $validated['no_hp'],
        'email' => $validated['email'],
        'kedudukan' => $validated['kedudukan'],
        'pihak_dilaporkan' => $validated['pihak_dilaporkan'],
        'nama_terlapor' => $validated['nama_terlapor'] ?? null,
        'jk_terlapor' => $validated['jk_terlapor'] ?? null,
        'unit_kerja_terlapor' => $validated['unit_kerja_terlapor'] ?? null,
        'tanggal_kejadian' => $validated['tanggal_kejadian'],
        'tempat_kejadian' => $validated['tempat_kejadian'],
        'kronologi' => $validated['kronologi'],
        'bantuan_yang_diperlukan' => $validated['bantuan_yang_diperlukan'] ?? null,
        'bukti' => $buktiPath,
        'status' => 'Menunggu Verifikasi Admin',
    ]);

    // Nomor WhatsApp admin (ganti sesuai kebutuhan)
    $adminNumber = '6281312930113'; // format internasional tanpa +
    $message = "Halo Satgas, ada laporan baru dari $user->nama.\nSilakan cek sistem SIPRAK untuk mengetahui lebih lanjut: " . route('user.dashboard');
    $waLink = "https://wa.me/$adminNumber?text=" . urlencode($message);

    // Redirect ke dashboard dan simpan link WA di session
    return redirect()->route('user.dashboard')
                     ->with('success', 'Laporan berhasil dikirim! Terima kasih telah melapor.')
                     ->with('wa_link', $waLink)
                     ->with('wa_notice', 'Wajib kirim pesan WhatsApp agar laporan segera ditangani!');
}


    /**
     * Tampilkan detail laporan user
     */
    public function show($id)
    {
        $user = Auth::user();

        // Pastikan laporan milik user yang sedang login
        $report = Report::where('idForm', $id)
            ->where('user_id', $user->idUser ?? $user->id)
            ->firstOrFail();

        return view('user.laporan.show', compact('report'));
    }
    public function index()
    {
    $user = Auth::user();

    $reports = Report::where('user_id', $user->idUser ?? $user->id)
                     ->orderBy('created_at', 'desc')
                     ->paginate(6); // 6 laporan per halaman

    return view('user.laporan.create', compact('reports'));
    }
    
    
}
