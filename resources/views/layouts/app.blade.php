<!DOCTYPE html>
<html lang="id" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Jasa Web Developer Profesional') | {{ config('app.name') }}</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #FFD700;
            --secondary-color: #1a1a2e;
            --accent-color: #f8f9fa;
            --text-dark: #1a1a2e;
            --text-light: #6c757d;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #ffffff;
            color: var(--text-dark);
            overflow-x: hidden;
        }

        /* Navbar */
        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(0,0,0,0.05);
            padding: 15px 0;
            transition: all 0.3s ease;
        }

        .navbar-brand {
            font-weight: 800;
            font-size: 1.5rem;
            color: var(--secondary-color) !important;
        }

        .navbar-brand span {
            color: var(--primary-color);
        }

        .nav-link {
            font-weight: 500;
            color: var(--text-dark) !important;
            margin: 0 10px;
            position: relative;
            transition: all 0.3s ease;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--primary-color);
            transition: width 0.3s ease;
        }

        .nav-link:hover::after,
        .nav-link.active::after {
            width: 100%;
        }

        .btn-primary-custom {
            background: var(--primary-color);
            color: var(--secondary-color);
            border: none;
            padding: 10px 25px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary-custom:hover {
            background: #e6c200;
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(255, 215, 0, 0.4);
        }

        .btn-outline-custom {
            border: 2px solid var(--primary-color);
            color: var(--secondary-color);
            padding: 10px 25px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-outline-custom:hover {
            background: var(--primary-color);
            color: var(--secondary-color);
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(255,215,0,0.1) 0%, transparent 70%);
            border-radius: 50%;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            color: #fff;
            line-height: 1.2;
        }

        .hero-title span {
            color: var(--primary-color);
        }

        .hero-subtitle {
            font-size: 1.1rem;
            color: rgba(255,255,255,0.8);
            margin: 20px 0 30px;
        }

        /* Section Styles */
        .section-padding {
            padding: 80px 0;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 15px;
        }

        .section-title span {
            color: var(--primary-color);
        }

        .section-subtitle {
            text-align: center;
            color: var(--text-light);
            margin-bottom: 50px;
        }

        /* Cards */
        .service-card {
            background: #fff;
            border-radius: 20px;
            padding: 35px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.08);
            transition: all 0.4s ease;
            border: 1px solid rgba(0,0,0,0.05);
            height: 100%;
        }

        .service-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 60px rgba(0,0,0,0.15);
        }

        .service-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, var(--primary-color), #ffed4a);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            color: var(--secondary-color);
            margin-bottom: 20px;
        }

        /* Pricing Cards */
        .pricing-card {
            background: #fff;
            border-radius: 25px;
            padding: 40px 30px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.08);
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
            height: 100%;
        }

        .pricing-card.featured {
            border: 3px solid var(--primary-color);
            transform: scale(1.05);
        }

        .pricing-card.featured::before {
            content: 'POPULER';
            position: absolute;
            top: 20px;
            right: -35px;
            background: var(--primary-color);
            color: var(--secondary-color);
            padding: 5px 40px;
            font-size: 0.75rem;
            font-weight: 700;
            transform: rotate(45deg);
        }

        .pricing-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 25px 60px rgba(0,0,0,0.15);
        }

        .pricing-card.featured:hover {
            transform: scale(1.05) translateY(-10px);
        }

        .price {
            font-size: 3rem;
            font-weight: 800;
            color: var(--secondary-color);
        }

        .price span {
            font-size: 1rem;
            color: var(--text-light);
            font-weight: 400;
        }

        /* Portfolio */
        .portfolio-item {
            position: relative;
            border-radius: 20px;
            overflow: hidden;
            cursor: pointer;
        }

        .portfolio-item img {
            width: 100%;
            height: 300px;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .portfolio-item:hover img {
            transform: scale(1.1);
        }

        .portfolio-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(to top, rgba(26,26,46,0.95), transparent);
            padding: 30px 20px 20px;
            color: #fff;
            transform: translateY(100%);
            transition: transform 0.4s ease;
        }

        .portfolio-item:hover .portfolio-overlay {
            transform: translateY(0);
        }

        /* Testimonials */
        .testimonial-card {
            background: #fff;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.08);
        }

        .testimonial-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid var(--primary-color);
        }

        .stars {
            color: var(--primary-color);
        }

        /* FAQ */
        .accordion-item {
            border: none;
            margin-bottom: 15px;
            border-radius: 15px !important;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        }

        .accordion-button {
            padding: 20px 25px;
            font-weight: 600;
            background: #fff;
            border: none;
        }

        .accordion-button:not(.collapsed) {
            background: var(--primary-color);
            color: var(--secondary-color);
            box-shadow: none;
        }

        .accordion-button:focus {
            box-shadow: none;
            border-color: rgba(0,0,0,0.125);
        }

        /* Footer */
        .footer {
            background: var(--secondary-color);
            color: #fff;
            padding: 60px 0 20px;
        }

        .footer-brand {
            font-size: 1.5rem;
            font-weight: 800;
        }

        .footer-brand span {
            color: var(--primary-color);
        }

        .footer-link {
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            transition: color 0.3s ease;
            display: block;
            margin-bottom: 10px;
        }

        .footer-link:hover {
            color: var(--primary-color);
        }

        .social-icon {
            width: 40px;
            height: 40px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            margin-right: 10px;
            transition: all 0.3s ease;
        }

        .social-icon:hover {
            background: var(--primary-color);
            color: var(--secondary-color);
            transform: translateY(-3px);
        }

        /* WhatsApp Float */
        .whatsapp-float {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 60px;
            height: 60px;
            background: #25D366;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 1.8rem;
            box-shadow: 0 5px 20px rgba(37, 211, 102, 0.4);
            z-index: 1000;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .whatsapp-float:hover {
            transform: scale(1.1) rotate(10deg);
            color: #fff;
        }

        /* Dark Mode Toggle */
        .dark-mode-toggle {
            position: fixed;
            bottom: 30px;
            left: 30px;
            width: 50px;
            height: 50px;
            background: var(--secondary-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-color);
            font-size: 1.3rem;
            box-shadow: 0 5px 20px rgba(0,0,0,0.2);
            z-index: 1000;
            cursor: pointer;
            border: none;
            transition: all 0.3s ease;
        }

        .dark-mode-toggle:hover {
            transform: scale(1.1);
        }

        /* Animations */
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }

        .floating {
            animation: float 3s ease-in-out infinite;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.2rem;
            }
            
            .section-title {
                font-size: 1.8rem;
            }
            
            .pricing-card.featured {
                transform: scale(1);
            }
        }

        /* Dark Mode */
        [data-bs-theme="dark"] {
            --bs-body-bg: #0f0f23;
            --bs-body-color: #e0e0e0;
        }

        [data-bs-theme="dark"] .navbar {
            background: rgba(15, 15, 35, 0.95);
        }

        [data-bs-theme="dark"] .service-card,
        [data-bs-theme="dark"] .pricing-card,
        [data-bs-theme="dark"] .testimonial-card,
        [data-bs-theme="dark"] .accordion-item,
        [data-bs-theme="dark"] .accordion-button {
            background: #1a1a3e;
            color: #e0e0e0;
            border-color: rgba(255,255,255,0.1);
        }

        [data-bs-theme="dark"] .accordion-button:not(.collapsed) {
            background: var(--primary-color);
            color: var(--secondary-color);
        }
    </style>

    @stack('styles')
</head>
<body>
    @include('layouts.partials.navbar')

    <main>
        @yield('content')
    </main>

    @include('layouts.partials.footer')

    <!-- WhatsApp Float -->
    <a href="https://wa.me/6281234567890?text=Halo,%20saya%20tertarik%20dengan%20jasa%20web%20developer%20Anda" 
       class="whatsapp-float" target="_blank" data-aos="zoom-in" data-aos-delay="1000">
        <i class="bi bi-whatsapp"></i>
    </a>

    <!-- Dark Mode Toggle -->
    <button class="dark-mode-toggle" id="darkModeToggle" data-aos="zoom-in" data-aos-delay="1200">
        <i class="bi bi-moon-fill"></i>
    </button>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AOS Animation -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            once: true,
            offset: 100
        });

        // Dark Mode Toggle
        const darkModeToggle = document.getElementById('darkModeToggle');
        const html = document.documentElement;
        const icon = darkModeToggle.querySelector('i');

        // Check saved preference
        if (localStorage.getItem('darkMode') === 'true') {
            html.setAttribute('data-bs-theme', 'dark');
            icon.classList.replace('bi-moon-fill', 'bi-sun-fill');
        }

        darkModeToggle.addEventListener('click', () => {
            if (html.getAttribute('data-bs-theme') === 'dark') {
                html.setAttribute('data-bs-theme', 'light');
                icon.classList.replace('bi-sun-fill', 'bi-moon-fill');
                localStorage.setItem('darkMode', 'false');
            } else {
                html.setAttribute('data-bs-theme', 'dark');
                icon.classList.replace('bi-moon-fill', 'bi-sun-fill');
                localStorage.setItem('darkMode', 'true');
            }
        });

        // Navbar scroll effect
        window.addEventListener('scroll', () => {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.style.padding = '10px 0';
                navbar.style.boxShadow = '0 5px 30px rgba(0,0,0,0.1)';
            } else {
                navbar.style.padding = '15px 0';
                navbar.style.boxShadow = '0 2px 20px rgba(0,0,0,0.05)';
            }
        });
    </script>

    @stack('scripts')
</body>
</html>