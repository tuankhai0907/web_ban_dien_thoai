<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SanPham extends Model
{
    protected $table = 'san_phams';

    protected $primaryKey = 'ma_san_pham';
    protected $fillable = ['ten_san_pham', 'thuong_hieu', 'gia', 'mo_ta', 'duong_dan_hinh_anh','so_luong', 
    'chi_tiet_1', 'chi_tiet_2', 'chi_tiet_3', 'chi_tiet_4'];
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
}
