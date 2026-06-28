@extends('layouts.app')

@section('title', 'Kontak Kami')

@section('content')
<!-- Page Header -->
<section class="py-5 bg-dark text-white" style="padding-top: 120px !important;">
    <div class="container text-center" data-aos="fade-up">
        <h1 class="fw-bold display-5">Hubungi <span class="text-warning">Kami</span></h1>
        <p class="lead text-white-50">Kami siap membantu kebutuhan digital Anda</p>
    </div>
</section>

<!-- Contact Section -->
<section class="section-padding">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-5" data-aos="fade-right">
                <h3 class="fw-bold mb-4">Informasi <span class="text-warning">Kontak</span></h3>
                
                <div class="d-flex mb-4">
                    <div class="flex-shrink-0">
                        <div class="service-icon" style="width: 50px; height: 50px; font-size: 1.2rem;">
                            <i class="bi bi-geo-alt-fill"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h5 class="fw-bold mb-1">Alamat</h5>
                        <p class="text-muted mb-0">Jl. Sudirman No. 123, Jakarta Pusat, Indonesia</p>
                    </div>
                </div>
                
                <div class="d-flex mb-4">
                    <div class="flex-shrink-0">
                        <div class="service-icon" style="width: 50px; height: 50px; font-size: 1.2rem;">
                            <i class="bi bi-envelope-fill"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h5 class="fw-bold mb-1">Email</h5>
                        <p class="text-muted mb-0">info@webdevpro.id</p>
                        <p class="text-muted mb-0">support@webdevpro.id</p>
                    </div>
                </div>
                
                <div class="d-flex mb-4">
                    <div class="flex-shrink-0">
                        <div class="service-icon" style="width: 50px; height: 50px; font-size: 1.2rem;">
                            <i class="bi bi-telephone-fill"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h5 class="fw-bold mb-1">Telepon</h5>
                        <p class="text-muted mb-0">+62 812-3456-7890</p>
                        <p class="text-muted mb-0">+62 21-1234-5678</p>
                    </div>
                </div>
                
                <div class="d-flex mb-4">
                    <div class="flex-shrink-0">
                        <div class="service-icon" style="width: 50px; height: 50px; font-size: 1.2rem;">
                            <i class="bi bi-clock-fill"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h5 class="fw-bold mb-1">Jam Operasional</h5>
                        <p class="text-muted mb-0">Senin - Jumat: 09:00 - 17:00</p>
                        <p class="text-muted mb-0">Sabtu: 09:00 - 14:00</p>
                    </div>
                </div>
                
                <h5 class="fw-bold mb-3">Ikuti Kami</h5>
                <div class="social-links">
                    <a href="#" class="social-icon" style="background: #1a1a2e; color: #fff;"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="social-icon" style="background: #1a1a2e; color: #fff;"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="social-icon" style="background: #1a1a2e; color: #fff;"><i class="bi bi-twitter-x"></i></a>
                    <a href="#" class="social-icon" style="background: #1a1a2e; color: #fff;"><i class="bi bi-linkedin"></i></a>
                    <a href="#" class="social-icon" style="background: #1a1a2e; color: #fff;"><i class="bi bi-youtube"></i></a>
                </div>
            </div>
            
            <div class="col-lg-7" data-aos="fade-left">
                <div class="form-section">
                    <h4 class="fw-bold mb-4">Kirim <span class="text-warning">Pesan</span></h4>
                    
                    <form action="#" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Telepon</label>
                                <input type="tel" name="phone" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Subjek <span class="text-danger">*</span></label>
                                <select name="subject" class="form-select" required>
                                    <option value="">Pilih Subjek</option>
                                    <option value="general">Pertanyaan Umum</option>
                                    <option value="order">Pemesanan</option>
                                    <option value="support">Support Teknis</option>
                                    <option value="partnership">Kerjasama</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Pesan <span class="text-danger">*</span></label>
                                <textarea name="message" class="form-control" rows="5" required></textarea>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary-custom w-100 py-3">
                                    <i class="bi bi-send me-2"></i>Kirim Pesan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Map Section -->
<section class="pb-5">
    <div class="container">
        <div class="rounded-4 overflow-hidden shadow-lg" style="height: 400px;" data-aos="zoom-in">
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.521260322283!2d106.8195613507864!3d-6.194741395493371!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f5390917b759%3A0x6b45e67356080477!2sMonas!5e0!3m2!1sid!2sid!4v1635684567890!5m2!1sid!2sid"
                width="100%" 
                height="100%" 
                style="border:0;" 
                allowfullscreen="" 
                loading="lazy">
            </iframe>
        </div>
    </div>
</section>
@endsection