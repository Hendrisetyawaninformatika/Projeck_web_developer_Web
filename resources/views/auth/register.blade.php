@extends('layouts.app')

@section('title', 'Register')

@push('styles')
<style>
    .auth-section {
        min-height: 100vh;
        display: flex;
        align-items: center;
        background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
        padding: 80px 0;
    }
    
    .auth-card {
        background: #fff;
        border-radius: 25px;
        padding: 50px;
        box-shadow: 0 25px 60px rgba(0,0,0,0.3);
    }
    
    .auth-card .form-control {
        border-radius: 12px;
        padding: 14px 18px;
        border: 2px solid #e9ecef;
    }
    
    .auth-card .form-control:focus {
        border-color: #FFD700;
        box-shadow: 0 0 0 0.25rem rgba(255, 215, 0, 0.25);
    }
</style>
@endpush

@section('content')
<section class="auth-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5" data-aos="fade-up">
                <div class="text-center mb-4">
                    <h2 class="fw-bold text-white">Web<span class="text-warning">Dev</span>Pro</h2>
                    <p class="text-white-50">Buat akun baru Anda</p>
                </div>
                
                <div class="auth-card">
                    <h4 class="fw-bold text-center mb-4">Daftar Akun Baru</h4>
                    
                    @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif
                    
                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                                   placeholder="Nama lengkap Anda" value="{{ old('name') }}" required>
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                                   placeholder="nama@email.com" value="{{ old('email') }}" required>
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nomor Telepon</label>
                            <input type="tel" name="phone" class="form-control @error('phone') is-invalid @enderror" 
                                   placeholder="0812-3456-7890" value="{{ old('phone') }}">
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Password <span class="text-danger">*</span></label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" 
                                   placeholder="Minimal 6 karakter" required>
                            @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Konfirmasi Password <span class="text-danger">*</span></label>
                            <input type="password" name="password_confirmation" class="form-control" 
                                   placeholder="Ulangi password" required>
                        </div>
                        
                        <div class="mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="terms" id="terms" required>
                                <label class="form-check-label" for="terms">
                                    Saya menyetujui <a href="#" class="text-warning">syarat dan ketentuan</a>
                                </label>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary-custom w-100 py-3 fw-bold">
                            <i class="bi bi-person-plus me-2"></i>Daftar Sekarang
                        </button>
                    </form>
                    
                    <div class="text-center mt-4">
                        <p class="text-muted mb-0">Sudah punya akun? <a href="{{ route('login') }}" class="text-warning text-decoration-none fw-bold">Masuk di sini</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection