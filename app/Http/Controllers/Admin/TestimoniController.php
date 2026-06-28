<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimoni;
use Illuminate\Http\Request;

class TestimoniController extends Controller
{
    public function index()
    {
        $testimonis = Testimoni::latest()->get();
        return view('admin.testimonis.index', compact('testimonis'));
    }

    public function create()
    {
        return view('admin.testimonis.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email',
            'perusahaan' => 'nullable|string',
            'jabatan' => 'nullable|string',
            'isi' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        Testimoni::create($request->all() + ['is_active' => true]);

        return redirect()->route('admin.testimonis.index')->with('success', 'Testimoni ditambahkan');
    }

    public function edit(Testimoni $testimoni)
    {
        return view('admin.testimonis.edit', compact('testimoni'));
    }

    public function update(Request $request, Testimoni $testimoni)
    {
        $request->validate([
            'nama' => 'required|string',
            'email' => 'required|email',
            'isi' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'is_active' => 'boolean',
        ]);

        $testimoni->update($request->all());

        return redirect()->route('admin.testimonis.index')->with('success', 'Testimoni diupdate');
    }

    public function destroy(Testimoni $testimoni)
    {
        $testimoni->delete();
        return redirect()->route('admin.testimonis.index')->with('success', 'Testimoni dihapus');
    }

    public function toggleStatus(Testimoni $testimoni)
    {
        $testimoni->update(['is_active' => !$testimoni->is_active]);
        return back()->with('success', 'Status testimoni diupdate');
    }
}