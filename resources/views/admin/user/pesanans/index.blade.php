@extends('layouts.user')

@section('title', 'Riwayat Pesanan')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-bold mb-0">Riwayat Pesanan</h5>
    <a href="{{ route('pemesanan') }}" class="btn btn-warning fw-bold">
        <i class="bi bi-plus-lg me-2"></i>Pesan Baru
    </a>
</div>

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Kode</th>
                        <th>Nama Proyek</th>
                        <th>Paket</th>
                        <th>Deadline</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pesanans ?? [] as $pesanan)
                    <tr>
                        <td><span class="fw-bold">#{{ $pesanan->kode_pesanan }}</span></td>
                        <td>{{ $pesanan->nama_proyek }}</td>
                        <td>{{ $pesanan->paket->nama }}</td>
                        <td>{{ $pesanan->deadline->format('d M Y') }}</td>
                        <td>{!! $pesanan->status_badge !!}</td>
                        <td>
                            <a href="{{ route('user.pesanans.show', $pesanan) }}" class="btn btn-sm btn-warning">
                                <i class="bi bi-eye"></i>
                            </a>
                            @if($pesanan->status === 'pending')
                            <a href="https://wa.me/6281234567890?text=Halo%20Admin,%20saya%20ingin%20menanyakan%20pesanan%20{{ $pesanan->kode_pesanan }}" 
                               target="_blank" class="btn btn-sm btn-success">
                                <i class="bi bi-whatsapp"></i>
                            </a>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                            Belum ada pesanan
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection