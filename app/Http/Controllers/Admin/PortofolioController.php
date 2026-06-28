<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portofolio;
use App\Services\FirebaseStorageService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PortofolioController extends Controller
{
    protected $firebaseStorage;

    public function __construct(FirebaseStorageService $firebaseStorage)
    {
        $this->firebaseStorage = $firebaseStorage;
    }

    public function index()
    {
        $portofolios = Portofolio::latest()->get();
        return view('admin.portofolios.index', compact('portofolios'));
    }

    public function create()
    {
        return view('admin.portofolios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'kategori' => 'required|string',
            'gambar' => 'required|image|max:5120',
            'link_demo' => 'nullable|url',
            'link_github' => 'nullable|url',
            'teknologi' => 'required|string',
            'client' => 'nullable|string',
            'tanggal_selesai' => 'nullable|date',
        ]);

        $gambarUrl = $this->firebaseStorage->uploadFile(
            $request->file('gambar'),
            'portofolios'
        );

        Portofolio::create([
            'judul' => $request->judul,
            'slug' => Str::slug($request->judul),
            'deskripsi' => $request->deskripsi,
            'kategori' => $request->kategori,
            'gambar_url' => $gambarUrl,
            'link_demo' => $request->link_demo,
            'link_github' => $request->link_github,
            'teknologi' => $request->teknologi,
            'client' => $request->client,
            'tanggal_selesai' => $request->tanggal_selesai,
        ]);

        return redirect()->route('admin.portofolios.index')->with('success', 'Portofolio ditambahkan');
    }

    public function edit(Portofolio $portofolio)
    {
        return view('admin.portofolios.edit', compact('portofolio'));
    }

    public function update(Request $request, Portofolio $portofolio)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'kategori' => 'required|string',
            'gambar' => 'nullable|image|max:5120',
            'link_demo' => 'nullable|url',
            'link_github' => 'nullable|url',
            'teknologi' => 'required|string',
        ]);

        $data = $request->except('gambar');

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            if ($portofolio->gambar_url) {
                $this->firebaseStorage->deleteFile($portofolio->gambar_url);
            }

            $data['gambar_url'] = $this->firebaseStorage->uploadFile(
                $request->file('gambar'),
                'portofolios'
            );
        }

        $portofolio->update($data);

        return redirect()->route('admin.portofolios.index')->with('success', 'Portofolio diupdate');
    }

    public function destroy(Portofolio $portofolio)
    {
        if ($portofolio->gambar_url) {
            $this->firebaseStorage->deleteFile($portofolio->gambar_url);
        }

        $portofolio->delete();
        return redirect()->route('admin.portofolios.index')->with('success', 'Portofolio dihapus');
    }
}