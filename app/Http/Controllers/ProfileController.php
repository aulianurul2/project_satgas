<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
{
    $user = $request->user();

    // Update field
    $user->nama   = $request->nama;
    $user->email  = $request->email;
    $user->kontak = $request->kontak;
    $user->alamat = $request->alamat;

    if ($user->isDirty('email')) {
        $user->email_verified_at = null;
    }

    // ======================================
    //           UPLOAD FOTO PROFIL
    // ======================================
    if ($request->hasFile('photo')) {

    // Hapus foto lama
    if ($user->profile_photo && file_exists(public_path('profile/' . $user->profile_photo))) {
        unlink(public_path('profile/' . $user->profile_photo));
    }

    // Upload foto baru ke folder public/profile
    $filename = time() . '.' . $request->photo->extension();
    $request->photo->move(public_path('profile'), $filename);

    $user->profile_photo = $filename;
}


    $user->save();

    return Redirect::route('profile.edit')->with('status', 'profile-updated');
}


    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        // Hapus foto ketika akun dihapus
        if ($user->profile_photo && file_exists(public_path('storage/profile/' . $user->profile_photo))) {
            unlink(public_path('storage/profile/' . $user->profile_photo));
        }

        Auth::logout();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
