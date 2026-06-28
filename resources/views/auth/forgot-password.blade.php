@extends('layouts.app')

@section('title', 'Lupa Password')

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
</style>
@endpush

@section('content')
<section class="auth-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5" data-aos="fade-up">
                <div class="text-center mb-4">
                    <h2 class="fw-bold text-white">Web<span class="text-warning">Dev</span>Pro</h2>
                </div>
                
                <div class="auth-card text-center">
                    <i class="bi bi-envelope-open fs-1 text-warning mb-3"></i>
                    <h4 class="fw-bold mb-3">Lupa Password?</h4>
                    <p class="text-muted mb-4">Masukkan email Anda dan kami akan mengirimkan link reset password.</p>
                    
                    @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    
                    @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                    
                    <form action="{{ route('password.email') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <input type="email" name="email" class="form-control form-control-lg" 
                                   placeholder="nama@email.com" required>
                        </div>
                        
                        <button type="submit" class="btn btn-primary-custom w-100 py-3 fw-bold">
                            <i class="bi bi-send me-2"></i>Kirim Link Reset
                        </button>
                    </form>
                    
                    <div class="mt-4">
                        <a href="{{ route('login') }}" class="text-warning text-decoration-none">
                            <i class="bi bi-arrow-left me-2"></i>Kembali ke Login
                        </a>
                    </div>
                </div>
                        </div>
        </div>
    </div>
</section>
@endsection