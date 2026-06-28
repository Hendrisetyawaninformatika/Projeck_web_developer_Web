@extends('layouts.admin')

@section('title', 'Tambah Paket')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-white border-0 pt-4 px-4">
                <h5 class="fw-bold mb-0">Tambah Paket Baru</h5>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('admin.pakets.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Paket <span class="text-danger">*</span></label>
                        <input type="text" name="nama" class="form-control" required value="{{ old('nama') }}">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Deskripsi <span class="text-danger">*</span></label>
                        <textarea name="deskripsi" class="form-control" rows="3" required>{{ old('deskripsi') }}</textarea>
                    </div>
                    
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Harga <span class="text-danger">*</span></label>
                            <input type="number" name="harga" class="form-control" required value="{{ old('harga') }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Harga Diskon</label>
                            <input type="number" name="harga_diskon" class="form-control" value="{{ old('harga_diskon') }}">
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Fitur <span class="text-danger">*</span></label>
                        <div id="fitur-container">
                            <div class="input-group mb-2">
                                <input type="text" name="fitur[]" class="form-control" placeholder="Masukkan fitur" required>
                                <button type="button" class="btn btn-outline-secondary" onclick="addFitur()">
                                    <i class="bi bi-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Durasi (hari) <span class="text-danger">*</span></label>
                            <input type="number" name="durasi_hari" class="form-control" required value="{{ old('durasi_hari', 7) }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Urutan</label>
                            <input type="number" name="urutan" class="form-control" value="{{ old('urutan', 0) }}">
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" checked>
                            <label class="form-check-label" for="is_active">Aktif</label>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.pakets.index') }}" class="btn btn-outline-secondary">Kembali</a>
                        <button type="submit" class="btn btn-admin-primary">
                            <i class="bi bi-save me-2"></i>Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function addFitur() {
        const container = document.getElementById('fitur-container');
        const div = document.createElement('div');
        div.className = 'input-group mb-2';
        div.innerHTML = `
            <input type="text" name="fitur[]" class="form-control" placeholder="Masukkan fitur" required>
            <button type="button" class="btn btn-outline-danger" onclick="this.parentElement.remove()">
                <i class="bi bi-trash"></i>
            </button>
        `;
        container.appendChild(div);
    }
</script>
@endpush
@endsection