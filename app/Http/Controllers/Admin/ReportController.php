<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    // Menampilkan semua laporan
    public function index()
    {
        $reports = Report::orderBy('created_at', 'desc')->get();
        return view('admin.laporan.index', compact('reports'));
    }

    // Menampilkan detail laporan
    public function show($id)
    {
        $report = Report::findOrFail($id);
        return view('admin.laporan.show', compact('report'));
    }
    // // update status
    //  public function updateStatus(Request $request, $id)
    // {
    //     $request->validate([
    //         'status' => 'required|in:Menunggu Verifikasi Admin,Diproses,Selesai,Dibatalkan,Terverifikasi',
    //     ]);

    //     $report = Report::findOrFail($id);
    //     $report->status = $request->status;
    //     $report->save();

    //     return redirect()->back()->with('success', 'Status laporan berhasil diperbarui.');
    // }
    public function updateStatus(Request $request, $id)
{
    $report = Report::findOrFail($id);

    // Jika sudah dibatalkan, tidak bisa diubah lagi
    if ($report->status === 'Dibatalkan') {
        return redirect()->back()->with('error', 'Laporan yang sudah dibatalkan tidak dapat diubah lagi.');
    }

    $validated = $request->validate([
        'status' => 'required|string',
        'alasan_dibatalkan' => 'nullable|string',
    ]);

    // Jika status "Dibatalkan", wajib isi alasan
    if ($validated['status'] === 'Dibatalkan' && empty($validated['alasan_dibatalkan'])) {
        return redirect()->back()->with('error', 'Silakan isi alasan pembatalan terlebih dahulu.');
    }

    $report->status = $validated['status'];
    if ($validated['status'] === 'Dibatalkan') {
        $report->alasan_dibatalkan = $validated['alasan_dibatalkan'];
    }
    $report->save();

    return redirect()->back()->with('success', 'Status laporan berhasil diperbarui.');
}

    
}
