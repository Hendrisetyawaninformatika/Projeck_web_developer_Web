@extends('layouts.admin')

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
                        <h6 class="fw-bold text-muted mb-2">Pelanggan</h6>
                        <p class="mb-0">{{ $pesanan->user->name }}</p>
                        <small class="text-muted">{{ $pesanan->user->email }}</small>
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
                        <h6 class="fw-bold text-muted mb-2">Nama Proyek</h6>
                        <p class="mb-0">{{ $pesanan->nama_proyek }}</p>
                    </div>
                    <div class="col-12">
                        <h6 class="fw-bold text-muted mb-2">Deskripsi Proyek</h6>
                        <p class="mb-0">{{ $pesanan->deskripsi_proyek }}</p>
                    </div>
                    @if($pesanan->file_url)
                    <div class="col-12">
                        <h6 class="fw-bold text-muted mb-2">File Referensi</h6>
                        <a href="{{ $pesanan->file_url }}" target="_blank" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-file-earmark me-1"></i>Lihat File
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Update Status -->
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-white border-0 pt-4 px-4">
                <h5 class="fw-bold mb-0">Update Status</h5>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('admin.pesanans.update', $pesanan) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Status Pesanan</label>
                        <select name="status" class="form-select">
                            <option value="pending" {{ $pesanan->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="diproses" {{ $pesanan->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                            <option value="revisi" {{ $pesanan->status == 'revisi' ? 'selected' : '' }}>Revisi</option>
                            <option value="selesai" {{ $pesanan->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            <option value="dibatalkan" {{ $pesanan->status == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Catatan Admin</label>
                        <textarea name="catatan_admin" class="form-control" rows="3" placeholder="Tambahkan catatan untuk pelanggan...">{{ $pesanan->catatan_admin }}</textarea>
                    </div>
                    
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.pesanans.index') }}" class="btn btn-outline-secondary">Kembali</a>
                        <button type="submit" class="btn btn-admin-primary">
                            <i class="bi bi-save me-2"></i>Update Status
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection