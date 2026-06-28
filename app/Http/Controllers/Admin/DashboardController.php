<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Pesanan;
use App\Models\Portofolio;
use App\Models\Blog;
use App\Models\Testimoni;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalPesanan = Pesanan::count();
        $totalPendapatan = Pesanan::where('status', 'selesai')->sum('harga');
        $pesananPending = Pesanan::where('status', 'pending')->count();
        
        $recentPesanans = Pesanan::with(['user', 'paket'])->latest()->take(5)->get();
        
        $statusCounts = [
            'pending' => Pesanan::where('status', 'pending')->count(),
            'diproses' => Pesanan::where('status', 'diproses')->count(),
            'revisi' => Pesanan::where('status', 'revisi')->count(),
            'selesai' => Pesanan::where('status', 'selesai')->count(),
            'dibatalkan' => Pesanan::where('status', 'dibatalkan')->count(),
        ];

        return view('admin.dashboard', compact(
            'totalUsers', 'totalPesanan', 'totalPendapatan', 
            'pesananPending', 'recentPesanans', 'statusCounts'
        ));
    }
}