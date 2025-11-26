@extends('layouts.app')

@section('content')

{{-- Tambahkan styling CSS di sini. Pindahkan ke file CSS terpisah untuk praktik terbaik. --}}
<style>
    /* Styling Umum */
    .user-management-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    .page-title {
        color: #333;
        border-bottom: 3px solid #007bff; /* Garis bawah biru */
        padding-bottom: 10px;
        margin-bottom: 25px;
    }

    /* Styling Notifikasi */
    .success-alert {
        padding: 15px;
        margin-bottom: 20px;
        border: 1px solid transparent;
        border-radius: 4px;
        color: #155724;
        background-color: #d4edda;
        border-color: #c3e6cb;
        font-weight: bold;
    }

    /* Styling Tabel */
    .user-table-wrapper {
        background-color: #fff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        overflow-x: auto; /* Agar responsif */
    }

    .user-table {
        width: 100%;
        border-collapse: collapse;
        text-align: left;
    }

    .user-table thead tr {
        background-color: #007bff;
        color: #ffffff;
    }

    .user-table th, .user-table td {
        padding: 12px 15px;
        border-bottom: 1px solid #ddd;
        vertical-align: middle; /* Memastikan konten berada di tengah secara vertikal */
    }

    .user-table tbody tr:hover {
        background-color: #f5f5f5; /* Efek hover pada baris */
    }

    /* Styling Aksi (Tombol) */
    .action-button {
        display: inline-block;
        padding: 8px 12px;
        border-radius: 5px;
        text-decoration: none;
        margin-right: 5px;
        font-weight: 500;
        transition: background-color 0.3s ease;
        text-align: center;
        white-space: nowrap; /* Mencegah tombol putus baris */
    }

    .edit-btn {
        background-color: #28a745; /* Hijau */
        color: white;
    }

    .edit-btn:hover {
        background-color: #218838;
    }

    .delete-btn {
        background-color: #dc3545; /* Merah */
        color: white;
        border: none;
        cursor: pointer;
    }

    .delete-btn:hover {
        background-color: #c82333;
    }

    .cannot-delete-btn {
        background-color: #6c757d; /* Abu-abu */
        color: white;
        cursor: not-allowed;
        opacity: 0.6;
    }

    /* Styling Foto Profil */
    .profile-photo {
        width: 40px;
        height: 40px;
        border-radius: 50%; /* Membuat lingkaran */
        object-fit: cover;
        border: 2px solid #ddd;
    }
</style>

<div class="user-management-container">

    <h2 class="page-title text-3xl font-bold">Kelola User 👤</h2>

    @if(session('success'))
        <div class="success-alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="user-table-wrapper">

        <table class="user-table">
            <thead>
                <tr>
                    {{-- <th>Foto</th> --}}
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Kontak</th>
                    <th>Alamat</th>
                    <th>Jenis User</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($users as $user)
                <tr>
                    {{-- Kolom Foto: Asumsi field fotoUser ada, jika tidak, gunakan placeholder --}}
                    {{-- <td>
                        @if ($user->fotoUser)
                            <img src="{{ asset('storage/' . $user->fotoUser) }}" alt="Foto {{ $user->nama }}" class="profile-photo">
                        @else
                            {{-- Placeholder jika tidak ada foto --}}
                            {{-- <div class="profile-photo" style="background-color: #007bff; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;">{{ substr($user->nama, 0, 1) }}</div>
                        @endif
                    </td>  --}}
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->nama }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->kontak }}</td>
                    <td>{{ $user->alamat }}</td>
                    <td>
                        {{-- Memberi highlight pada jenis user --}}
                        <span style="padding: 4px 8px; border-radius: 4px; font-weight: bold; {{ $user->jenisUser === 'admin' ? 'background-color: #ffc107; color: #333;' : 'background-color: #17a2b8; color: white;' }}">
                            {{ ucfirst($user->jenisUser) }}
                        </span>
                    </td>
                    <td>
                        {{-- Tombol Edit --}}
                        <a href="{{ route('admin.users.edit', $user->idUser) }}" 
                            class="action-button edit-btn">
                            ✏️ Edit
                        </a>

                        {{-- Tombol Delete --}}
                        @if ($user->jenisUser !== 'admin')
                            <form action="{{ route('admin.users.destroy', $user->idUser) }}" 
                                method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus user {{ $user->nama }}?')"
                                    class="action-button delete-btn">
                                    🗑️ Delete
                                </button>
                            </form>
                        @else
                            <button class="action-button cannot-delete-btn" disabled>
                                Tidak Dapat Hapus
                            </button>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>

</div>

@endsection