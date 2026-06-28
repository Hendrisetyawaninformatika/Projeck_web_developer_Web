<?php

namespace Database\Seeders;

use App\Models\Paket;
use Illuminate\Database\Seeder;

class PaketSeeder extends Seeder
{
    public function run(): void
    {
        $pakets = [
            [
                'nama' => 'Starter',
                'slug' => 'starter',
                'deskripsi' => 'Paket dasar untuk UMKM dan personal branding',
                'harga' => 2500000,
                'fitur' => ['5 Halaman', 'Responsive Design', 'Basic SEO', '1x Revisi', 'Gratis Domain .com'],
                'durasi_hari' => 7,
                'urutan' => 1,
            ],
            [
                'nama' => 'Professional',
                'slug' => 'professional',
                'deskripsi' => 'Paket lengkap untuk bisnis menengah',
                'harga' => 5000000,
                'fitur' => ['10 Halaman', 'Responsive Design', 'Advanced SEO', 'Unlimited Revisi', 'Gratis Domain .com', 'Panel Admin', 'Blog System'],
                'durasi_hari' => 14,
                'urutan' => 2,
            ],
            [
                'nama' => 'Enterprise',
                'slug' => 'enterprise',
                'deskripsi' => 'Solusi enterprise untuk perusahaan besar',
                'harga' => 10000000,
                'fitur' => ['Unlimited Halaman', 'Custom Design', 'Premium SEO', 'Unlimited Revisi', 'Gratis Domain .com', 'Panel Admin', 'Multi Bahasa', 'Maintenance 1 Tahun'],
                'durasi_hari' => 30,
                'urutan' => 3,
            ],
        ];

        foreach ($pakets as $paket) {
            Paket::create($paket);
        }
    }
}