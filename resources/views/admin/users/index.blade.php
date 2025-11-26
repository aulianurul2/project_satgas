@extends('layouts.app')

@section('content')

{{-- Tambahkan styling CSS di sini. --}}
<style>
    /* --- Styling yang sudah ada (Tidak diubah) --- */
    .user-management-container { max-width: 1200px; margin: 0 auto; padding: 20px; }
    .page-title { color: #333; border-bottom: 3px solid #007bff; padding-bottom: 10px; margin-bottom: 25px; }
    .success-alert { padding: 15px; margin-bottom: 20px; border: 1px solid transparent; border-radius: 4px; color: #155724; background-color: #d4edda; border-color: #c3e6cb; font-weight: bold; }
    .user-table-wrapper { background-color: #fff; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); border-radius: 8px; overflow-x: auto; }
    .user-table { width: 100%; border-collapse: collapse; text-align: left; }
    .user-table thead tr { background-color: #007bff; color: #ffffff; }
    .user-table th, .user-table td { padding: 12px 15px; border-bottom: 1px solid #ddd; vertical-align: middle; }
    .user-table tbody tr:hover { background-color: #f5f5f5; }
    .action-button { display: inline-block; padding: 8px 12px; border-radius: 5px; text-decoration: none; margin-right: 5px; font-weight: 500; transition: background-color 0.3s ease; text-align: center; white-space: nowrap; color: white; border: none; cursor: pointer; font-size: 14px;} /* Update: added common props */
    .edit-btn { background-color: #28a745; }
    .edit-btn:hover { background-color: #218838; }
    .delete-btn { background-color: #dc3545; }
    .delete-btn:hover { background-color: #c82333; }
    .cannot-delete-btn { background-color: #6c757d; cursor: not-allowed; opacity: 0.6; }
    .profile-photo { width: 40px; height: 40px; border-radius: 50%; object-fit: cover; border: 2px solid #ddd; }

    /* --- BARU: Styling untuk Custom Modal Pop-up --- */
    .modal-overlay {
        display: none; /* Tersembunyi default */
        position: fixed;
        z-index: 9999;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.5); /* Latar belakang transparan gelap */
        backdrop-filter: blur(2px); /* Efek blur halus */
        animation: fadeIn 0.3s;
    }

    .modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 0;
        border: 1px solid #888;
        width: 100%;
        max-width: 500px;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        animation: slideIn 0.3s;
        overflow: hidden;
    }

    .modal-header {
        background-color: #dc3545; /* Warna Merah Warning */
        color: white;
        padding: 15px 20px;
        font-size: 18px;
        font-weight: bold;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .modal-body {
        padding: 20px;
        font-size: 16px;
        color: #333;
        text-align: center;
    }

    .modal-footer {
        padding: 15px 20px;
        background-color: #f9f9f9;
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        border-top: 1px solid #eee;
    }

    .btn-cancel {
        background-color: #6c757d;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-weight: 500;
    }
    .btn-cancel:hover { background-color: #5a6268; }

    .btn-confirm {
        background-color: #dc3545;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-weight: 500;
    }
    .btn-confirm:hover { background-color: #c82333; }

    /* Animasi */
    @keyframes fadeIn { from {opacity: 0;} to {opacity: 1;} }
    @keyframes slideIn { from {transform: translateY(-50px);} to {transform: translateY(0);} }
</style>

<div class="user-management-container">

    <h2 class="page-title text-3xl font-bold">Kelola User</h2>

    @if(session('success'))
        <div class="success-alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="user-table-wrapper">
        <table class="user-table">
            <thead>
                <tr>
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
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->nama }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->kontak }}</td>
                    <td>{{ $user->alamat }}</td>
                    <td>
                        <span style="padding: 4px 8px; border-radius: 4px; font-weight: bold; {{ $user->jenisUser === 'admin' ? 'background-color: #ffc107; color: #333;' : 'background-color: #17a2b8; color: white;' }}">
                            {{ ucfirst($user->jenisUser) }}
                        </span>
                    </td>
                    <td>
                        {{-- Tombol Edit --}}
                        <a href="{{ route('admin.users.edit', $user->idUser) }}" class="action-button edit-btn">
                            ✏️ Edit
                        </a>

                        {{-- Tombol Delete (UPDATED) --}}
                        @if ($user->jenisUser !== 'admin')
                            <button type="button" 
                                    class="action-button delete-btn"
                                    onclick="showDeleteModal('{{ route('admin.users.destroy', $user->idUser) }}', '{{ $user->nama }}')">
                                🗑️ Delete
                            </button>
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

<div id="deleteModal" class="modal-overlay">
    <div class="modal-content">
        <div class="modal-header">
            <span>Konfirmasi Hapus</span>
            <span style="cursor: pointer;" onclick="closeDeleteModal()">✖</span>
        </div>
        <div class="modal-body">
            <p>Apakah Anda yakin ingin menghapus user:</p>
            <h3 id="modalUserName" style="font-weight: bold; margin: 10px 0;">Nama User</h3>
            <p style="font-size: 0.9em; color: #666;">Tindakan ini tidak dapat dibatalkan.</p>
        </div>
        <div class="modal-footer">
            <button class="btn-cancel" onclick="closeDeleteModal()">Batal</button>
            
            <form id="deleteForm" action="" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-confirm">Ya, Hapus</button>
            </form>
        </div>
    </div>
</div>

{{-- SCRIPT JAVASCRIPT --}}
<script>
    // Fungsi untuk membuka modal
    function showDeleteModal(actionUrl, userName) {
        // 1. Set URL form action sesuai ID user yang diklik
        document.getElementById('deleteForm').action = actionUrl;
        
        // 2. Set nama user di dalam modal agar informatif
        document.getElementById('modalUserName').innerText = userName;
        
        // 3. Tampilkan modal
        document.getElementById('deleteModal').style.display = 'block';
    }

    // Fungsi untuk menutup modal
    function closeDeleteModal() {
        document.getElementById('deleteModal').style.display = 'none';
    }

    // Menutup modal jika user klik di luar kotak modal (overlay)
    window.onclick = function(event) {
        var modal = document.getElementById('deleteModal');
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>

@endsection