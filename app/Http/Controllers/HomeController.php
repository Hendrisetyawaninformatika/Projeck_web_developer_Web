<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use App\Models\Portofolio;
use App\Models\Blog;
use App\Models\Testimoni;
use App\Models\FAQ;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $pakets = Paket::where('is_active', true)->orderBy('urutan')->get();
        $portofolios = Portofolio::where('is_active', true)->latest()->take(4)->get();
        $testimonis = Testimoni::where('is_active', true)->latest()->take(3)->get();
        
        return view('home', compact('pakets', 'portofolios', 'testimonis'));
    }

    public function about()
    {
        return view('about');
    }

    public function services()
    {
        return view('services');
    }

    public function portfolio()
    {
        $portofolios = Portofolio::where('is_active', true)->latest()->get();
        return view('portfolio', compact('portofolios'));
    }

    public function pricing()
    {
        $pakets = Paket::where('is_active', true)->orderBy('urutan')->get();
        $faqs = FAQ::where('is_active', true)->where('kategori', 'harga')->get();
        return view('pricing', compact('pakets', 'faqs'));
    }

    public function testimoni()
    {
        $testimonis = Testimoni::where('is_active', true)->latest()->get();
        return view('testimoni', compact('testimonis'));
    }

    public function blog()
    {
        $blogs = Blog::where('is_published', true)->latest()->paginate(9);
        return view('blog', compact('blogs'));
    }

    public function faq()
    {
        $faqs = FAQ::where('is_active', true)->orderBy('urutan')->get();
        return view('faq', compact('faqs'));
    }
}