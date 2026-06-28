<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_id',
        'sender_name',
        'sender_phone',
        'receiver_id',
        'product_id',
        'product_name',
        'content',
        'is_read',
    ];

    protected $casts = [
        'is_read' => 'boolean',
    ];
}