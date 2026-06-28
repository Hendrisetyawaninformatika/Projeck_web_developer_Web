@extends('layouts.app')

@section('title', 'Login')

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
    
    .google-btn {
        background: #fff;
        border: 2px solid #e9ecef;
        border-radius: 12px;
        padding: 12px;
        width: 100%;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    
    .google-btn:hover {
        border-color: #FFD700;
        background: rgba(255, 215, 0, 0.05);
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
                    <p class="text-white-50">Masuk ke akun Anda</p>
                </div>
                
                <div class="auth-card">
                    <h4 class="fw-bold text-center mb-4">Selamat Datang Kembali!</h4>
                    
                    @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif
                    
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif
                    
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                                   placeholder="nama@email.com" value="{{ old('email') }}" required>
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Password</label>
                            <div class="input-group">
                                <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" 
                                       placeholder="••••••••" required>
                                <button class="btn btn-outline-secondary" type="button" onclick="togglePassword()">
                                    <i class="bi bi-eye" id="toggleIcon"></i>
                                </button>
                            </div>
                            @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                <label class="form-check-label" for="remember">Ingat saya</label>
                            </div>
                            <a href="{{ route('password.request') }}" class="text-warning text-decoration-none">Lupa password?</a>
                        </div>
                        
                        <button type="submit" class="btn btn-primary-custom w-100 py-3 mb-3 fw-bold">
                            <i class="bi bi-box-arrow-in-right me-2"></i>Masuk
                        </button>
                    </form>
                    
                    <div class="text-center mb-3">
                        <span class="text-muted">atau</span>
                    </div>
                    
                    <a href="{{ route('auth.google') }}" class="google-btn d-flex align-items-center justify-content-center gap-2 text-decoration-none text-dark">
                        <img src="https://www.google.com/favicon.ico" alt="Google" width="20">
                        Masuk dengan Google
                    </a>
                    
                    <div class="text-center mt-4">
                        <p class="text-muted mb-0">Belum punya akun? <a href="{{ route('register') }}" class="text-warning text-decoration-none fw-bold">Daftar sekarang</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
    function togglePassword() {
        const password = document.getElementById('password');
        const icon = document.getElementById('toggleIcon');
        
        if (password.type === 'password') {
            password.type = 'text';
            icon.classList.replace('bi-eye', 'bi-eye-slash');
        } else {
            password.type = 'password';
            icon.classList.replace('bi-eye-slash', 'bi-eye');
        }
    }
</script>
@endpush
@endsection