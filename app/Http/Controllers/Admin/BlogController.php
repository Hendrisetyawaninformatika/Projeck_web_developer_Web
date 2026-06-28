<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Services\FirebaseStorageService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    protected $firebaseStorage;

    public function __construct(FirebaseStorageService $firebaseStorage)
    {
        $this->firebaseStorage = $firebaseStorage;
    }

    public function index()
    {
        $blogs = Blog::with('user')->latest()->get();
        return view('admin.blogs.index', compact('blogs'));
    }

    public function create()
    {
        return view('admin.blogs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'gambar' => 'nullable|image|max:5120',
            'kategori' => 'required|string',
            'is_published' => 'boolean',
        ]);

        $gambarUrl = null;
        if ($request->hasFile('gambar')) {
            $gambarUrl = $this->firebaseStorage->uploadFile(
                $request->file('gambar'),
                'blogs'
            );
        }

        Blog::create([
            'judul' => $request->judul,
            'slug' => Str::slug($request->judul),
            'konten' => $request->konten,
            'gambar_url' => $gambarUrl,
            'kategori' => $request->kategori,
            'user_id' => auth()->id(),
            'is_published' => $request->boolean('is_published', true),
            'published_at' => $request->boolean('is_published') ? now() : null,
        ]);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog ditambahkan');
    }

    public function edit(Blog $blog)
    {
        return view('admin.blogs.edit', compact('blog'));
    }

    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'gambar' => 'nullable|image|max:5120',
            'kategori' => 'required|string',
        ]);

        $data = $request->except('gambar');

        if ($request->hasFile('gambar')) {
            if ($blog->gambar_url) {
                $this->firebaseStorage->deleteFile($blog->gambar_url);
            }
            $data['gambar_url'] = $this->firebaseStorage->uploadFile(
                $request->file('gambar'),
                'blogs'
            );
        }

        if ($request->boolean('is_published') && !$blog->published_at) {
            $data['published_at'] = now();
        }

        $blog->update($data);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog diupdate');
    }

    public function destroy(Blog $blog)
    {
        if ($blog->gambar_url) {
            $this->firebaseStorage->deleteFile($blog->gambar_url);
        }

        $blog->delete();
        return redirect()->route('admin.blogs.index')->with('success', 'Blog dihapus');
    }
}