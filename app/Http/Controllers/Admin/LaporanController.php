<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Laporan;
use PDF;

class LaporanController extends Controller
{
    public function index()
    {
        $reports = Laporan::latest()->paginate(10);
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
