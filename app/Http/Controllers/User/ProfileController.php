<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    public function index()
    {
        $pesanans = auth()->user()->pesanans()->with('paket')->latest()->get();
        return view('user.pesanans.index', compact('pesanans'));
    }

    public function show(Pesanan $pesanan)
    {
        // Pastikan user hanya bisa lihat pesanan sendiri
        if ($pesanan->user_id !== auth()->id()) {
            abort(403);
        }

        return view('user.pesanans.show', compact('pesanan'));
    }
}