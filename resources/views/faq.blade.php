@extends('layouts.app')

@section('title', 'FAQ')

@section('content')
<!-- Page Header -->
<section class="py-5 bg-dark text-white" style="padding-top: 120px !important;">
    <div class="container text-center" data-aos="fade-up">
        <h1 class="fw-bold display-5">Frequently Asked <span class="text-warning">Questions</span></h1>
        <p class="lead text-white-50">Temukan jawaban untuk pertanyaan umum Anda</p>
    </div>
</section>

<!-- FAQ Content -->
<section class="section-padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="accordion" id="faqAccordion">
                    @forelse($faqs ?? [] as $faq)
                    <div class="accordion-item" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                        <h2 class="accordion-header">
                            <button class="accordion-button {{ $loop->first ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#faq{{ $loop->index }}">
                                {{ $faq->pertanyaan }}
                            </button>
                        </h2>
                        <div id="faq{{ $loop->index }}" class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted">
                                {{ $faq->jawaban }}
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-5">
                        <p class="text-muted">Belum ada FAQ</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="section-padding bg-light">
    <div class="container text-center" data-aos="zoom-in">
        <h3 class="fw-bold mb-3">Masih Punya Pertanyaan?</h3>
        <p class="text-muted mb-4">Tim kami siap membantu Anda</p>
        <a href="https://wa.me/6281234567890" target="_blank" class="btn btn-primary-custom btn-lg">
            <i class="bi bi-whatsapp me-2"></i>Chat WhatsApp
        </a>
    </div>
</section>
@endsection