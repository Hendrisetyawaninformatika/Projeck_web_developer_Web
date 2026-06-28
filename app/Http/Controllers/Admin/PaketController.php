<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Paket;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PaketController extends Controller
{
    public function index()
    {
        $pakets = Paket::orderBy('urutan')->get();
        return view('admin.pakets.index', compact('pakets'));
    }

    public function create()
    {
        return view('admin.pakets.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'harga_diskon' => 'nullable|numeric|min:0',
            'fitur' => 'required|array',
            'durasi_hari' => 'required|integer|min:1',
            'urutan' => 'nullable|integer',
        ]);

        Paket::create([
            'nama' => $request->nama,
            'slug' => Str::slug($request->nama),
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'harga_diskon' => $request->harga_diskon,
            'fitur' => $request->fitur,
            'durasi_hari' => $request->durasi_hari,
            'urutan' => $request->urutan ?? 0,
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.pakets.index')->with('success', 'Paket berhasil ditambahkan');
    }

    public function edit(Paket $paket)
    {
        return view('admin.pakets.edit', compact('paket'));
    }

    public function update(Request $request, Paket $paket)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'harga_diskon' => 'nullable|numeric|min:0',
            'fitur' => 'required|array',
            'durasi_hari' => 'required|integer|min:1',
        ]);

        $paket->update([
            'nama' => $request->nama,
            'slug' => Str::slug($request->nama),
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'harga_diskon' => $request->harga_diskon,
            'fitur' => $request->fitur,
            'durasi_hari' => $request->durasi_hari,
            'urutan' => $request->urutan ?? $paket->urutan,
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.pakets.index')->with('success', 'Paket berhasil diupdate');
    }

    public function destroy(Paket $paket)
    {
        $paket->delete();
        return redirect()->route('admin.pakets.index')->with('success', 'Paket berhasil dihapus');
    }
}