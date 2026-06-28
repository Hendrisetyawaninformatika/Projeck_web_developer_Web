@extends('layouts.admin')

@section('title', 'Pengaturan Website')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">Pengaturan Website</h4>
        <p class="text-muted mb-0">Konfigurasi umum website</p>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4">
                <form action="{{ route('admin.settings.update') }}" method="POST">
                    @csrf
                    
                    <h6 class="fw-bold mb-3 text-warning">Informasi Umum</h6>
                    <div class="mb-3">
                        <label class="form-label">Nama Website</label>
                        <input type="text" name="site_name" class="form-control" value="{{ $settings['general']['site_name']->value ?? 'WebDevPro' }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi Website</label>
                        <textarea name="site_description" class="form-control" rows="2">{{ $settings['general']['site_description']->value ?? '' }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email Kontak</label>
                        <input type="email" name="contact_email" class="form-control" value="{{ $settings['general']['contact_email']->value ?? '' }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nomor WhatsApp</label>
                        <input type="text" name="whatsapp_number" class="form-control" value="{{ $settings['general']['whatsapp_number']->value ?? '6281234567890' }}">
                    </div>
                    
                    <hr class="my-4">
                    
                    <h6 class="fw-bold mb-3 text-warning">SEO</h6>
                    <div class="mb-3">
                        <label class="form-label">Meta Keywords</label>
                        <input type="text" name="meta_keywords" class="form-control" value="{{ $settings['general']['meta_keywords']->value ?? '' }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Meta Description</label>
                        <textarea name="meta_description" class="form-control" rows="2">{{ $settings['general']['meta_description']->value ?? '' }}</textarea>
                    </div>
                    
                    <div class="text-end">
                        <button type="submit" class="btn btn-admin-primary">
                            <i class="bi bi-save me-2"></i>Simpan Pengaturan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection