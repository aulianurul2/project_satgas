@extends('layouts.app')

@section('content')

{{-- 1. STYLE CSS (Konsisten dengan Kelola Anggota) --}}
<style>
    /* Container & Title */
    .page-container { max-width: 1200px; margin: 0 auto; padding: 20px; }
    .page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; border-bottom: 3px solid #007bff; padding-bottom: 10px; }
    .page-title { font-size: 1.8rem; font-weight: bold; color: #333; margin: 0; }

    /* Buttons */
    .btn-add { background-color: #007bff; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-weight: 600; transition: 0.3s; display: inline-block; }
    .btn-add:hover { background-color: #0056b3; }

    /* Table Styling */
    .table-responsive { background-color: #fff; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); border-radius: 8px; overflow-x: auto; }
    .custom-table { width: 100%; border-collapse: collapse; text-align: left; min-width: 800px; }
    .custom-table thead tr { background-color: #007bff; color: #ffffff; }
    .custom-table th, .custom-table td { padding: 12px 15px; border-bottom: 1px solid #ddd; vertical-align: middle; }
    .custom-table tbody tr:hover { background-color: #f5f5f5; }

    /* Action Buttons (Solid Style) */
    .action-btn {
        display: inline-flex; align-items: center; justify-content: center;
        padding: 8px 16px; border-radius: 6px; text-decoration: none;
        font-size: 14px; font-weight: 600; border: none; cursor: pointer;
        color: white; transition: all 0.2s ease-in-out;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    .action-btn span { margin-right: 8px; }

    /* Warna Tombol */
    .btn-edit { background-color: #28a745; margin-right: 8px; } /* Hijau */
    .btn-edit:hover { background-color: #218838; box-shadow: 0 4px 8px rgba(0,0,0,0.15); }

    .btn-delete { background-color: #dc3545; } /* Merah */
    .btn-delete:hover { background-color: #c82333; box-shadow: 0 4px 8px rgba(0,0,0,0.15); }

    /* Thumbnail Gambar */
    .img-thumbnail {
        width: 60px; height: 60px; object-fit: cover; 
        border-radius: 6px; border: 1px solid #ddd;
    }

    /* CSS MODAL POPUP */
    .modal-overlay { display: none; position: fixed; z-index: 9999; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); backdrop-filter: blur(2px); }
    .modal-content { background-color: #fefefe; margin: 15% auto; padding: 0; border: 1px solid #888; width: 90%; max-width: 450px; border-radius: 8px; box-shadow: 0 5px 15px rgba(0,0,0,0.3); animation: slideDown 0.3s; }
    .modal-header { background-color: #dc3545; color: white; padding: 15px; font-weight: bold; display: flex; justify-content: space-between; align-items: center; border-top-left-radius: 8px; border-top-right-radius: 8px; }
    .modal-body { padding: 20px; text-align: center; color: #333; }
    .modal-footer { padding: 15px; background-color: #f1f1f1; display: flex; justify-content: flex-end; gap: 10px; border-bottom-left-radius: 8px; border-bottom-right-radius: 8px; }
    .btn-modal-cancel { background-color: #6c757d; color: white; padding: 8px 16px; border: none; border-radius: 4px; cursor: pointer; }
    .btn-modal-confirm { background-color: #dc3545; color: white; padding: 8px 16px; border: none; border-radius: 4px; cursor: pointer; }
    @keyframes slideDown { from {transform: translateY(-50px); opacity: 0;} to {transform: translateY(0); opacity: 1;} }
</style>

<div class="page-container">

    {{-- Header --}}
    <div class="page-header">
        <h1 class="page-title">Kelola Media / Berita</h1>
        <a href="{{ route('admin.media.create') }}" class="btn-add">+ Tambah Media</a>
    </div>

    {{-- Alert Success --}}
    @if (session('success'))
        <div style="background-color: #d4edda; color: #155724; padding: 15px; border-radius: 5px; margin-bottom: 20px; border: 1px solid #c3e6cb;">
            {{ session('success') }}
        </div>
    @endif

    {{-- Tabel Data --}}
    <div class="table-responsive">
        <table class="custom-table">
            <thead>
                <tr>
                    <th style="width: 5%;">No</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Gambar</th>
                    <th style="width: 18%;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($media as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td style="font-weight: 500;">{{ $item->judul }}</td>
                    <td>{{ $item->kategori }}</td>
                    <td>
                        @if($item->gambar)
                            <img src="{{ asset('storage/' . $item->gambar) }}" class="img-thumbnail" alt="Thumbnail">
                        @else
                            <span style="color: #999; font-style: italic; font-size: 0.9em;">No Image</span>
                        @endif
                    </td>
                    <td>
                        {{-- Tombol Edit (Hijau) --}}
                        <a href="{{ route('admin.media.edit', $item->id) }}" class="action-btn btn-edit">
                            <span>✏️</span> Edit
                        </a>

                        {{-- Tombol Hapus (Merah - Pemicu Modal) --}}
                        <button type="button" 
                                class="action-btn btn-delete" 
                                onclick="showDeleteModal('{{ route('admin.media.destroy', $item->id) }}', '{{ $item->judul }}')">
                            <span>🗑️</span> Hapus
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align: center; padding: 20px; color: #777;">
                        Belum ada data media/berita.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div style="margin-top: 20px;">
        {{ $media->links() }}
    </div>
</div>

{{-- 2. HTML MODAL (Pop-up) --}}
<div id="deleteModal" class="modal-overlay">
    <div class="modal-content">
        <div class="modal-header">
            <span>Konfirmasi Hapus</span>
            <span style="cursor: pointer;" onclick="closeDeleteModal()">✖</span>
        </div>
        <div class="modal-body">
            <p>Apakah Anda yakin ingin menghapus berita:</p>
            {{-- Menampilkan Judul Berita yang akan dihapus --}}
            <h3 id="modalItemName" style="font-weight: bold; margin: 10px 0;">Judul Berita</h3>
            <p style="font-size: 0.9em; color: #666;">Data yang dihapus tidak dapat dikembalikan.</p>
        </div>
        <div class="modal-footer">
            <button class="btn-modal-cancel" onclick="closeDeleteModal()">Batal</button>
            <form id="deleteForm" action="" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-modal-confirm">Ya, Hapus</button>
            </form>
        </div>
    </div>
</div>

{{-- 3. JAVASCRIPT --}}
<script>
    function showDeleteModal(actionUrl, itemName) {
        document.getElementById('deleteForm').action = actionUrl;
        document.getElementById('modalItemName').innerText = itemName;
        document.getElementById('deleteModal').style.display = 'block';
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').style.display = 'none';
    }

    window.onclick = function(event) {
        var modal = document.getElementById('deleteModal');
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>

@endsection