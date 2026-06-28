<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    public function index(Request $request)
    {
        $query = Pesanan::with(['user', 'paket'])->latest();

        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        $pesanans = $query->get();
        return view('admin.pesanans.index', compact('pesanans'));
    }

    public function show(Pesanan $pesanan)
    {
        return view('admin.pesanans.show', compact('pesanan'));
    }

    public function edit(Pesanan $pesanan)
    {
        return view('admin.pesanans.edit', compact('pesanan'));
    }

    public function update(Request $request, Pesanan $pesanan)
    {
        $request->validate([
            'status' => 'required|in:pending,diproses,revisi,selesai,dibatalkan',
            'catatan_admin' => 'nullable|string',
        ]);

        $updateData = [
            'status' => $request->status,
            'catatan_admin' => $request->catatan_admin,
        ];

        if ($request->status === 'diproses' && !$pesanan->tanggal_diproses) {
            $updateData['tanggal_diproses'] = now();
        }

        if ($request->status === 'selesai' && !$pesanan->tanggal_selesai) {
            $updateData['tanggal_selesai'] = now();
        }

        $pesanan->update($updateData);

        return redirect()->route('admin.pesanans.index')->with('success', 'Status pesanan diupdate');
    }

    public function updateStatus(Request $request, Pesanan $pesanan)
    {
        $request->validate([
            'status' => 'required|in:pending,diproses,revisi,selesai,dibatalkan',
        ]);

        $pesanan->update(['status' => $request->status]);

        if ($request->ajax()) {
            return response()->json(['success' => true]);
        }

        return back()->with('success', 'Status diupdate');
    }

    public function destroy(Pesanan $pesanan)
    {
        $pesanan->delete();
        return redirect()->route('admin.pesanans.index')->with('success', 'Pesanan dihapus');
    }
}