@extends('layouts.app')

@section('title', 'Pemesanan Website')

@push('styles')
<style>
    .form-section {
        background: #fff;
        border-radius: 20px;
        padding: 40px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.08);
    }
    
    .form-control, .form-select {
        border-radius: 12px;
        padding: 12px 18px;
        border: 2px solid #e9ecef;
        transition: all 0.3s ease;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: #FFD700;
        box-shadow: 0 0 0 0.25rem rgba(255, 215, 0, 0.25);
    }
    
    .form-label {
        font-weight: 600;
        color: #1a1a2e;
        margin-bottom: 8px;
    }
    
    .step-indicator {
        display: flex;
        justify-content: center;
        margin-bottom: 40px;
    }
    
    .step {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: #e9ecef;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        color: #6c757d;
        position: relative;
    }
    
    .step.active {
        background: #FFD700;
        color: #1a1a2e;
    }
    
    .step.completed {
        background: #28a745;
        color: #fff;
    }
    
    .step-line {
        width: 100px;
        height: 3px;
        background: #e9ecef;
        margin: 18px 10px;
    }
    
    .step-line.active {
        background: #FFD700;
    }
    
    .package-card {
        border: 2px solid #e9ecef;
        border-radius: 15px;
        padding: 20px;
        cursor: pointer;
        transition: all 0.3s ease;
        text-align: center;
    }
    
    .package-card:hover, .package-card.selected {
        border-color: #FFD700;
        background: rgba(255, 215, 0, 0.05);
    }
    
    .package-card.selected {
        box-shadow: 0 5px 20px rgba(255, 215, 0, 0.2);
    }
    
    .file-upload-zone {
        border: 2px dashed #e9ecef;
        border-radius: 15px;
        padding: 40px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .file-upload-zone:hover {
        border-color: #FFD700;
        background: rgba(255, 215, 0, 0.05);
    }
</style>
@endpush

@section('content')
<!-- Page Header -->
<section class="py-5 bg-dark text-white" style="padding-top: 120px !important;">
    <div class="container text-center" data-aos="fade-up">
        <h1 class="fw-bold display-5">Pemesanan <span class="text-warning">Website</span></h1>
        <p class="lead text-white-50">Isi form di bawah untuk memulai proyek website Anda</p>
    </div>
</section>

<!-- Form Pemesanan -->
<section class="section-padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Step Indicator -->
                <div class="step-indicator">
                    <div class="step active" id="step1-indicator">1</div>
                    <div class="step-line" id="line1"></div>
                    <div class="step" id="step2-indicator">2</div>
                    <div class="step-line" id="line2"></div>
                    <div class="step" id="step3-indicator">3</div>
                </div>
                
                <div class="form-section">
                    <form action="{{ route('pemesanan.store') }}" method="POST" enctype="multipart/form-data" id="orderForm">
                        @csrf
                        
                        <!-- Step 1: Pilih Paket -->
                        <div class="step-content" id="step1">
                            <h4 class="fw-bold mb-4">Pilih <span class="text-warning">Paket</span></h4>
                            
                            <div class="row g-3 mb-4">
                                @php
                                $pakets = \App\Models\Paket::where('is_active', true)->orderBy('urutan')->get();
                                $selectedPaket = request('paket');
                                @endphp
                                
                                @forelse($pakets as $paket)
                                <div class="col-md-4">
                                    <div class="package-card {{ $selectedPaket == $paket->nama ? 'selected' : '' }}" 
                                         onclick="selectPackage('{{ $paket->id }}', '{{ $paket->nama }}', '{{ $paket->harga }}')">
                                        <h5 class="fw-bold">{{ $paket->nama }}</h5>
                                        <p class="text-muted small mb-2">{{ $paket->durasi_hari }} hari pengerjaan</p>
                                        <h6 class="text-warning fw-bold">Rp {{ number_format($paket->harga, 0, ',', '.') }}</h6>
                                    </div>
                                </div>
                                @empty
                                <div class="col-md-4">
                                    <div class="package-card {{ $selectedPaket == 'Starter' ? 'selected' : '' }}" 
                                         onclick="selectPackage('1', 'Starter', '2500000')">
                                        <h5 class="fw-bold">Starter</h5>
                                        <p class="text-muted small mb-2">7-14 hari</p>
                                        <h6 class="text-warning fw-bold">Rp 2.500.000</h6>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="package-card {{ $selectedPaket == 'Professional' ? 'selected' : '' }}" 
                                         onclick="selectPackage('2', 'Professional', '5000000')">
                                        <h5 class="fw-bold">Professional</h5>
                                        <p class="text-muted small mb-2">14-30 hari</p>
                                        <h6 class="text-warning fw-bold">Rp 5.000.000</h6>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="package-card {{ $selectedPaket == 'Enterprise' ? 'selected' : '' }}" 
                                         onclick="selectPackage('3', 'Enterprise', '10000000')">
                                        <h5 class="fw-bold">Enterprise</h5>
                                        <p class="text-muted small mb-2">30-60 hari</p>
                                        <h6 class="text-warning fw-bold">Rp 10.000.000</h6>
                                    </div>
                                </div>
                                @endforelse
                            </div>
                            
                            <input type="hidden" name="paket_id" id="paket_id" required>
                            
                            <div class="text-end">
                                <button type="button" class="btn btn-primary-custom" onclick="nextStep(2)">
                                    Lanjutkan <i class="bi bi-arrow-right ms-2"></i>
                                </button>
                            </div>
                        </div>
                        
                        <!-- Step 2: Detail Proyek -->
                        <div class="step-content d-none" id="step2">
                            <h4 class="fw-bold mb-4">Detail <span class="text-warning">Proyek</span></h4>
                            
                            <div class="mb-3">
                                <label class="form-label">Nama Proyek <span class="text-danger">*</span></label>
                                <input type="text" name="nama_proyek" class="form-control" placeholder="Contoh: Website Company Profile PT. ABC" required>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Deskripsi Proyek <span class="text-danger">*</span></label>
                                <textarea name="deskripsi_proyek" class="form-control" rows="4" placeholder="Jelaskan kebutuhan website Anda secara detail..." required></textarea>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Upload Logo/Referensi</label>
                                <div class="file-upload-zone" onclick="document.getElementById('file_upload').click()">
                                    <i class="bi bi-cloud-upload fs-1 text-warning mb-2"></i>
                                    <p class="mb-1">Klik atau drag file ke sini</p>
                                    <small class="text-muted">Format: JPG, PNG, PDF (Max 10MB)</small>
                                </div>
                                <input type="file" name="file" id="file_upload" class="d-none" accept=".jpg,.jpeg,.png,.pdf">
                                <div id="file-name" class="mt-2 small text-success"></div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Deadline Proyek <span class="text-danger">*</span></label>
                                <input type="date" name="deadline" class="form-control" required 
                                       min="{{ date('Y-m-d', strtotime('+7 days')) }}">
                            </div>
                            
                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-outline-custom" onclick="prevStep(1)">
                                    <i class="bi bi-arrow-left me-2"></i>Kembali
                                </button>
                                <button type="button" class="btn btn-primary-custom" onclick="nextStep(3)">
                                    Lanjutkan <i class="bi bi-arrow-right ms-2"></i>
                                </button>
                            </div>
                        </div>
                        
                        <!-- Step 3: Konfirmasi -->
                        <div class="step-content d-none" id="step3">
                            <h4 class="fw-bold mb-4">Konfirmasi <span class="text-warning">Pesanan</span></h4>
                            
                            <div class="alert alert-warning bg-warning bg-opacity-10 border-warning">
                                <h6 class="fw-bold mb-2"><i class="bi bi-info-circle me-2"></i>Ringkasan Pesanan</h6>
                                <table class="table table-borderless mb-0">
                                    <tr>
                                        <td class="text-muted">Paket</td>
                                        <td class="fw-bold text-end" id="summary-paket">-</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Harga</td>
                                        <td class="fw-bold text-end" id="summary-harga">-</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Nama Proyek</td>
                                        <td class="fw-bold text-end" id="summary-nama">-</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Deadline</td>
                                        <td class="fw-bold text-end" id="summary-deadline">-</td>
                                    </tr>
                                </table>
                            </div>
                            
                            <div class="mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="terms" required>
                                    <label class="form-check-label" for="terms">
                                        Saya menyetujui <a href="#" class="text-warning">syarat dan ketentuan</a> yang berlaku
                                    </label>
                                </div>
                            </div>
                            
                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-outline-custom" onclick="prevStep(2)">
                                    <i class="bi bi-arrow-left me-2"></i>Kembali
                                </button>
                                <button type="submit" class="btn btn-primary-custom btn-lg">
                                    <i class="bi bi-check-circle me-2"></i>Kirim Pesanan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
    let selectedPackageData = {};
    
    function selectPackage(id, name, price) {
        document.querySelectorAll('.package-card').forEach(card => card.classList.remove('selected'));
        event.currentTarget.classList.add('selected');
        document.getElementById('paket_id').value = id;
        selectedPackageData = { id, name, price };
    }
    
    function nextStep(step) {
        // Validasi step 1
        if (step === 2 && !document.getElementById('paket_id').value) {
            alert('Silakan pilih paket terlebih dahulu!');
            return;
        }
        
        // Validasi step 2
        if (step === 3) {
            const nama = document.querySelector('input[name="nama_proyek"]').value;
            const deskripsi = document.querySelector('textarea[name="deskripsi_proyek"]').value;
            const deadline = document.querySelector('input[name="deadline"]').value;
            
            if (!nama || !deskripsi || !deadline) {
                alert('Silakan lengkapi semua field yang wajib diisi!');
                return;
            }
            
            // Update summary
            document.getElementById('summary-paket').textContent = selectedPackageData.name || '-';
            document.getElementById('summary-harga').textContent = 'Rp ' + parseInt(selectedPackageData.price || 0).toLocaleString('id-ID');
            document.getElementById('summary-nama').textContent = nama;
            document.getElementById('summary-deadline').textContent = new Date(deadline).toLocaleDateString('id-ID');
        }
        
        // Update indicators
        for (let i = 1; i <= 3; i++) {
            document.getElementById('step' + i + '-content').classList.add('d-none');
            document.getElementById('step' + i + '-indicator').classList.remove('active');
        }
        
        for (let i = 1; i < step; i++) {
            document.getElementById('step' + i + '-indicator').classList.add('completed');
            document.getElementById('line' + i).classList.add('active');
        }
        
        document.getElementById('step' + step + '-content').classList.remove('d-none');
        document.getElementById('step' + step + '-indicator').classList.add('active');
    }
    
    function prevStep(step) {
        for (let i = 1; i <= 3; i++) {
            document.getElementById('step' + i + '-content').classList.add('d-none');
            document.getElementById('step' + i + '-indicator').classList.remove('active', 'completed');
            document.getElementById('line' + (i-1))?.classList.remove('active');
        }
        
        for (let i = 1; i < step; i++) {
            document.getElementById('step' + i + '-indicator').classList.add('completed');
            document.getElementById('line' + i).classList.add('active');
        }
        
        document.getElementById('step' + step + '-content').classList.remove('d-none');
        document.getElementById('step' + step + '-indicator').classList.add('active');
    }
    
    // File upload preview
    document.getElementById('file_upload').addEventListener('change', function() {
        if (this.files.length > 0) {
            document.getElementById('file-name').textContent = 'File terpilih: ' + this.files[0].name;
        }
    });
</script>
@endpush
@endsection