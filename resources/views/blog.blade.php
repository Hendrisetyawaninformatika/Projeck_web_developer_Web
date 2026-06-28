@extends('layouts.app')

@section('title', 'Blog')

@section('content')
<!-- Page Header -->
<section class="py-5 bg-dark text-white" style="padding-top: 120px !important;">
    <div class="container text-center" data-aos="fade-up">
        <h1 class="fw-bold display-5">Blog <span class="text-warning">Kami</span></h1>
        <p class="lead text-white-50">Artikel seputar teknologi dan pengembangan web</p>
    </div>
</section>

<!-- Blog Grid -->
<section class="section-padding">
    <div class="container">
        <div class="row g-4">
            @forelse($blogs ?? [] as $blog)
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
                    @if($blog->gambar_url)
                    <img src="{{ $blog->gambar_url }}" alt="{{ $blog->judul }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                    @else
                    <div class="bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                        <i class="bi bi-image fs-1 text-muted"></i>
                    </div>
                    @endif
                    <div class="card-body">
                        <span class="badge bg-warning text-dark mb-2">{{ $blog->kategori }}</span>
                        <h5 class="fw-bold mb-2">{{ $blog->judul }}</h5>
                        <p class="text-muted small mb-3">{{ Str::limit(strip_tags($blog->konten), 100) }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">
                                <i class="bi bi-calendar me-1"></i>{{ $blog->published_at?->format('d M Y') }}
                            </small>
                            <a href="#" class="text-warning fw-bold text-decoration-none">Baca Selengkapnya <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <p class="text-muted">Belum ada artikel</p>
            </div>
            @endforelse
        </div>
        
        @if(isset($blogs) && method_exists($blogs, 'links'))
        <div class="d-flex justify-content-center mt-5">
            {{ $blogs->links() }}
        </div>
        @endif
    </div>
</section>
@endsection