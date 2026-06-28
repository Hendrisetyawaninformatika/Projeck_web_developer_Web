@extends('layouts.app')

@section('title', 'Jasa Pembuatan Website Profesional')

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center min-vh-100 pt-5">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="badge bg-warning text-dark mb-3 px-3 py-2 rounded-pill">
                    <i class="bi bi-stars me-1"></i> #1 Web Developer Indonesia
                </div>
                <h1 class="hero-title">
                    Wujudkan Website <span>Impian</span> Anda Bersama Kami
                </h1>
                <p class="hero-subtitle">
                    Kami menyediakan jasa pembuatan website profesional dengan desain modern, 
                    responsif, dan optimasi SEO terbaik untuk mengembangkan bisnis Anda.
                </p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="{{ route('pemesanan') }}" class="btn btn-primary-custom btn-lg">
                        <i class="bi bi-rocket-takeoff me-2"></i>Mulai Proyek
                    </a>
                    <a href="{{ route('portfolio') }}" class="btn btn-outline-light btn-lg">
                        <i class="bi bi-grid-3x3-gap me-2"></i>Lihat Portofolio
                    </a>
                </div>
                <div class="mt-5 d-flex gap-4">
                    <div>
                        <h3 class="text-warning fw-bold mb-0">500+</h3>
                        <small class="text-white-50">Proyek Selesai</small>
                    </div>
                    <div>
                        <h3 class="text-warning fw-bold mb-0">98%</h3>
                        <small class="text-white-50">Kepuasan Klien</small>
                    </div>
                    <div>
                        <h3 class="text-warning fw-bold mb-0">50+</h3>
                        <small class="text-white-50">Klien Aktif</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 text-center" data-aos="fade-left" data-aos-delay="200">
                <img src="https://img.freepik.com/free-vector/web-development-programmer-engineering-coding-website-augmented-reality-interface-screens-developer-project-engineer-programming-software-application-design-cartoon-illustration_107791-3863.jpg" 
                     alt="Web Development" class="img-fluid floating rounded-4" style="max-height: 500px;">
            </div>
        </div>
    </div>
</section>

<!-- Clients Section -->
<section class="py-5 bg-light">
    <div class="container">
        <p class="text-center text-muted mb-4" data-aos="fade-up">Dipercaya oleh berbagai perusahaan</p>
        <div class="row justify-content-center align-items-center g-4">
            @foreach(['Google', 'Microsoft', 'Amazon', 'Netflix', 'Spotify'] as $client)
            <div class="col-4 col-md-2 text-center" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <h4 class="text-muted fw-bold opacity-50">{{ $client }}</h4>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="section-padding">
    <div class="container">
        <h2 class="section-title" data-aos="fade-up">Layanan <span>Unggulan</span></h2>
        <p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">
            Solusi lengkap untuk kebutuhan digital Anda
        </p>
        
        <div class="row g-4">
            @php
            $services = [
                ['icon' => 'bi-laptop', 'title' => 'Website Company Profile', 'desc' => 'Tampilkan identitas perusahaan Anda dengan website profesional yang menarik.'],
                ['icon' => 'bi-cart-check', 'title' => 'E-Commerce', 'desc' => 'Bangun toko online Anda dengan fitur lengkap dan sistem pembayaran terintegrasi.'],
                ['icon' => 'bi-code-square', 'title' => 'Web Application', 'desc' => 'Aplikasi web custom sesuai kebutuhan bisnis Anda dengan teknologi terkini.'],
                ['icon' => 'bi-speedometer2', 'title' => 'Landing Page', 'desc' => 'Halaman landing yang konversi tinggi untuk campaign marketing Anda.'],
                ['icon' => 'bi-search', 'title' => 'SEO Optimization', 'desc' => 'Optimasi mesin pencari untuk meningkatkan visibilitas website Anda.'],
                ['icon' => 'bi-phone', 'title' => 'Mobile Responsive', 'desc' => 'Website yang optimal di semua perangkat, dari desktop hingga smartphone.'],
            ];
            @endphp
            
            @foreach($services as $service)
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="service-card">
                    <div class="service-icon">
                        <i class="bi {{ $service['icon'] }}"></i>
                    </div>
                    <h4 class="fw-bold mb-3">{{ $service['title'] }}</h4>
                    <p class="text-muted mb-0">{{ $service['desc'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Why Choose Us -->
<section class="section-padding bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6" data-aos="fade-right">
                <img src="https://img.freepik.com/free-vector/business-team-brainstorming-discussing-startup-project_74855-6909.jpg" 
                     alt="Team" class="img-fluid rounded-4 shadow-lg">
            </div>
            <div class="col-lg-6 ps-lg-5 mt-4 mt-lg-0" data-aos="fade-left">
                <h2 class="section-title text-start">Mengapa Memilih <span>Kami?</span></h2>
                <p class="text-muted mb-4">Kami berkomitmen memberikan layanan terbaik dengan standar kualitas tinggi.</p>
                
                @php
                $reasons = [
                    ['icon' => 'bi-shield-check', 'title' => 'Garansi 100%', 'desc' => 'Jaminan kepuasan atau uang kembali'],
                    ['icon' => 'bi-clock-history', 'title' => 'Tepat Waktu', 'desc' => 'Selalu menyelesaikan proyek sesuai deadline'],
                    ['icon' => 'bi-headset', 'title' => 'Support 24/7', 'desc' => 'Tim support siap membantu kapan saja'],
                    ['icon' => 'bi-award', 'title' => 'Berpengalaman', 'desc' => 'Lebih dari 5 tahun pengalaman industri'],
                ];
                @endphp
                
                @foreach($reasons as $reason)
                <div class="d-flex mb-4" data-aos="fade-left" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="flex-shrink-0">
                        <div class="service-icon" style="width: 50px; height: 50px; font-size: 1.2rem;">
                            <i class="bi {{ $reason['icon'] }}"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h5 class="fw-bold mb-1">{{ $reason['title'] }}</h5>
                        <p class="text-muted mb-0">{{ $reason['desc'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- Portfolio Preview -->
<section class="section-padding">
    <div class="container">
        <h2 class="section-title" data-aos="fade-up">Portofolio <span>Terbaru</span></h2>
        <p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">
            Beberapa proyek terbaik yang telah kami kerjakan
        </p>
        
        <div class="row g-4">
            @php
            $portfolios = [
                ['title' => 'E-Commerce Fashion', 'category' => 'E-Commerce', 'img' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=600'],
                ['title' => 'Company Profile PT. ABC', 'category' => 'Company Profile', 'img' => 'https://images.unsplash.com/photo-1497366216548-37526070297c?w=600'],
                ['title' => 'Aplikasi Manajemen', 'category' => 'Web App', 'img' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=600'],
                ['title' => 'Landing Page Produk', 'category' => 'Landing Page', 'img' => 'https://images.unsplash.com/photo-1467232004584-a241de8bcf5d?w=600'],
            ];
            @endphp
            
            @foreach($portfolios as $portfolio)
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="portfolio-item">
                    <img src="{{ $portfolio['img'] }}" alt="{{ $portfolio['title'] }}">
                    <div class="portfolio-overlay">
                        <span class="badge bg-warning text-dark mb-2">{{ $portfolio['category'] }}</span>
                        <h5 class="fw-bold">{{ $portfolio['title'] }}</h5>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="text-center mt-5">
            <a href="{{ route('portfolio') }}" class="btn btn-primary-custom">
                Lihat Semua Portofolio <i class="bi bi-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>

<!-- Pricing Preview -->
<section class="section-padding bg-light">
    <div class="container">
        <h2 class="section-title" data-aos="fade-up">Paket <span>Harga</span></h2>
        <p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">
            Pilih paket yang sesuai dengan kebutuhan Anda
        </p>
        
        <div class="row g-4 justify-content-center">
            @php
            $packages = [
                ['name' => 'Starter', 'price' => '2.500.000', 'features' => ['5 Halaman', 'Responsive Design', 'Basic SEO', '1x Revisi', 'Gratis Domain .com']],
                ['name' => 'Professional', 'price' => '5.000.000', 'featured' => true, 'features' => ['10 Halaman', 'Responsive Design', 'Advanced SEO', 'Unlimited Revisi', 'Gratis Domain .com', 'Integrasi WhatsApp', 'Panel Admin']],
                ['name' => 'Enterprise', 'price' => '10.000.000', 'features' => ['Unlimited Halaman', 'Custom

                                ['name' => 'Enterprise', 'price' => '10.000.000', 'features' => ['Unlimited Halaman', 'Custom Design', 'Premium SEO', 'Unlimited Revisi', 'Gratis Domain .com', 'Integrasi WhatsApp', 'Panel Admin', 'Maintenance 1 Tahun', 'Priority Support']],
            ];
            @endphp
            
            @foreach($packages as $package)
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 150 }}">
                <div class="pricing-card {{ $package['featured'] ?? false ? 'featured' : '' }} text-center">
                    <h4 class="fw-bold mb-3">{{ $package['name'] }}</h4>
                    <div class="price mb-4">
                        Rp {{ $package['price'] }}<span>/proyek</span>
                    </div>
                    <ul class="list-unstyled mb-4">
                        @foreach($package['features'] as $feature)
                        <li class="mb-2">
                            <i class="bi bi-check-circle-fill text-warning me-2"></i>{{ $feature }}
                        </li>
                        @endforeach
                    </ul>
                    <a href="{{ route('pemesanan') }}?paket={{ $package['name'] }}" class="btn {{ $package['featured'] ?? false ? 'btn-primary-custom' : 'btn-outline-custom' }} w-100">
                        Pilih Paket
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Testimonials -->
<section class="section-padding">
    <div class="container">
        <h2 class="section-title" data-aos="fade-up">Apa Kata <span>Klien Kami?</span></h2>
        <p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">
            Testimoni dari klien yang puas dengan layanan kami
        </p>
        
        <div class="row g-4">
            @php
            $testimonials = [
                ['name' => 'Ahmad Rizky', 'company' => 'PT. Maju Jaya', 'rating' => 5, 'text' => 'Pelayanan sangat profesional, website company profile kami jadi sangat menarik dan modern. Recommended!'],
                ['name' => 'Siti Nurhaliza', 'company' => 'Toko Online Siti', 'rating' => 5, 'text' => 'E-commerce yang dibuat sangat user-friendly. Penjualan meningkat 200% setelah website launching.'],
                ['name' => 'Budi Santoso', 'company' => 'Startup Tech', 'rating' => 5, 'text' => 'Tim developer sangat responsif dan komunikatif. Proyek selesai tepat waktu dengan kualitas terbaik.'],
            ];
            @endphp
            
            @foreach($testimonials as $testi)
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 150 }}">
                <div class="testimonial-card h-100">
                    <div class="stars mb-3">
                        @for($i = 0; $i < $testi['rating']; $i++)
                        <i class="bi bi-star-fill"></i>
                        @endfor
                    </div>
                    <p class="text-muted mb-4">"{{ $testi['text'] }}"</p>
                    <div class="d-flex align-items-center">
                        <div class="testimonial-avatar me-3 d-flex align-items-center justify-content-center bg-warning text-dark fw-bold">
                            {{ strtoupper(substr($testi['name'], 0, 1)) }}
                        </div>
                        <div>
                            <h6 class="fw-bold mb-0">{{ $testi['name'] }}</h6>
                            <small class="text-muted">{{ $testi['company'] }}</small>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="section-padding bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center" data-aos="zoom-in">
                <h2 class="fw-bold mb-4">Siap Memulai Proyek <span class="text-warning">Website</span> Anda?</h2>
                <p class="text-muted mb-4">Konsultasikan kebutuhan website Anda secara gratis. Tim kami siap membantu mewujudkan visi digital Anda.</p>
                <div class="d-flex flex-wrap justify-content-center gap-3">
                    <a href="https://wa.me/6281234567890?text=Halo,%20saya%20ingin%20konsultasi%20tentang%20pembuatan%20website" target="_blank" class="btn btn-primary-custom btn-lg">
                        <i class="bi bi-whatsapp me-2"></i>Chat WhatsApp
                    </a>
                    <a href="{{ route('pemesanan') }}" class="btn btn-outline-custom btn-lg">
                        <i class="bi bi-send me-2"></i>Kirim Pesanan
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection