@extends('layouts.app')

@section('content')
<div class="p-8 max-w-lg mx-auto">
    <h1 class="text-2xl font-bold mb-6">{{ isset($member) ? 'Edit Anggota' : 'Tambah Anggota' }}</h1>

    <form action="{{ isset($member) ? route('admin.members.update', $member) : route('admin.members.store') }}" method="POST" class="space-y-4">
        @csrf
        @if(isset($member))
            @method('PUT')
        @endif

        <div>
            <label class="block mb-1">Nama</label>
            <input type="text" name="nama" value="{{ old('nama', $member->nama ?? '') }}" class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block mb-1">Jabatan</label>
            <input type="text" name="jabatan" value="{{ old('jabatan', $member->jabatan ?? '') }}" class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block mb-1">Kontak</label>
            <input type="text" name="kontak" value="{{ old('kontak', $member->kontak ?? '') }}" class="w-full border rounded px-3 py-2">
        </div>
        <div>
    <label class="block mb-1">Divisi</label>
        <input type="text" name="divisi" value="{{ old('divisi', $member->divisi ?? '') }}" class="w-full border rounded px-3 py-2">
    </div>

    <div>
        <label class="block mb-1">NIM / NIP</label>
        <input type="text" name="nim_nip" value="{{ old('nim_nip', $member->nim_nip ?? '') }}" class="w-full border rounded px-3 py-2">
    </div>

    <div>
            <label class="block mb-1">Status</label>
            <select name="aktif" class="w-full border rounded px-3 py-2">
                <option value="1" {{ old('aktif', $member->aktif ?? 1) == 1 ? 'selected' : '' }}>Aktif</option>
                <option value="0" {{ old('aktif', $member->aktif ?? 1) == 0 ? 'selected' : '' }}>Nonaktif</option>
            </select>
        </div>
        <div class="form-group">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control" rows="3">{{ old('alamat', $member->alamat ?? '') }}</textarea>
        </div>


        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
            {{ isset($member) ? 'Update' : 'Simpan' }}
        </button>
    </form>
</div>
@endsection
