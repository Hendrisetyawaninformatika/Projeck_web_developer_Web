<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Paket;
use App\Services\FirebaseStorageService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PemesananController extends Controller
{
    protected $firebaseStorage;

    public function __construct(FirebaseStorageService $firebaseStorage)
    {
        $this->firebaseStorage = $firebaseStorage;
    }

    public function index()
    {
        $pakets = Paket::where('is_active', true)->orderBy('urutan')->get();
        return view('pemesanan', compact('pakets'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'paket_id' => 'required|exists:pakets,id',
            'nama_proyek' => 'required|string|max:255',
            'deskripsi_proyek' => 'required|string',
            'file' => 'nullable|file|max:10240|mimes:jpg,jpeg,png,pdf',
            'deadline' => 'required|date|after:today',
        ]);

        $paket = Paket::findOrFail($request->paket_id);

        // Upload file ke Firebase Storage jika ada
        $fileUrl = null;
        if ($request->hasFile('file')) {
            $fileUrl = $this->firebaseStorage->uploadFile(
                $request->file('file'),
                'pesanan-files/' . auth()->id()
            );
        }

        // Generate kode pesanan
        $kodePesanan = 'WD-' . date('Ymd') . '-' . strtoupper(Str::random(4));

        $pesanan = Pesanan::create([
            'kode_pesanan' => $kodePesanan,
            'user_id' => auth()->id(),
            'paket_id' => $request->paket_id,
            'nama_proyek' => $request->nama_proyek,
            'deskripsi_proyek' => $request->deskripsi_proyek,
            'logo_url' => $fileUrl,
            'file_url' => $fileUrl,
            'deadline' => $request->deadline,
            'harga' => $paket->harga_diskon ?? $paket->harga,
            'status' => 'pending',
        ]);

        return redirect()->route('user.pesanans.show', $pesanan)
            ->with('success', 'Pesanan berhasil dibuat! Kode pesanan Anda: ' . $kodePesanan);
    }
}