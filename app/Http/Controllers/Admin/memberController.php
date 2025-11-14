<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Member;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::latest()->paginate(10);
        return view('admin.members.index', compact('members'));
    }

    public function create()
    {
        return view('admin.members.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'    => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'kontak'  => 'required|string|max:255',
            'divisi'  => 'nullable|string|max:255',
            'nim_nip' => 'nullable|string|max:255',
            'aktif'   => 'required|in:0,1',
        ]);

        Member::create([
            'nama'    => $request->nama,
            'jabatan' => $request->jabatan,
            'kontak'  => $request->kontak,
            'divisi'  => $request->divisi,
            'nim_nip' => $request->nim_nip,
            'aktif'   => $request->aktif,
        ]);

        return redirect()
            ->route('admin.members.index')
            ->with('success', 'Member berhasil ditambahkan!');
    }

    public function edit(Member $member)
    {
        return view('admin.members.edit', compact('member'));
    }

    public function update(Request $request, Member $member)
    {
        $request->validate([
            'nama'    => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'kontak'  => 'required|string|max:255',
            'divisi'  => 'nullable|string|max:255',
            'nim_nip' => 'nullable|string|max:255',
            'aktif'   => 'required|in:0,1',
        ]);

        $member->update([
            'nama'    => $request->nama,
            'jabatan' => $request->jabatan,
            'kontak'  => $request->kontak,
            'divisi'  => $request->divisi,
            'nim_nip' => $request->nim_nip,
            'aktif'   => $request->aktif,
        ]);

        return redirect()
            ->route('admin.members.index')
            ->with('success', 'Member berhasil diperbarui!');
    }

    public function destroy(Member $member)
    {
        $member->delete();
        return redirect()
            ->route('admin.members.index')
            ->with('success', 'Member berhasil dihapus!');
    }
}
