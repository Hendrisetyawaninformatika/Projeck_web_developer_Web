@extends('layouts.admin')

@section('title', 'Kelola Pesanan')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">Kelola Pesanan</h4>
        <p class="text-muted mb-0">Daftar semua pesanan website</p>
    </div>
</div>

<!-- Filter -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <select class="form-select" onchange="filterStatus(this.value)">
            <option value="">Semua Status</option>
            <option value="pending">Pending</option>
            <option value="diproses">Diproses</option>
            <option value="revisi">Revisi</option>
            <option value="selesai">Selesai</option>
            <option value="dibatalkan">Dibatalkan</option>
        </select>
    </div>
</div>

<div class="table-card">
    <div class="table-card-body">
        <div class="table-responsive">
            <table class="table datatable table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Kode</th>
                        <th>Pelanggan</th>
                        <th>Paket</th>
                        <th>Nama Proyek</th>
                        <th>Deadline</th>
                        <th>Harga</th>
                        <th>Status</th>
                        <th width="150">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pesanans ?? [] as $pesanan)
                    <tr>
                        <td><span class="fw-bold">#{{ $pesanan->kode_pesanan }}</span></td>
                        <td>{{ $pesanan->user->name }}</td>
                        <td>{{ $pesanan->paket->nama }}</td>
                        <td>{{ Str::limit($pesanan->nama_proyek, 30) }}</td>
                        <td>{{ $pesanan->deadline->format('d M Y') }}</td>
                        <td>Rp {{ number_format($pesanan->harga, 0, ',', '.') }}</td>
                        <td>{!! $pesanan->status_badge !!}</td>
                        <td>
                            <a href="{{ route('admin.pesanans.show', $pesanan) }}" class="btn btn-sm btn-info">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('admin.pesanans.edit', $pesanan) }}" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-4 text-muted">Belum ada pesanan</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function filterStatus(status) {
        const url = new URL(window.location.href);
        if (status) {
            url.searchParams.set('status', status);
        } else {
            url.searchParams.delete('status');
        }
        window.location.href = url.toString();
    }
</script>
@endpush
@endsection