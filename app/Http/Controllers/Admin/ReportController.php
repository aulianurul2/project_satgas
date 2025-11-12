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
    // update status
     public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Menunggu Verifikasi Admin,Diproses,Selesai,Dibatalkan,Terverifikasi',
        ]);

        $report = Report::findOrFail($id);
        $report->status = $request->status;
        $report->save();

        return redirect()->back()->with('success', 'Status laporan berhasil diperbarui.');
    }
    
}
