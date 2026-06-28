@extends('layouts.app')

@section('title', 'Layanan Kami')

@section('content')
<!-- Page Header -->
<section class="py-5 bg-dark text-white" style="padding-top: 120px !important;">
    <div class="container text-center" data-aos="fade-up">
        <h1 class="fw-bold display-5">Layanan <span class="text-warning">Kami</span></h1>
        <p class="lead text-white-50">Solusi digital lengkap untuk mengembangkan bisnis Anda</p>
    </div>
</section>

<!-- Services Detail -->
<section class="section-padding">
    <div class="container">
        @php
        $services = [
            [
                'icon' => 'bi-laptop',
                'title' => 'Website Company Profile',
                'desc' => 'Tampilkan identitas perusahaan Anda dengan website profesional yang menarik dan informatif.',
                'features' => ['Desain Modern & Responsif', 'SEO Friendly', 'Integrasi Google Maps', 'Form Kontak', 'Galeri Produk/Tim', 'Blog Terintegrasi'],
                'price' => 'Mulai Rp 2.500.000'
            ],
            [
                'icon' => 'bi-cart-check',
                'title' => 'E-Commerce / Toko Online',
                'desc' => 'Bangun toko online Anda dengan fitur lengkap dan sistem pembayaran terintegrasi.',
                'features' => ['Katalog Produk Unlimited', 'Keranjang Belanja', 'Sistem Pembayaran (Midtrans/Xendit)', 'Manajemen Stok', 'Laporan Penjualan', 'Notifikasi WhatsApp'],
                'price' => 'Mulai Rp 5.000.000'
            ],
            [
                'icon' => 'bi-code-square',
                'title' => 'Web Application',
                'desc' => 'Aplikasi web custom sesuai kebutuhan bisnis Anda dengan teknologi terkini.',
                'features' => ['Custom Functionality', 'Dashboard Analytics', 'Multi User Level', 'API Integration', 'Real-time Data', 'Cloud Hosting'],
                'price' => 'Mulai Rp 8.000.000'
            ],
            [
                'icon' => 'bi-speedometer2',
                'title' => 'Landing Page',
                'desc' => 'Halaman landing yang konversi tinggi untuk campaign marketing Anda.',
                'features' => ['Desain Conversion-Focused', 'A/B Testing Ready', 'Form Opt-in', 'Integrasi Email Marketing', 'Analytics Tracking', 'Mobile Optimized'],
                'price' => 'Mulai Rp 1.500.000'
            ],
            [
                'icon' => 'bi-search',
                'title' => 'SEO Optimization',
                'desc' => 'Optimasi mesin pencari untuk meningkatkan visibilitas website Anda.',
                'features' => ['Keyword Research', 'On-Page SEO', 'Technical SEO Audit', 'Backlink Building', 'Content Strategy', 'Monthly Reporting'],
                'price' => 'Mulai Rp 1.000.000/bulan'
            ],
            [
                'icon' => 'bi-phone',
                'title' => 'Mobile App Development',
                'desc' => 'Aplikasi mobile untuk Android dan iOS dengan performa optimal.',
                'features' => ['Native & Hybrid', 'UI/UX Modern', 'Push Notification', 'Offline Mode', 'App Store Publishing', 'Maintenance Support'],
                'price' => 'Mulai Rp 10.000.000'
            ],
        ];
        @endphp
        
        <div class="row g-4">
            @foreach($services as $service)
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="service-card h-100">
                    <div class="service-icon">
                        <i class="bi {{ $service['icon'] }}"></i>
                    </div>
                    <h4 class="fw-bold mb-3">{{ $service['title'] }}</h4>
                    <p class="text-muted mb-4">{{ $service['desc'] }}</p>
                    <ul class="list-unstyled mb-4">
                        @foreach($service['features'] as $feature)
                        <li class="mb-2">
                            <i class="bi bi-check2 text-warning me-2"></i>
                            <small>{{ $feature }}</small>
                        </li>
                        @endforeach
                    </ul>
                    <div class="d-flex justify-content-between align-items-center mt-auto">
                        <span class="fw-bold text-dark">{{ $service['price'] }}</span>
                        <a href="{{ route('pemesanan') }}?layanan={{ urlencode($service['title']) }}" class="btn btn-primary-custom btn-sm">
                            Pesan Sekarang
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Process -->
<section class="section-padding bg-light">
    <div class="container">
        <h2 class="section-title" data-aos="fade-up">Proses <span>Kerja</span></h2>
        <p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">
            Alur kerja kami yang terstruktur dan profesional
        </p>
        
        <div class="row g-4">
            @php
            $processes = [
                ['step' => '01', 'title' => 'Konsultasi', 'desc' => 'Diskusi kebutuhan dan tujuan website Anda'],
                ['step' => '02', 'title' => 'Perencanaan', 'desc' => 'Membuat wireframe dan timeline proyek'],
                ['step' => '03', 'title' => 'Design', 'desc' => 'Pembuatan UI/UX design sesuai branding'],
                ['step' => '04', 'title' => 'Development', 'desc' => 'Pengembangan website dengan teknologi terkini'],
                ['step' => '05', 'title' => 'Testing', 'desc' => 'Uji coba dan perbaikan sebelum launching'],
                ['step' => '06', 'title' => 'Launching', 'desc' => 'Website siap digunakan dan promosi'],
            ];
            @endphp
            
            @foreach($processes as $process)
            <div class="col-md-4 col-lg-2 text-center" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="position-relative">
                    <div class="display-1 fw-bold text-warning opacity-25">{{ $process['step'] }}</div>
                    <div class="position-absolute top-50 start-50 translate-middle w-100">
                        <h5 class="fw-bold mb-2">{{ $process['title'] }}</h5>
                        <small class="text-muted">{{ $process['desc'] }}</small>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection