@extends('layouts.user')

@section('title', 'Profil Saya')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-white border-0 pt-4 px-4">
                <h5 class="fw-bold mb-0">Edit Profil</h5>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="text-center mb-4">
                        <div class="position-relative d-inline-block">
                            <div class="bg-warning rounded-circle d-flex align-items-center justify-content-center mx-auto" 
                                 style="width: 120px; height: 120px; font-size: 3rem; font-weight: 800; color: var(--secondary-color);">
                                @if(auth()->user()->photo_url)
                                <img src="{{ auth()->user()->photo_url }}" alt="Profile" class="rounded-circle w-100 h-100 object-fit-cover">
                                @else
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                @endif
                            </div>
                            <label for="photo" class="position-absolute bottom-0 end-0 bg-dark text-white rounded-circle d-flex align-items-center justify-content-center" 
                                   style="width: 35px; height: 35px; cursor: pointer;">
                                <i class="bi bi-camera-fill small"></i>
                            </label>
                            <input type="file" name="photo" id="photo" class="d-none" accept="image/*">
                        </div>
                    </div>
                    
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control" value="{{ auth()->user()->name }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="email" class="form-control" value="{{ auth()->user()->email }}" disabled>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nomor Telepon</label>
                            <input type="tel" name="phone" class="form-control" value="{{ auth()->user()->phone }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Alamat</label>
                            <textarea name="address" class="form-control" rows="1">{{ auth()->user()->address }}</textarea>
                        </div>
                    </div>
                    
                    <hr class="my-4">
                    
                    <h6 class="fw-bold mb-3">Ubah Password</h6>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Password Lama</label>
                            <input type="password" name="current_password" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Password Baru</label>
                            <input type="password" name="new_password" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Konfirmasi Password Baru</label>
                            <input type="password" name="new_password_confirmation" class="form-control">
                        </div>
                    </div>
                    
                    <div class="text-end mt-4">
                        <button type="submit" class="btn btn-warning fw-bold px-5">
                            <i class="bi bi-save me-2"></i>Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection