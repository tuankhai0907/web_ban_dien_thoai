<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\SanPham;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'san_pham_id',
        'quantity',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sanPham()
    {
        return $this->belongsTo(SanPham::class, 'san_pham_id', 'ma_san_pham');
    }
}