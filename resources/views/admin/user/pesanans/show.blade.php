@extends('layouts.user')

@section('title', 'Detail Pesanan')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-header bg-white border-0 pt-4 px-4 d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="fw-bold mb-1">Detail Pesanan</h5>
                    <p class="text-muted mb-0">#{{ $pesanan->kode_pesanan }}</p>
                </div>
                <div>{!! $pesanan->status_badge !!}</div>
            </div>
            <div class="card-body p-4">
                <div class="row g-4">
                    <div class="col-md-6">
                        <h6 class="fw-bold text-muted mb-2">Nama Proyek</h6>
                        <p class="mb-0">{{ $pesanan->nama_proyek }}</p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="fw-bold text-muted mb-2">Paket</h6>
                        <p class="mb-0">{{ $pesanan->paket->nama }}</p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="fw-bold text-muted mb-2">Harga</h6>
                        <p class="mb-0 fw-bold">Rp {{ number_format($pesanan->harga, 0, ',', '.') }}</p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="fw-bold text-muted mb-2">Deadline</h6>
                        <p class="mb-0">{{ $pesanan->deadline->format('d F Y') }}</p>
                    </div>
                    <div class="col-12">
                        <h6 class="fw-bold text-muted mb-2">Deskripsi Proyek</h6>
                        <p class="mb-0">{{ $pesanan->deskripsi_proyek }}</p>
                    </div>
                    @if($pesanan->logo_url)
                    <div class="col-md-6">
                        <h6 class="fw-bold text-muted mb-2">Logo/Referensi</h6>
                        <a href="{{ $pesanan->logo_url }}" target="_blank" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-file-earmark-image me-1"></i>Lihat File
                        </a>
                    </div>
                    @endif
                    @if($pesanan->catatan_admin)
                    <div class="col-12">
                        <div class="alert alert-info">
                            <h6 class="fw-bold mb-1"><i class="bi bi-info-circle me-2"></i>Catatan Admin</h6>
                            <p class="mb-0">{{ $pesanan->catatan_admin }}</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            <div class="card-footer bg-white border-0 p-4">
                <a href="https://wa.me/6281234567890?text=Halo%20Admin,%20saya%20ingin%20menanyakan%20pesanan%20{{ $pesanan->kode_pesanan }}" 
                   target="_blank" class="btn btn-success">
                    <i class="bi bi-whatsapp me-2"></i>Chat Admin
                </a>
                <a href="{{ route('user.pesanans.index') }}" class="btn btn-outline-secondary ms-2">
                    <i class="bi bi-arrow-left me-2"></i>Kembali
                </a>
            </div>
        </div>
    </div>
</div>
@endsection