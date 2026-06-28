<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama', 'slug', 'deskripsi', 'harga', 'harga_diskon',
        'fitur', 'durasi_hari', 'icon', 'is_active', 'urutan'
    ];

    protected $casts = [
        'fitur' => 'array',
        'harga' => 'decimal:2',
        'harga_diskon' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public function pesanans()
    {
        return $this->hasMany(Pesanan::class);
    }
}