@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">Dashboard</h4>
        <p class="text-muted mb-0">Selamat datang kembali, {{ auth()->user()->name }}</p>
    </div>
    <div class="text-end">
        <small class="text-muted">{{ now()->format('l, d F Y') }}</small>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row g-4 mb-4">
    <div class="col-md-6 col-lg-3">
        <div class="stat-card">
            <div class="stat-icon primary">
                <i class="bi bi-people"></i>
            </div>
            <div class="stat-value">{{ $totalUsers ?? 0 }}</div>
            <div class="stat-label">Total Users</div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="stat-card">
            <div class="stat-icon success">
                <i class="bi bi-cart-check"></i>
            </div>
            <div class="stat-value">{{ $totalPesanan ?? 0 }}</div>
            <div class="stat-label">Total Pesanan</div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="stat-card">
            <div class="stat-icon info">
                <i class="bi bi-cash-stack"></i>
            </div>
            <div class="stat-value">Rp {{ number_format($totalPendapatan ?? 0, 0, ',', '.') }}</div>
            <div class="stat-label">Total Pendapatan</div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="stat-card">
            <div class="stat-icon warning">
                <i class="bi bi-hourglass-split"></i>
            </div>
            <div class="stat-value">{{ $pesananPending ?? 0 }}</div>
            <div class="stat-label">Pesanan Pending</div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Recent Orders -->
    <div class="col-lg-8">
        <div class="table-card">
            <div class="table-card-header">
                <h5 class="fw-bold mb-0"><i class="bi bi-clock-history me-2 text-warning"></i>Pesanan Terbaru</h5>
                <a href="{{ route('admin.pesanans.index') }}" class="btn btn-sm btn-outline-secondary">Lihat Semua</a>
            </div>
            <div class="table-card-body">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Kode</th>
                                <th>Pelanggan</th>
                                <th>Paket</th>
                                <th>Harga</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentPesanans ?? [] as $pesanan)
                            <tr>
                                <td><span class="fw-bold">#{{ $pesanan->kode_pesanan }}</span></td>
                                <td>{{ $pesanan->user->name }}</td>
                                <td>{{ $pesanan->paket->nama }}</td>
                                <td>Rp {{ number_format($pesanan->harga, 0, ',', '.') }}</td>
                                <td>{!! $pesanan->status_badge !!}</td>
                                <td>{{ $pesanan->created_at->format('d M Y') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">Belum ada pesanan</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="col-lg-4">
        <div class="table-card">
            <div class="table-card-header">
                <h5 class="fw-bold mb-0"><i class="bi bi-lightning-charge me-2 text-warning"></i>Aksi Cepat</h5>
            </div>
            <div class="p-3">
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.pesanans.index') }}" class="btn btn-outline-secondary text-start">
                        <i class="bi bi-cart-check me-2 text-warning"></i>Kelola Pesanan
                    </a>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary text-start">
                        <i class="bi bi-people me-2 text-primary"></i>Kelola Users
                    </a>
                    <a href="{{ route('admin.portofolios.create') }}" class="btn btn-outline-secondary text-start">
                        <i class="bi bi-plus-circle me-2 text-success"></i>Tambah Portofolio
                    </a>
                    <a href="{{ route('admin.blogs.create') }}" class="btn btn-outline-secondary text-start">
                        <i class="bi bi-journal-plus me-2 text-info"></i>Tulis Blog
                    </a>
                </div>
            </div>
        </div>

        <!-- Order Status Chart -->
        <div class="table-card mt-4">
            <div class="table-card-header">
                <h5 class="fw-bold mb-0"><i class="bi bi-pie-chart me-2 text-warning"></i>Status Pesanan</h5>
            </div>
            <div class="p-4 text-center">
                <div class="row g-2">
                    <div class="col-6">
                        <div class="p-2 rounded bg-warning bg-opacity-10">
                            <div class="fw-bold text-warning">{{ $statusCounts['pending'] ?? 0 }}</div>
                            <small class="text-muted">Pending</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="p-2 rounded bg-info bg-opacity-10">
                            <div class="fw-bold text-info">{{ $statusCounts['diproses'] ?? 0 }}</div>
                            <small class="text-muted">Diproses</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="p-2 rounded bg-primary bg-opacity-10">
                            <div class="fw-bold text-primary">{{ $statusCounts['revisi'] ?? 0 }}</div>
                            <small class="text-muted">Revisi</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="p-2 rounded bg-success bg-opacity-10">
                            <div class="fw-bold text-success">{{ $statusCounts['selesai'] ?? 0 }}</div>
                            <small class="text-muted">Selesai</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection