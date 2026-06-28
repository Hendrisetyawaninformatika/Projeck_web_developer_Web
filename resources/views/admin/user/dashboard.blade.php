@extends('layouts.user')

@section('title', 'Dashboard')

@section('content')
<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-4 p-4">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0">
                    <div class="bg-warning bg-opacity-25 rounded-3 d-flex align-items-center justify-content-center" 
                         style="width: 60px; height: 60px;">
                        <i class="bi bi-cart-check fs-3 text-warning"></i>
                    </div>
                </div>
                <div class="flex-grow-1 ms-3">
                    <h6 class="text-muted mb-1">Total Pesanan</h6>
                    <h3 class="fw-bold mb-0">{{ $totalPesanan ?? 0 }}</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-4 p-4">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0">
                    <div class="bg-info bg-opacity-25 rounded-3 d-flex align-items-center justify-content-center" 
                         style="width: 60px; height: 60px;">
                        <i class="bi bi-hourglass-split fs-3 text-info"></i>
                    </div>
                </div>
                <div class="flex-grow-1 ms-3">
                    <h6 class="text-muted mb-1">Dalam Proses</h6>
                    <h3 class="fw-bold mb-0">{{ $pesananDiproses ?? 0 }}</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-4 p-4">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0">
                    <div class="bg-success bg-opacity-25 rounded-3 d-flex align-items-center justify-content-center" 
                         style="width: 60px; height: 60px;">
                        <i class="bi bi-check-circle fs-3 text-success"></i>
                    </div>
                </div>
                <div class="flex-grow-1 ms-3">
                    <h6 class="text-muted mb-1">Selesai</h6>
                    <h3 class="fw-bold mb-0">{{ $pesananSelesai ?? 0 }}</h3>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Orders -->
<div class="card border-0 shadow-sm rounded-4">
    <div class="card-header bg-white border-0 pt-4 px-4">
        <h5 class="fw-bold mb-0">Pesanan Terbaru</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Kode</th>
                        <th>Nama Proyek</th>
                        <th>Paket</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentPesanans ?? [] as $pesanan)
                    <tr>
                        <td><span class="fw-bold">#{{ $pesanan->kode_pesanan }}</span></td>
                        <td>{{ Str::limit($pesanan->nama_proyek, 30) }}</td>
                        <td>{{ $pesanan->paket->nama }}</td>
                        <td>{!! $pesanan->status_badge !!}</td>
                        <td>{{ $pesanan->created_at->format('d M Y') }}</td>
                        <td>
                            <a href="{{ route('user.pesanans.show', $pesanan) }}" class="btn btn-sm btn-warning">
                                <i class="bi bi-eye"></i> Detail
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">
                            Belum ada pesanan. <a href="{{ route('pemesanan') }}" class="text-warning">Buat pesanan sekarang!</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection