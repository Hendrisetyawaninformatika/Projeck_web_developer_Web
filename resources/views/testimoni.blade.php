@extends('layouts.app')

@section('title', 'Testimoni')

@section('content')
<!-- Page Header -->
<section class="py-5 bg-dark text-white" style="padding-top: 120px !important;">
    <div class="container text-center" data-aos="fade-up">
        <h1 class="fw-bold display-5">Testimoni <span class="text-warning">Klien</span></h1>
        <p class="lead text-white-50">Apa kata mereka tentang layanan kami</p>
    </div>
</section>

<!-- Testimonials -->
<section class="section-padding">
    <div class="container">
        <div class="row g-4">
            @forelse($testimonis ?? [] as $testimoni)
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="testimonial-card h-100">
                    <div class="stars mb-3">
                        @for($i = 0; $i < $testimoni->rating; $i++)
                        <i class="bi bi-star-fill"></i>
                        @endfor
                    </div>
                    <p class="text-muted mb-4">"{{ $testimoni->isi }}"</p>
                    <div class="d-flex align-items-center">
                        <div class="testimonial-avatar me-3 d-flex align-items-center justify-content-center bg-warning text-dark fw-bold">
                            {{ strtoupper(substr($testimoni->nama, 0, 1)) }}
                        </div>
                        <div>
                            <h6 class="fw-bold mb-0">{{ $testimoni->nama }}</h6>
                            <small class="text-muted">{{ $testimoni->perusahaan ?? 'Klien' }}</small>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <p class="text-muted">Belum ada testimoni</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Add Testimonial -->
<section class="section-padding bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 text-center" data-aos="zoom-in">
                <h3 class="fw-bold mb-3">Punya Pengalaman dengan Kami?</h3>
                <p class="text-muted mb-4">Bagikan testimoni Anda dan bantu kami berkembang lebih baik.</p>
                <a href="#" class="btn btn-primary-custom btn-lg" data-bs-toggle="modal" data-bs-target="#testimoniModal">
                    <i class="bi bi-pencil-square me-2"></i>Tulis Testimoni
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="testimoniModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4">
            <div class="modal-header border-0">
                <h5 class="fw-bold">Tulis Testimoni</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="#" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Rating</label>
                        <select name="rating" class="form-select">
                            <option value="5">⭐⭐⭐⭐⭐ (Sangat Puas)</option>
                            <option value="4">⭐⭐⭐⭐ (Puas)</option>
                            <option value="3">⭐⭐⭐ (Cukup)</option>
                            <option value="2">⭐⭐ (Kurang)</option>
                            <option value="1">⭐ (Tidak Puas)</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Testimoni</label>
                        <textarea name="isi" class="form-control" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary-custom w-100">Kirim Testimoni</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection