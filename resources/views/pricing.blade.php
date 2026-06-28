@extends('layouts.app')

@section('title', 'Paket Harga')

@section('content')
<!-- Page Header -->
<section class="py-5 bg-dark text-white" style="padding-top: 120px !important;">
    <div class="container text-center" data-aos="fade-up">
        <h1 class="fw-bold display-5">Paket <span class="text-warning">Harga</span></h1>
        <p class="lead text-white-50">Pilih paket yang sesuai dengan kebutuhan dan budget Anda</p>
    </div>
</section>

<!-- Pricing Cards -->
<section class="section-padding">
    <div class="container">
        <div class="row g-4 justify-content-center">
            @php
            $packages = [
                [
                    'name' => 'Starter',
                    'price' => '2.500.000',
                    'description' => 'Cocok untuk UMKM dan personal branding',
                    'features' => [
                        '5 Halaman Website',
                        'Responsive Design',
                        'Basic SEO Setup',
                        '1x Revisi Major',
                        'Gratis Domain .com (1 tahun)',
                        'Hosting Shared (1 tahun)',
                        'SSL Certificate',
                        'Form Kontak',
                        'Integrasi WhatsApp',
                        'Support Email'
                    ],
                    'not_included' => ['Panel Admin', 'Blog System', 'Multi Bahasa']
                ],
                [
                    'name' => 'Professional',
                    'price' => '5.000.000',
                    'featured' => true,
                    'description' => 'Ideal untuk bisnis menengah dan startup',
                    'features' => [
                        '10 Halaman Website',
                        'Responsive Design Premium',
                        'Advanced SEO Setup',
                        'Unlimited Revisi',
                        'Gratis Domain .com (1 tahun)',
                        'Hosting VPS (1 tahun)',
                        'SSL Certificate',
                        'Form Kontak & Newsletter',
                        'Integrasi WhatsApp',
                        'Panel Admin',
                        'Blog System',
                        'Google Analytics',
                        'Support 24/7'
                    ],
                    'not_included' => ['Multi Bahasa', 'Custom API']
                ],
                [
                    'name' => 'Enterprise',
                    'price' => '10.000.000',
                    'description' => 'Solusi lengkap untuk perusahaan besar',
                    'features' => [
                        'Unlimited Halaman',
                        'Custom Design Premium',
                        'Premium SEO Package',
                        'Unlimited Revisi',
                        'Gratis Domain .com (2 tahun)',
                        'Hosting Dedicated (1 tahun)',
                        'SSL Certificate Premium',
                        'Form Kontak & Newsletter',
                        'Integrasi WhatsApp & Telegram',
                        'Panel Admin Advanced',
                        'Blog System & CMS',
                        'Multi Bahasa',
                        'Custom API Integration',
                        'Maintenance 1 Tahun',
                        'Priority Support 24/7',
                        'Dedicated Account Manager'
                    ],
                    'not_included' => []
                ]
            ];
            @endphp
            
            @foreach($packages as $package)
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 150 }}">
                <div class="pricing-card {{ $package['featured'] ?? false ? 'featured' : '' }} h-100 d-flex flex-column">
                    @if($package['featured'] ?? false)
                    <div class="text-center mb-3">
                        <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">
                            <i class="bi bi-star-fill me-1"></i> PALING POPULER
                        </span>
                    </div>
                    @endif
                    
                    <h3 class="fw-bold text-center">{{ $package['name'] }}</h3>
                    <p class="text-muted text-center small">{{ $package['description'] }}</p>
                    
                    <div class="text-center my-4">
                        <span class="price">Rp {{ $package['price'] }}</span>
                        <span class="text-muted">/proyek</span>
                    </div>
                    
                    <div class="flex-grow-1">
                        <ul class="list-unstyled mb-0">
                            @foreach($package['features'] as $feature)
                            <li class="mb-3 d-flex align-items-start">
                                <i class="bi bi-check-circle-fill text-warning me-2 mt-1"></i>
                                <span>{{ $feature }}</span>
                            </li>
                            @endforeach
                            
                            @foreach($package['not_included'] as $feature)
                            <li class="mb-3 d-flex align-items-start text-muted">
                                <i class="bi bi-x-circle-fill me-2 mt-1"></i>
                                <span><del>{{ $feature }}</del></span>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    
                    <div class="mt-4">
                        <a href="{{ route('pemesanan') }}?paket={{ $package['name'] }}" 
                           class="btn {{ $package['featured'] ?? false ? 'btn-primary-custom' : 'btn-outline-custom' }} w-100 py-3 fw-bold">
                            Pilih Paket {{ $package['name'] }}
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <!-- Custom Project -->
        <div class="row mt-5">
            <div class="col-lg-8 mx-auto">
                <div class="card border-0 shadow-lg rounded-4 p-4 text-center bg-dark text-white" data-aos="zoom-in">
                    <div class="card-body">
                        <h3 class="fw-bold mb-3">Butuh <span class="text-warning">Custom Project?</span></h3>
                        <p class="text-white-50 mb-4">
                            Punya kebutuhan khusus? Kami siap membantu mewujudkan proyek custom sesuai kebutuhan Anda.
                        </p>
                        <a href="https://wa.me/6281234567890?text=Halo,%20saya%20ingin%20konsultasi%20custom%20project" 
                           target="_blank" class="btn btn-primary-custom btn-lg">
                            <i class="bi bi-whatsapp me-2"></i>Konsultasi Gratis
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ -->
<section class="section-padding bg-light">
    <div class="container">
        <h2 class="section-title" data-aos="fade-up">Pertanyaan <span>Yang Sering Diajukan</span></h2>
        
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="accordion" id="faqAccordion">
                    @php
                    $faqs = [
                        ['q' => 'Berapa lama waktu pengerjaan website?', 'a' => 'Waktu pengerjaan bervariasi tergantung kompleksitas. Untuk paket Starter biasanya 7-14 hari, Professional 14-30 hari, dan Enterprise 30-60 hari.'],
                        ['q' => 'Apakah ada garansi?', 'a' => 'Ya, kami memberikan garansi 30 hari untuk perbaikan bug setelah website dilaunching.'],
                        ['q' => 'Bisa revisi berapa kali?', 'a' => 'Paket Starter mendapat 1x revisi major, Professional unlimited revisi, dan Enterprise unlimited revisi dengan prioritas tinggi.'],
                        ['q' => 'Apakah termasuk domain dan hosting?', 'a' => 'Ya, semua paket sudah termasuk domain .com dan hosting selama 1 tahun. Untuk Enterprise mendapat 2 tahun.'],
                        ['q' => 'Bagaimana sistem pembayarannya?', 'a' => 'DP 50% di awal, sisanya setelah website selesai dan disetujui. Kami menerima transfer bank, e-wallet, dan kartu kredit.'],
                    ];
                    @endphp
                    
                    @foreach($faqs as $faq)
                    <div class="accordion-item" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <h2 class="accordion-header">
                            <button class="accordion-button {{ $loop->first ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#faq{{ $loop->index }}">
                                {{ $faq['q'] }}
                            </button>
                        </h2>
                        <div id="faq{{ $loop->index }}" class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted">
                                {{ $faq['a'] }}
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endsection