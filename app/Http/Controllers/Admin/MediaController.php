<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    public function index()
    {
        $media = Media::latest()->paginate(10);
        return view('admin.media.index', compact('media'));
    }

    public function create()
    {
        // daftar kategori
        $kategoriList = ['Berita', 'Kegiatan', 'Artikel', 'Pengumuman'];
        return view('admin.media.create', compact('kategoriList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required',
            'gambar' => 'nullable|image|max:2048',
            'kategori' => 'required|string|max:255',
        ]);

        $path = $request->hasFile('gambar')
            ? $request->file('gambar')->store('media', 'public')
            : null;

        Media::create([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'gambar' => $path,
            'kategori' => $request->kategori,
        ]);

        return redirect()->route('admin.media.index')
            ->with('success', 'Berita berhasil ditambahkan!');
    }

    public function edit(Media $media)
    {
        $kategoriList = ['Berita', 'Kegiatan', 'Artikel', 'Pengumuman'];
        return view('admin.media.edit', compact('media', 'kategoriList'));
    }

    public function update(Request $request, Media $media)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required',
            'gambar' => 'nullable|image|max:2048',
            'kategori' => 'required|string|max:255',
        ]);

        $path = $media->gambar;
        if ($request->hasFile('gambar')) {
            if ($path && Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }
            $path = $request->file('gambar')->store('media', 'public');
        }

        $media->update([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'gambar' => $path,
            'kategori' => $request->kategori,
        ]);

        return redirect()->route('admin.media.index')
            ->with('success', 'Berita berhasil diperbarui!');
    }

    public function destroy(Media $media)
    {
        if ($media->gambar && Storage::disk('public')->exists($media->gambar)) {
            Storage::disk('public')->delete($media->gambar);
        }

        $media->delete();
        return redirect()->route('admin.media.index')
            ->with('success', 'Berita berhasil dihapus!');
    }
        public function show($id)
    {
        $media = Media::findOrFail($id);
        return view('landing.detail-berita', compact('media'));
    }

}
