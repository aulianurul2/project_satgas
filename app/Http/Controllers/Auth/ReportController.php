<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Report;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Report::where('user_id', Auth::id())->latest()->get();
        return view('user.laporan.index', compact('reports'));
    }

    public function create()
    {
        return view('user.laporan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pelapor' => 'required|string|max:255',
            'TTL' => 'required|string|max:255',
            'agama' => 'required|string|max:100',
            'jk' => 'required|string',
            'alamat' => 'required|string',
            'unsur' => 'required|string',
            'jurusan' => 'required|string',
            'prodi' => 'required|string',
            'tempat_kejadian' => 'required|string',
            'kronologi' => 'required|string',
            'nama_terlapor' => 'required|string',
            'jk_terlapor' => 'required|string',
            'bukti' => 'nullable|file|mimes:jpg,png,pdf|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('bukti')) {
            $path = $request->file('bukti')->store('bukti', 'public');
        }

        Report::create([
            'user_id' => Auth::id(),
            'nama_pelapor' => $request->nama_pelapor,
            'TTL' => $request->TTL,
            'agama' => $request->agama,
            'jk' => $request->jk,
            'alamat' => $request->alamat,
            'unsur' => $request->unsur,
            'jurusan' => $request->jurusan,
            'prodi' => $request->prodi,
            'tempat_kejadian' => $request->tempat_kejadian,
            'kronologi' => $request->kronologi,
            'bantuan_yang_diperlukan' => $request->bantuan_yang_diperlukan,
            'nama_terlapor' => $request->nama_terlapor,
            'jk_terlapor' => $request->jk_terlapor,
            'bukti' => $path,
        ]);

        return redirect()->route('user.laporan.index')->with('success', 'Laporan berhasil dikirim.');
    }
}
