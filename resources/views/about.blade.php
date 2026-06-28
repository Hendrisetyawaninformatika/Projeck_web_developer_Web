@extends('layouts.app')

@section('title', 'Tentang Kami')

@section('content')
<!-- Page Header -->
<section class="py-5 bg-dark text-white" style="padding-top: 120px !important;">
    <div class="container text-center" data-aos="fade-up">
        <h1 class="fw-bold display-5">Tentang <span class="text-warning">Kami</span></h1>
        <p class="lead text-white-50">Mengenal lebih dekat tim profesional di balik layanan kami</p>
    </div>
</section>

<!-- About Content -->
<section class="section-padding">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6" data-aos="fade-right">
                <img src="https://img.freepik.com/free-vector/team-goals-concept-illustration_114360-5145.jpg" 
                     alt="About Us" class="img-fluid rounded-4 shadow-lg">
            </div>
            <div class="col-lg-6 ps-lg-5 mt-4 mt-lg-0" data-aos="fade-left">
                <div class="badge bg-warning text-dark mb-3 px-3 py-2 rounded-pill">
                    <i class="bi bi-info-circle me-1"></i> Tentang WebDevPro
                </div>
                <h2 class="fw-bold mb-4">Partner Digital Terpercaya untuk <span class="text-warning">Kesuksesan Bisnis</span> Anda</h2>
                <p class="text-muted mb-4">
                    WebDevPro adalah tim developer profesional yang berdedikasi untuk membantu bisnis Anda 
                    tumbuh di era digital. Dengan pengalaman lebih dari 5 tahun, kami telah melayani 
                    ratusan klien dari berbagai industri.
                </p>
                <p class="text-muted mb-4">
                    Kami percaya bahwa setiap bisnis layak memiliki website yang profesional, modern, 
                    dan fungsional. Itulah mengapa kami selalu memberikan yang terbaik dalam setiap proyek.
                </p>
                
                <div class="row g-3 mt-2">
                    <div class="col-6">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-check-circle-fill text-warning fs-4 me-2"></i>
                            <span class="fw-semibold">Profesional Team</span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-check-circle-fill text-warning fs-4 me-2"></i>
                            <span class="fw-semibold">Kualitas Terjamin</span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-check-circle-fill text-warning fs-4 me-2"></i>
                            <span class="fw-semibold">Harga Kompetitif</span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-check-circle-fill text-warning fs-4 me-2"></i>
                            <span class="fw-semibold">Support 24/7</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats -->
<section class="py-5 bg-dark text-white">
    <div class="container">
        <div class="row text-center g-4">
            <div class="col-md-3" data-aos="fade-up" data-aos-delay="0">
                <h2 class="display-4 fw-bold text-warning">500+</h2>
                <p class="text-white-50">Proyek Selesai</p>
            </div>
            <div class="col-md-3" data-aos="fade-up" data-aos-delay="100">
                <h2 class="display-4 fw-bold text-warning">98%</h2>
                <p class="text-white-50">Kepuasan Klien</p>
            </div>
            <div class="col-md-3" data-aos="fade-up" data-aos-delay="200">
                <h2 class="display-4 fw-bold text-warning">50+</h2>
                <p class="text-white-50">Klien Aktif</p>
            </div>
            <div class="col-md-3" data-aos="fade-up" data-aos-delay="300">
                <h2 class="display-4 fw-bold text-warning">5+</h2>
                <p class="text-white-50">Tahun Pengalaman</p>
            </div>
        </div>
    </div>
</section>

<!-- Team -->
<section class="section-padding bg-light">
    <div class="container">
        <h2 class="section-title" data-aos="fade-up">Tim <span>Kami</span></h2>
        <p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">
            Profesional berpengalaman yang siap melayani Anda
        </p>
        
        <div class="row g-4 justify-content-center">
            @php
            $teams = [
                ['name' => 'Andi Wijaya', 'role' => 'Founder & Lead Developer', 'img' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400'],
                ['name' => 'Dewi Lestari', 'role' => 'UI/UX Designer', 'img' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=400'],
                ['name' => 'Rudi Hartono', 'role' => 'Full Stack Developer', 'img' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=400'],
                ['name' => 'Maya Sari', 'role' => 'Project Manager', 'img' => 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=400'],
            ];
            @endphp
            
            @foreach($teams as $team)
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden text-center">
                    <img src="{{ $team['img'] }}" alt="{{ $team['name'] }}" class="card-img-top" style="height: 250px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="fw-bold mb-1">{{ $team['name'] }}</h5>
                        <p class="text-muted small mb-3">{{ $team['role'] }}</p>
                        <div class="social-links">
                            <a href="#" class="social-icon" style="width: 35px; height: 35px; font-size: 0.9rem; background: #f8f9fa; color: #1a1a2e;"><i class="bi bi-linkedin"></i></a>
                            <a href="#" class="social-icon" style="width: 35px; height: 35px; font-size: 0.9rem; background: #f8f9fa; color: #1a1a2e;"><i class="bi bi-twitter-x"></i></a>
                            <a href="#" class="social-icon" style="width: 35px; height: 35px; font-size: 0.9rem; background: #f8f9fa; color: #1a1a2e;"><i class="bi bi-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection