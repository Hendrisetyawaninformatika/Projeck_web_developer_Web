<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string',
            'subject' => 'required|string',
            'message' => 'required|string',
        ]);

        // Kirim email atau simpan ke database (sesuaikan kebutuhan)
        // Contoh: Mail::to('info@webdevpro.id')->send(new ContactMail($request->all()));

        return back()->with('success', 'Pesan Anda telah terkirim! Kami akan menghubungi Anda segera.');
    }
}