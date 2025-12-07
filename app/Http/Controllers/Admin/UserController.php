<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // List user
    public function index()
    {
    $users = User::orderBy('idUser')->paginate(10); // bebas mau 5, 10, 15, dll

    return view('admin.users.index', compact('users'));
    }


    // Edit user
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('admin.users.edit', compact('user'));
    }

    // Update
   public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    // CEGAH ADMIN HAPUS / EDIT JENIS USER DIRINYA SENDIRI
    if ($user->idUser == auth()->user()->idUser) {
        // Jika mencoba mengubah jenis user dirinya sendiri
        if ($request->jenisUser !== $user->jenisUser) {
            return back()->with('error', 'Anda tidak bisa mengubah jenis user diri sendiri.');
        }
    }

    // Validasi umum
    $request->validate([
        'nama' => 'required|string|max:255',
        'email' => 'required|email',
        'kontak' => 'nullable|string|max:20',
        'alamat' => 'nullable|string|max:255',
        'jenisUser' => 'required|string',
        'password' => 'nullable|string|min-6'
    ]);

    $user->nama = $request->nama;
    $user->email = $request->email;
    $user->kontak = $request->kontak;
    $user->alamat = $request->alamat;

    // Hanya boleh ubah jenisUser jika bukan dirinya sendiri
    if ($user->idUser != auth()->user()->idUser) {
        $user->jenisUser = $request->jenisUser;
    }

    // Password opsional
    if ($request->filled('password')) {
        $user->password = bcrypt($request->password);
    }

    $user->save();

    return redirect()->route('admin.users.index')->with('success', 'User berhasil diperbarui!');
}



    // Delete user
    public function destroy($id)
    {
    $user = User::findOrFail($id);

    // Cegah penghapusan admin
    if ($user->jenisUser === 'admin') {
        return redirect()->back()->with('error', 'User admin tidak boleh dihapus!');
    }

    // Hapus foto jika ada
    if ($user->profile_photo && file_exists(public_path('storage/profile_photos/'.$user->profile_photo))) {
        unlink(public_path('storage/profile_photos/'.$user->profile_photo));
    }

    // Hapus data user
    $user->delete();

    return redirect()->back()->with('success', 'User berhasil dihapus.');
}

    
}
