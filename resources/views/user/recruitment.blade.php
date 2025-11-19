@extends('layouts.app') {{-- layout khusus user jika ada --}}

@section('content')

<div style="width: 450px; margin: auto; margin-top: 40px;">

    <p style="color:red; font-size:14px; text-align:center;">
        *(Wajib diisi!)* indicated required field!
    </p>

    <form action="{{ route('recruitment.store') }}" 
          method="POST" 
          enctype="multipart/form-data"
          style="border:1px solid #000; padding:25px;">

        @csrf

        <input type="text" name="nama" class="form-control mb-3" placeholder="Nama Lengkap*" required>
        <input type="text" name="nim" class="form-control mb-3" placeholder="NIM*" required>
        <input type="text" name="jurusan" class="form-control mb-3" placeholder="Jurusan*" required>
        <input type="text" name="prodi" class="form-control mb-3" placeholder="Prodi*" required>
        <input type="text" name="ipk" class="form-control mb-3" placeholder="IPK Terakhir*" required>
        <input type="text" name="no_wa" class="form-control mb-3" placeholder="Nomor Whatsapp Aktif*" required>

        <label class="mt-1">Pas Foto*</label>
        <input type="file" name="pas_foto" class="form-control mb-3" required>

        <label>CV*</label>
        <input type="file" name="cv" class="form-control mb-3" required>

        <label>Essay*</label>
        <input type="file" name="essay" class="form-control mb-3" required>

        <div style="display:flex; justify-content:space-between; margin-top:20px;">
            <a href="{{ route('user.dashboard') }}" class="btn btn-secondary">BACK</a>
            <button type="submit" class="btn btn-primary">SUBMIT</button>
        </div>

    </form>

</div>

@endsection
