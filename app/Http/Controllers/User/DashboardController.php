<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        $totalPesanan = $user->pesanans()->count();
        $pesananDiproses = $user->pesanans()->whereIn('status', ['pending', 'diproses', 'revisi'])->count();
        $pesananSelesai = $user->pesanans()->where('status', 'selesai')->count();
        
        $recentPesanans = $user->pesanans()->with('paket')->latest()->take(5)->get();

        return view('user.dashboard', compact(
            'totalPesanan', 'pesananDiproses', 'pesananSelesai', 'recentPesanans'
        ));
    }
}