<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Laporan;
use PDF;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // 1. Inisialisasi Query
        $query = Laporan::query();

        // 2. Filter Berdasarkan Status (Jika ada input)
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // 3. Filter Berdasarkan Tanggal (Jika ada input start & end)
        if ($request->filled('start') && $request->filled('end')) {
            // Asumsi filter berdasarkan tanggal pembuatan (created_at)
            $query->whereBetween('created_at', [$request->start, $request->end]);
        }

        // 4. Eksekusi Query dengan Pagination
        // withQueryString() penting agar saat klik halaman 2, parameter filter tidak hilang
        $reports = $query->latest()->paginate(10)->withQueryString();

        return view('admin.laporan.index', compact('reports'));
    }

    public function show($id)
    {
        $report = Laporan::findOrFail($id);
        return view('admin.laporan.show', compact('report'));
    }

    public function download($id)
    {
        $report = Laporan::findOrFail($id);

        $pdf = PDF::loadView('admin.laporan.pdf', compact('report'));

        return $pdf->download('Laporan-' . $report->idForm . '.pdf');
    }

    public function update(Request $request, $id)
    {
        $report = Laporan::findOrFail($id);
        $report->status = $request->status;
        $report->save();

        return back()->with('success', 'Status laporan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $report = Laporan::findOrFail($id);
        $report->delete();

        return redirect()->route('admin.laporan.index')
            ->with('success', 'Laporan berhasil dihapus.');
    }
}
