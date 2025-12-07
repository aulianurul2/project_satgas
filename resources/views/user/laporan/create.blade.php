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
        <h1 class="form-title">Formulir Pelaporan Satgas PPKPT</h1>
        <p class="form-subtitle">Silakan isi formulir pelaporan berikut dengan data yang benar. Seluruh data isian akan <strong>dirahasiakan</strong>.</p>

                    @if ($errors->any())
                <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

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
                        <input type="text" name="nama_pelapor" value="{{ old('nama_pelapor') }}" class="input" required>
                    </div>
                    <div>
                        <label>Tempat Lahir *</label>
                        <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir') }}" class="input" required>
                    </div>

                    <div>
                        <label>Tanggal Lahir *</label>
                        <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" class="input" required>
                    </div>
                    <div>
                    <label>Agama *</label>
                    <select name="agama" class="input" required>
                        <option value="">Pilih</option>
                        <option value="Islam" {{ old('agama') == 'Islam' ? 'selected' : '' }}>Islam</option>
                        <option value="Kristen Protestan" {{ old('agama') == 'Kristen Protestan' ? 'selected' : '' }}>Kristen Protestan</option>
                        <option value="Katolik" {{ old('agama') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                        <option value="Hindu" {{ old('agama') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                        <option value="Buddha" {{ old('agama') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                        <option value="Konghucu" {{ old('agama') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                        <option value="Lainnya" {{ old('agama') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>

                </div>

                    <div>
                        <label>Jenis Kelamin *</label>
                        <select name="jk" class="input" required>
                            <option value="">Pilih</option>
                            <option value="Laki-laki" {{ old('jk')=='Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ old('jk')=='Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>

                    </div>
                    <div>
                        <label>Alamat *</label>
                        <input type="text" name="alamat" value="{{ old('alamat') }}" class="input" required>
                    </div>
                    <div>
                        <label>Unsur *</label>
                        <select name="unsur" class="input" required>
                            <option value="">Pilih</option>
                            <option value="Dosen" {{ old('unsur')=='Dosen' ? 'selected' : '' }}>Dosen</option>
                            <option value="Mahasiswa" {{ old('unsur')=='Mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                            <option value="Tendik" {{ old('unsur')=='Tendik' ? 'selected' : '' }}>Tendik</option>
                            <option value="Lainnya" {{ old('unsur')=='Lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>

                    </div>
                   <div>
                    <label>Asal Jurusan *</label>
                    <select name="jurusan" id="jurusan" class="input" required onchange="toggleJurusanLainnya()">
                    <option value="">Pilih</option>
                    <option value="Jurusan Teknologi Informasi dan Komputer" {{ old('jurusan') == 'Jurusan Teknologi Informasi dan Komputer' ? 'selected' : '' }}>JurTekKom</option>
                    <option value="Jurusan Kesehatan" {{ old('jurusan') == 'Jurusan Kesehatan' ? 'selected' : '' }}>Kesehatan</option>
                    <option value="Jurusan Teknik Mesin" {{ old('jurusan') == 'Jurusan Teknik Mesin' ? 'selected' : '' }}>Teknik Mesin</option>
                    <option value="Jurusan Pertanian" {{ old('jurusan') == 'Jurusan Pertanian' ? 'selected' : '' }}>Pertanian</option>
                    <option value="Lainnya" {{ old('jurusan') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                </select>

                <input type="text"
                    id="jurusan_lainnya"
                    name="jurusan_lainnya"
                    class="input"
                    placeholder="Isi jurusan lainnya"
                    value="{{ old('jurusan_lainnya') }}"
                    style="margin-top:5px; {{ old('jurusan') == 'Lainnya' ? '' : 'display:none;' }}">
                </div>


                     <div>
                    <label>Asal Prodi *</label>
                    <select name="prodi" id="prodi" class="input" required onchange="toggleInput('prodi')">
                        <option value="">Pilih</option>
                        <option value="D3-Sistem Informasi" {{ old('prodi')=='D3-Sistem Informasi' ? 'selected' : '' }}>D3-Sistem Informasi</option>
                        <option value="D3-Keperawatan" {{ old('prodi')=='D3-Keperawatan' ? 'selected' : '' }}>D3-Keperawatan</option>
                        <option value="D3-Agroindustri" {{ old('prodi')=='D3-Agroindustri' ? 'selected' : '' }}>D3-Agroindustri</option>
                        <option value="D3-Pemeliharaan Mesin" {{ old('prodi')=='D3-Pemeliharaan Mesin' ? 'selected' : '' }}>D3-Pemeliharaan Mesin</option>
                        <option value="D4-TRPL" {{ old('prodi')=='D4-TRPL' ? 'selected' : '' }}>D4-TRPL</option>
                        <option value="D4-TPTP" {{ old('prodi')=='D4-TPTP' ? 'selected' : '' }}>D4-TPTP</option>
                        <option value="D4-TRM" {{ old('prodi')=='D4-TRM' ? 'selected' : '' }}>D4-TRM</option>
                        <option value="Lainnya" {{ old('prodi')=='Lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>

                    <input type="text" id="prodi_lainnya" name="prodi_lainnya"
                        class="input"
                        placeholder="Isi prodi lainnya"
                        value="{{ old('prodi_lainnya') }}"
                        style="margin-top:5px; {{ old('prodi')=='Lainnya' ? '' : 'display:none;' }}">
                                    </div>

                    <div>
                        <label>Nomor HP/WA *</label>
                        <input type="text" name="no_hp" value="{{ old('no_hp') }}" class="input" required>
                    </div>
                    <div>
                        <label>Email *</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="input" required>
                    </div>
                    <div>
                        <label>Kedudukan Pelapor *</label>
                        <select name="kedudukan" class="input" required>
                            <option value="">Pilih</option>
                            <option value="Korban" {{ old('kedudukan')=='Korban' ? 'selected' : '' }}>Korban</option>
                            <option value="Saksi" {{ old('kedudukan')=='Saksi' ? 'selected' : '' }}>Saksi</option>
                            <option value="Perwakilan Korban" {{ old('kedudukan')=='Perwakilan Korban' ? 'selected' : '' }}>Perwakilan Korban</option>
                            <option value="Lainnya" {{ old('kedudukan')=='Lainnya' ? 'selected' : '' }}>Lainnya</option>
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
                            <option value="Dosen" {{ old('pihak_dilaporkan')=='Dosen' ? 'selected' : '' }}>Dosen</option>
                            <option value="Mahasiswa" {{ old('pihak_dilaporkan')=='Mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                            <option value="Tendik" {{ old('pihak_dilaporkan')=='Tendik' ? 'selected' : '' }}>Tendik</option>
                            <option value="Lainnya" {{ old('pihak_dilaporkan')=='Lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>

                    </div>
                    <div>
                        <label>Nama Terlapor</label>
                        <input type="text" name="nama_terlapor" value="{{ old('nama_terlapor') }}" class="input">
                    </div>
                    <div>
                        <label>Jenis Kelamin Terlapor</label>
                        <select name="jk_terlapor" class="input">
                            <option value="">Pilih</option>
                            <option value="Laki-laki" {{ old('jk_terlapor')=='Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ old('jk_terlapor')=='Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>

                    </div>
                    <div>
                        <label>Unit Kerja Terlapor</label>
                        <input type="text" name="unit_kerja_terlapor" value="{{ old('unit_kerja_terlapor') }}" class="input">
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
                        <input type="date" name="tanggal_kejadian" value="{{ old('tanggal_kejadian') }}" class="input" required>
                    </div>
                    <div>
                        <label>Tempat Kejadian *</label>
                        <input type="text" name="tempat_kejadian" value="{{ old('tempat_kejadian') }}" class="input" required>
                    </div>
                </div>

                <div class="field">
                    <label>Kronologi Kejadian *</label>
                    <textarea name="kronologi" class="input" rows="5" required>{{ old('kronologi') }}</textarea>
                </div>

                <div class="field">
                    <label>Bantuan yang Diperlukan *</label>
                    <textarea name="bantuan_yang_diperlukan" class="input" rows="3" required>{{ old('bantuan_yang_diperlukan') }}</textarea>
                </div>

                <div class="field">
                    <label>Unggah Bukti (Opsional)</label>
                    <input type="file" name="bukti" value="{{ old('bukti') }}" class="input">
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
<script>
function toggleJurusanLainnya() {
    const jurusan = document.getElementById('jurusan');
    const lainnya = document.getElementById('jurusan_lainnya');
    lainnya.style.display = jurusan.value === 'Lainnya' ? 'block' : 'none';
}
</script>
<script>
function toggleInput(field) {
    const select = document.getElementById(field);
    const input = document.getElementById(field + '_lainnya');

    if (select.value === 'Lainnya') {
        input.style.display = 'block';
        input.required = true;
    } else {
        input.style.display = 'none';
        input.required = false;
        input.value = '';
    }
}




function toggleInput(id) {
    const select = document.getElementById(id);
    const inputLainnya = document.getElementById(id + '_lainnya');

    if (select.value === "Lainnya") {
        inputLainnya.style.display = "block";
    } else {
        inputLainnya.style.display = "none";
    }
}

</script>

@endsection
