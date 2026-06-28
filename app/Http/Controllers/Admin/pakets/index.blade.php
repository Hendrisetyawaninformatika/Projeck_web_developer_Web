@extends('layouts.admin')

@section('title', 'Kelola Paket')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">Kelola Paket</h4>
        <p class="text-muted mb-0">Daftar paket layanan yang tersedia</p>
    </div>
    <a href="{{ route('admin.pakets.create') }}" class="btn btn-admin-primary">
        <i class="bi bi-plus-lg me-2"></i>Tambah Paket
    </a>
</div>

<div class="table-card">
    <div class="table-card-body">
        <div class="table-responsive">
            <table class="table datatable table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="50">No</th>
                        <th>Nama</th>
                        <th>Harga</th>
                        <th>Durasi</th>
                        <th>Status</th>
                        <th width="150">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pakets as $paket)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <div class="fw-bold">{{ $paket->nama }}</div>
                            <small class="text-muted">{{ Str::limit($paket->deskripsi, 50) }}</small>
                        </td>
                        <td>
                            <div class="fw-bold">Rp {{ number_format($paket->harga, 0, ',', '.') }}</div>
                            @if($paket->harga_diskon)
                            <small class="text-success">Diskon: Rp {{ number_format($paket->harga_diskon, 0, ',', '.') }}</small>
                            @endif
                        </td>
                        <td>{{ $paket->durasi_hari }} hari</td>
                        <td>
                            <span class="badge {{ $paket->is_active ? 'bg-success' : 'bg-secondary' }}">
                                {{ $paket->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('admin.pakets.edit', $paket) }}" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <button class="btn btn-sm btn-danger" onclick="confirmDelete('delete-form-{{ $paket->id }}')">
                                <i class="bi bi-trash"></i>
                            </button>
                            <form id="delete-form-{{ $paket->id }}" action="{{ route('admin.pakets.destroy', $paket) }}" method="POST" class="d-none">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">Tidak ada data</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection