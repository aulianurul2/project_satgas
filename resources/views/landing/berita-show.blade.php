@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <h2 class="fw-bold mb-3">{{ $media->judul }}</h2>
            <p class="text-muted mb-4">{{ $media->kategori ?? 'Tanpa Kategori' }} • {{ $media->created_at->format('d M Y') }}</p>

            @if ($media->gambar)
                <img src="{{ asset('storage/' . $media->gambar) }}" class="img-fluid rounded mb-4" alt="{{ $media->judul }}">
            @endif

            <div class="content">
                {!! nl2br(e($media->isi)) !!}
            </div>

            <a href="{{ url('/') }}" class="btn btn-outline-primary mt-4">← Kembali ke Beranda</a>
        </div>
    </div>
</div>
@endsection
 