@extends('layouts.app')

@section('content')
<div class="container">
    {{-- ✅ Notifikasi sukses --}}
    @if(session('success'))
        <div style="background:#d1fae5; color:#065f46; padding:10px; border-radius:5px; margin-bottom:15px;">
            {{ session('success') }}
        </div>
    @endif

    <div class="form-card">
        <h1 class="form-title">Formulir Pelaporan Satgas PPKS</h1>
        <p class="form-subtitle">Silakan isi formulir pelaporan berikut dengan data yang benar. Seluruh data isian akan <strong>dirahasiakan</strong>.</p>

        <form id="reportForm" action="{{ route('user.laporan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Step Indicators -->
            <div class="step-indicators">
                <div class="step-indicator active" data-step="1">Identitas Pelapor</div>
                <div class="line"></div>
                <div class="step-indicator" data-step="2">Identitas Terlapor</div>
                <div class="line"></div>
                <div class="step-indicator" data-step="3">Peristiwa Kejadian</div>
            </div>

            <!-- STEP 1 -->
            <div class="form-step" id="step-1">
                <h2 class="step-title">Identitas Pelapor</h2>

                <div class="grid">
                    <div>
                        <label>Nama Pelapor *</label>
                        <input type="text" name="nama_pelapor" class="input" required>
                    </div>
                    <div>
                        <label>Tempat Tanggal Lahir *</label>
                        <input type="text" name="TTL" class="input" required>
                    </div>
                    <div>
                        <label>Agama *</label>
                        <input type="text" name="agama" class="input" required>
                    </div>
                    <div>
                        <label>Jenis Kelamin *</label>
                        <select name="jk" class="input" required>
                            <option value="">Pilih</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div>
                        <label>Alamat *</label>
                        <input type="text" name="alamat" class="input" required>
                    </div>
                    <div>
                        <label>Unsur *</label>
                        <select name="unsur" class="input" required>
                            <option value="">Pilih</option>
                            <option value="Dosen">Dosen</option>
                            <option value="Mahasiswa">Mahasiswa</option>
                            <option value="Tendik">Tendik</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>
                    <div>
                        <label>Asal Jurusan</label>
                        <input type="text" name="jurusan" class="input">
                    </div>
                    <div>
                        <label>Asal Prodi</label>
                        <input type="text" name="prodi" class="input">
                    </div>
                    <div>
                        <label>Nomor HP/WA *</label>
                        <input type="text" name="no_hp" class="input" required>
                    </div>
                    <div>
                        <label>Email *</label>
                        <input type="email" name="email" class="input" required>
                    </div>
                    <div>
                        <label>Kedudukan Pelapor *</label>
                        <select name="kedudukan" class="input" required>
                            <option value="">Pilih</option>
                            <option value="Korban">Korban</option>
                            <option value="Saksi">Saksi</option>
                            <option value="Perwakilan Korban">Perwakilan Korban</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>
                </div>

                <div class="button-group right">
                    <button type="button" class="next-step btn-primary">Selanjutnya</button>
                </div>
            </div>

            <!-- STEP 2 -->
            <div class="form-step hidden" id="step-2">
                <h2 class="step-title">Identitas Terlapor</h2>

                <div class="grid">
                    <div>
                        <label>Pihak yang Dilaporkan *</label>
                        <select name="pihak_dilaporkan" class="input" required>
                            <option value="">Pilih</option>
                            <option value="Dosen">Dosen</option>
                            <option value="Mahasiswa">Mahasiswa</option>
                            <option value="Tendik">Tendik</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>
                    <div>
                        <label>Nama Terlapor</label>
                        <input type="text" name="nama_terlapor" class="input">
                    </div>
                    <div>
                        <label>Jenis Kelamin Terlapor</label>
                        <select name="jk_terlapor" class="input">
                            <option value="">Pilih</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div>
                        <label>Unit Kerja Terlapor</label>
                        <input type="text" name="unit_kerja_terlapor" class="input">
                    </div>
                </div>

                <div class="button-group between">
                    <button type="button" class="prev-step btn-secondary">Sebelumnya</button>
                    <button type="button" class="next-step btn-primary">Selanjutnya</button>
                </div>
            </div>

            <!-- STEP 3 -->
            <div class="form-step hidden" id="step-3">
                <h2 class="step-title">Peristiwa Kejadian</h2>

                <div class="grid">
                    <div>
                        <label>Tanggal Kejadian *</label>
                        <input type="date" name="tanggal_kejadian" class="input" required>
                    </div>
                    <div>
                        <label>Tempat Kejadian *</label>
                        <input type="text" name="tempat_kejadian" class="input" required>
                    </div>
                </div>

                <div class="field">
                    <label>Kronologi Kejadian *</label>
                    <textarea name="kronologi" class="input" rows="5" required></textarea>
                </div>

                <div class="field">
                    <label>Bantuan yang Diperlukan *</label>
                    <textarea name="bantuan_yang_diperlukan" class="input" rows="3" required></textarea>
                </div>

                <div class="field">
                    <label>Unggah Bukti (Opsional)</label>
                    <input type="file" name="bukti" class="input">
                </div>

                <div class="button-group between">
                    <button type="button" class="prev-step btn-secondary">Sebelumnya</button>
                    <button type="submit" class="btn-primary">Kirim Laporan</button>
                </div>
            </div>
        </form>
    </div>
</div>

<style>
body {
    background: #f5f6fa;
    font-family: 'Poppins', sans-serif;
}
.container {
    max-width: 900px;
    margin: 50px auto;
}
.form-card {
    background: white;
    border-radius: 16px;
    padding: 40px;
    box-shadow: 0 5px 25px rgba(0,0,0,0.1);
    border-top: 6px solid #1d4ed8;
}
.form-title {
    text-align: center;
    color: #1d4ed8;
    font-size: 28px;
    font-weight: 700;
}
.form-subtitle {
    text-align: center;
    color: #555;
    margin-bottom: 30px;
}

.step-indicators {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 12px;
    margin-bottom: 35px;
}
.step-indicator {
    padding: 8px 16px;
    border-radius: 50px;
    border: 1px solid #ccc;
    font-weight: 600;
    font-size: 14px;
    color: #555;
}
.step-indicator.active {
    background: #1d4ed8;
    color: white;
    border-color: #1d4ed8;
}
.line {
    width: 50px;
    height: 3px;
    background: #d1d5db;
}
.hidden { display: none; }

.grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
}
.input {
    width: 100%;
    border: 1px solid #ccc;
    border-radius: 6px;
    padding: 10px;
    font-size: 14px;
    margin-top: 5px;
    box-sizing: border-box;
}
.input:focus {
    outline: none;
    border-color: #2563eb;
    box-shadow: 0 0 0 2px rgba(37,99,235,0.2);
}
.btn-primary, .btn-secondary {
    border: none;
    border-radius: 6px;
    padding: 10px 24px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s ease-in-out;
}
.btn-primary {
    background: #1d4ed8;
    color: white;
}
.btn-primary:hover {
    background: #1e40af;
}
.btn-secondary {
    background: #9ca3af;
    color: white;
}
.btn-secondary:hover {
    background: #6b7280;
}
.button-group {
    margin-top: 25px;
    display: flex;
    gap: 10px;
}
.button-group.right {
    justify-content: flex-end;
}
.button-group.between {
    justify-content: space-between;
}
.step-title {
    font-size: 22px;
    font-weight: 600;
    color: #1d4ed8;
    margin-bottom: 20px;
}
.field {
    margin-top: 15px;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const steps = document.querySelectorAll('.form-step');
    const indicators = document.querySelectorAll('.step-indicator');
    let currentStep = 0;

    document.querySelectorAll('.next-step').forEach(btn => {
        btn.addEventListener('click', () => changeStep(1));
    });
    document.querySelectorAll('.prev-step').forEach(btn => {
        btn.addEventListener('click', () => changeStep(-1));
    });

    function changeStep(direction) {
        steps[currentStep].classList.add('hidden');
        indicators[currentStep].classList.remove('active');
        currentStep += direction;
        steps[currentStep].classList.remove('hidden');
        indicators[currentStep].classList.add('active');
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }
});
</script>
@endsection
