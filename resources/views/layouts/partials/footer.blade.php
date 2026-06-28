<footer class="footer">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="footer-brand mb-3">Web<span>Dev</span>Pro</div>
                <p class="text-white-50 mb-4">
                    Solusi digital terbaik untuk bisnis Anda. Kami menghadirkan website modern, responsif, dan berkualitas tinggi.
                </p>
                <div class="social-links">
                    <a href="#" class="social-icon"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="social-icon"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="social-icon"><i class="bi bi-twitter-x"></i></a>
                    <a href="#" class="social-icon"><i class="bi bi-linkedin"></i></a>
                    <a href="#" class="social-icon"><i class="bi bi-youtube"></i></a>
                </div>
            </div>
            
            <div class="col-lg-2 col-md-6">
                <h5 class="text-white mb-3">Menu</h5>
                <a href="{{ route('home') }}" class="footer-link">Beranda</a>
                <a href="{{ route('about') }}" class="footer-link">Tentang Kami</a>
                <a href="{{ route('services') }}" class="footer-link">Layanan</a>
                <a href="{{ route('portfolio') }}" class="footer-link">Portofolio</a>
                <a href="{{ route('pricing') }}" class="footer-link">Paket Harga</a>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <h5 class="text-white mb-3">Layanan</h5>
                <a href="{{ route('services') }}" class="footer-link">Website Company Profile</a>
                <a href="{{ route('services') }}" class="footer-link">E-Commerce</a>
                <a href="{{ route('services') }}" class="footer-link">Web Application</a>
                <a href="{{ route('services') }}" class="footer-link">Landing Page</a>
                <a href="{{ route('services') }}" class="footer-link">SEO Optimization</a>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <h5 class="text-white mb-3">Kontak</h5>
                <p class="text-white-50 mb-2">
                    <i class="bi bi-geo-alt-fill me-2 text-warning"></i>
                    Jakarta, Indonesia
                </p>
                <p class="text-white-50 mb-2">
                    <i class="bi bi-envelope-fill me-2 text-warning"></i>
                    info@webdevpro.id
                </p>
                <p class="text-white-50 mb-2">
                    <i class="bi bi-telephone-fill me-2 text-warning"></i>
                    +62 812-3456-7890
                </p>
                <p class="text-white-50">
                    <i class="bi bi-clock-fill me-2 text-warning"></i>
                    Senin - Jumat: 09:00 - 17:00
                </p>
            </div>
        </div>
        
        <hr class="border-secondary my-4">
        
        <div class="row align-items-center">
            <div class="col-md-6 text-center text-md-start">
                <p class="text-white-50 mb-0">&copy; {{ date('Y') }} WebDevPro. All rights reserved.</p>
            </div>
            <div class="col-md-6 text-center text-md-end">
                <a href="#" class="footer-link d-inline me-3">Privacy Policy</a>
                <a href="#" class="footer-link d-inline">Terms of Service</a>
            </div>
        </div>
    </div>
</footer>