@extends('layouts.app')

@section('title', 'Portofolio')

@section('content')
<!-- Page Header -->
<section class="py-5 bg-dark text-white" style="padding-top: 120px !important;">
    <div class="container text-center" data-aos="fade-up">
        <h1 class="fw-bold display-5">Portofolio <span class="text-warning">Kami</span></h1>
        <p class="lead text-white-50">Karya terbaik yang telah kami hasilkan untuk klien</p>
    </div>
</section>

<!-- Portfolio Grid -->
<section class="section-padding">
    <div class="container">
        <!-- Filter Buttons -->
        <div class="text-center mb-5" data-aos="fade-up">
            <div class="btn-group" role="group">
                <button class="btn btn-outline-custom active" data-filter="all">Semua</button>
                <button class="btn btn-outline-custom" data-filter="ecommerce">E-Commerce</button>
                <button class="btn btn-outline-custom" data-filter="company">Company Profile</button>
                <button class="btn btn-outline-custom" data-filter="landing">Landing Page</button>
                <button class="btn btn-outline-custom" data-filter="webapp">Web App</button>
            </div>
        </div>
        
        <div class="row g-4">
            @php
            $portfolios = [
                ['title' => 'Fashion Store', 'category' => 'ecommerce', 'client' => 'PT. Fashion Indonesia', 'img' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=600'],
                ['title' => 'Tech Company Profile', 'category' => 'company', 'client' => 'Tech Solutions', 'img' => 'https://images.unsplash.com/photo-1497366216548-37526070297c?w=600'],
                ['title' => 'Product Launch', 'category' => 'landing', 'client' => 'Startup XYZ', 'img' => 'https://images.unsplash.com/photo-1467232004584-a241de8bcf5d?w=600'],
                ['title' => 'Inventory System', 'category' => 'webapp', 'client' => 'Logistics Co', 'img' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=600'],
                ['title' => 'Beauty E-Commerce', 'category' => 'ecommerce', 'client' => 'Beauty Brand', 'img' => 'https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=600'],
                ['title' => 'Consulting Firm', 'category' => 'company', 'client' => 'Konsultan Pro', 'img' => 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?w=600'],
            ];
            @endphp
            
            @foreach($portfolios as $portfolio)
            <div class="col-md-6 col-lg-4 portfolio-item-wrapper" data-category="{{ $portfolio['category'] }}" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="portfolio-item">
                    <img src="{{ $portfolio['img'] }}" alt="{{ $portfolio['title'] }}">
                    <div class="portfolio-overlay">
                        <span class="badge bg-warning text-dark mb-2 text-uppercase">{{ $portfolio['category'] }}</span>
                        <h5 class="fw-bold">{{ $portfolio['title'] }}</h5>
                        <p class="small text-white-50 mb-3">{{ $portfolio['client'] }}</p>
                        <a href="#" class="btn btn-primary-custom btn-sm">
                            <i class="bi bi-eye me-1"></i> Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@push('scripts')
<script>
    // Portfolio Filter
    document.querySelectorAll('[data-filter]').forEach(btn => {
        btn.addEventListener('click', function() {
            const filter = this.dataset.filter;
            
            // Update active button
            document.querySelectorAll('[data-filter]').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            
            // Filter items
            document.querySelectorAll('.portfolio-item-wrapper').forEach(item => {
                if (filter === 'all' || item.dataset.category === filter) {
                    item.style.display = 'block';
                    setTimeout(() => item.style.opacity = '1', 10);
                } else {
                    item.style.opacity = '0';
                    setTimeout(() => item.style.display = 'none', 300);
                }
            });
        });
    });
</script>
@endpush
@endsection