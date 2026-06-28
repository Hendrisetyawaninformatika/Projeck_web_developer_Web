<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_pesanan', 'user_id', 'paket_id', 'nama_proyek',
        'deskripsi_proyek', 'logo_url', 'file_url', 'deadline',
        'harga', 'status', 'catatan_admin', 'tanggal_diproses', 'tanggal_selesai'
    ];

    protected $casts = [
        'deadline' => 'date',
        'tanggal_diproses' => 'datetime',
        'tanggal_selesai' => 'datetime',
        'harga' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function paket()
    {
        return $this->belongsTo(Paket::class);
    }

    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            'pending' => '<span class="badge bg-warning">Pending</span>',
            'diproses' => '<span class="badge bg-info">Diproses</span>',
            'revisi' => '<span class="badge bg-primary">Revisi</span>',
            'selesai' => '<span class="badge bg-success">Selesai</span>',
            'dibatalkan' => '<span class="badge bg-danger">Dibatalkan</span>',
            default => '<span class="badge bg-secondary">Unknown</span>',
        };
    }
}