<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Formal #{{ $report->idForm }}</title>

    <style>
        body {
            font-family: 'Times New Roman', serif;
            font-size: 11pt;
            line-height: 1.5;
            margin: 50px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px solid #000;
            padding-bottom: 10px;
        }
        .header h1 { font-size: 20pt; margin: 0; }
        .section-heading {
            font-size: 14pt;
            font-weight: bold;
            margin-top: 30px;
            margin-bottom: 10px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
        }
        .data-table {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }
        .data-table td {
            padding: 8px 0;
            vertical-align: top;
        }
        .data-table td:first-child {
            width: 30%;
            font-weight: bold;
            border-bottom: 1px dotted #eee;
        }
        .data-table td:last-child {
            width: 70%;
            border-bottom: 1px dotted #eee;
        }
        .content-box {
            padding: 15px;
            border: 1px solid #ddd;
            background: #f9f9f9;
            white-space: pre-wrap;
            text-align: justify;
        }
        .cancellation-box {
            border: 2px solid #dc3545;
            background: #f8d7da;
            color: #721c24;
        }
    </style>
</head>

<body>

{{-- HEADER --}}
<div class="header">
    <h1>DOKUMEN LAPORAN RESMI</h1>
    <p>
        Nomor Registrasi: LPR-{{ $report->idForm }} |
        Status: <strong>{{ strtoupper($report->status) }}</strong>
    </p>
</div>


{{-- 1. DATA SISTEM --}}
<div class="section-heading">1.0 INFORMASI SISTEM</div>
<table class="data-table">
    <tr><td>ID Laporan</td><td>{{ $report->idForm }}</td></tr>
    <tr><td>ID User Pelapor</td><td>{{ $report->user_id }}</td></tr>
    <tr><td>Tanggal Dibuat</td><td>{{ $report->created_at }}</td></tr>
    <tr><td>Terakhir Diperbarui</td><td>{{ $report->updated_at }}</td></tr>
</table>


{{-- 2. IDENTITAS PELAPOR --}}
<div class="section-heading">2.0 IDENTITAS PELAPOR</div>
<table class="data-table">
    <tr><td>Nama</td><td>{{ $report->nama_pelapor }}</td></tr>
    <tr><td>Tempat Lahir</td><td>{{ $report->tempat_lahir }}</td></tr>
    <tr><td>Tanggal Lahir</td><td>{{ $report->tanggal_lahir }}</td></tr>
    <tr><td>Agama</td><td>{{ $report->agama }}</td></tr>
    <tr><td>Jenis Kelamin</td><td>{{ $report->jk }}</td></tr>
    <tr><td>Alamat</td><td>{{ $report->alamat }}</td></tr>
    <tr><td>Unsur</td><td>{{ $report->unsur }}</td></tr>
    <tr><td>Jurusan</td><td>{{ $report->jurusan }}</td></tr>
    <tr><td>Program Studi</td><td>{{ $report->prodi }}</td></tr>
    <tr><td>No. HP</td><td>{{ $report->no_hp }}</td></tr>
    <tr><td>Email</td><td>{{ $report->email }}</td></tr>
    <tr><td>Kedudukan</td><td>{{ $report->kedudukan }}</td></tr>
</table>


{{-- 3. IDENTITAS TERLAPOR --}}
<div class="section-heading">3.0 IDENTITAS TERLAPOR</div>
<table class="data-table">
    <tr><td>Pihak Dilaporkan</td><td>{{ $report->pihak_dilaporkan }}</td></tr>
    <tr><td>Nama Terlapor</td><td>{{ $report->nama_terlapor }}</td></tr>
    <tr><td>Jenis Kelamin</td><td>{{ $report->jk_terlapor }}</td></tr>
    <tr><td>Unit Kerja / Divisi</td><td>{{ $report->unit_kerja_terlapor }}</td></tr>
</table>


{{-- 4. KRONOLOGI --}}
<div class="section-heading">4.0 KRONOLOGI KEJADIAN</div>
<div class="content-box">{{ $report->kronologi }}</div>


{{-- 5. TEMPAT & WAKTU --}}
<div class="section-heading">5.0 WAKTU & TEMPAT KEJADIAN</div>
<table class="data-table">
    <tr><td>Tanggal Kejadian</td><td>{{ $report->tanggal_kejadian }}</td></tr>
    <tr><td>Lokasi Kejadian</td><td>{{ $report->tempat_kejadian }}</td></tr>
     <tr><td>Tanggal Melapor</td><td>{{ $report->created_at->translatedFormat('d F Y H:i') }}</td></tr>
</table>


{{-- 6. BANTUAN --}}
<div class="section-heading">6.0 BANTUAN YANG DIPERLUKAN</div>
<div class="content-box">{{ $report->bantuan_yang_diperlukan }}</div>


{{-- 7.0 BUKTI TERLAMPIR --}}
<div class="section-heading">6.0 BUKTI TERLAMPIR</div>

@if($report->bukti)
    <p><strong>Nama file:</strong> {{ $report->bukti }}</p>
    <p><strong>Gambar Bukti:</strong></p>
    <img src="{{ public_path('storage/' . $report->bukti) }}" style="width: 200px;">
@else
    <p>Tidak ada bukti terlampir.</p>
@endif


{{-- 8. ALASAN PEMBATALAN --}}
@if($report->status === 'Dibatalkan')
<div class="section-heading">8.0 ALASAN PEMBATALAN</div>
<div class="content-box cancellation-box">
    {{ $report->alasan_dibatalkan }}
</div>
@endif

</body>
</html>
