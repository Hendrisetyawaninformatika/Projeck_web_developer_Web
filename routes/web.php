<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PaketController;
use App\Http\Controllers\Admin\PortofolioController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\TestimoniController;
use App\Http\Controllers\Admin\FAQController;
use App\Http\Controllers\Admin\PesananController as AdminPesananController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\PesananController as UserPesananController;

// ==================== PUBLIC ROUTES ====================
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/tentang-kami', [HomeController::class, 'about'])->name('about');
Route::get('/layanan', [HomeController::class, 'services'])->name('services');
Route::get('/portofolio', [HomeController::class, 'portfolio'])->name('portfolio');
Route::get('/harga', [HomeController::class, 'pricing'])->name('pricing');
Route::get('/testimoni', [HomeController::class, 'testimoni'])->name('testimoni');
Route::get('/blog', [HomeController::class, 'blog'])->name('blog');
Route::get('/faq', [HomeController::class, 'faq'])->name('faq');
Route::get('/kontak', [ContactController::class, 'index'])->name('contact');

// ==================== AUTH ROUTES ====================
Route::middleware('guest')->group(function () {
    // Login
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    
    // Register
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
    
    // Google OAuth
    Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('auth.google');
    Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);
    
    // Forgot Password
    Route::get('/lupa-password', [ForgotPasswordController::class, 'showForm'])->name('password.request');
    Route::post('/lupa-password', [ForgotPasswordController::class, 'sendResetLink'])->name('password.email');
});

// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// ==================== PEMESANAN ====================
Route::middleware('auth')->group(function () {
    Route::get('/pemesanan', [PemesananController::class, 'index'])->name('pemesanan');
    Route::post('/pemesanan', [PemesananController::class, 'store'])->name('pemesanan.store');
});

// ==================== ADMIN ROUTES ====================
Route::prefix('admin')->middleware(['auth', 'role:admin'])->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    
    // Users CRUD
    Route::resource('users', UserController::class);
    
    // Pakets CRUD
    Route::resource('pakets', PaketController::class);
    
    // Portofolios CRUD
    Route::resource('portofolios', PortofolioController::class);
    
    // Blogs CRUD
    Route::resource('blogs', BlogController::class);
    
    // Testimonis CRUD
    Route::resource('testimonis', TestimoniController::class);
    
    // FAQs CRUD
    Route::resource('faqs', FAQController::class);
    
    // Pesanans CRUD
    Route::resource('pesanans', AdminPesananController::class);
    Route::post('/pesanans/{pesanan}/update-status', [AdminPesananController::class, 'updateStatus'])->name('pesanans.update-status');
    
    // Settings
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');
});

// ==================== USER ROUTES ====================
Route::prefix('user')->middleware(['auth', 'role:user'])->name('user.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
    
    // Profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    
    // Pesanans
    Route::get('/pesanans', [UserPesananController::class, 'index'])->name('pesanans.index');
    Route::get('/pesanans/{pesanan}', [UserPesananController::class, 'show'])->name('pesanans.show');
});