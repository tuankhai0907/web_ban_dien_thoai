<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChiTietDonHang extends Model
{
    protected $table = 'chi_tiet_don_hangs';
    protected $primaryKey = 'ma_chi_tiet_don_hang';
    public $timestamps = true;

    protected $fillable = [
        'ma_don_hang',
        'ma_san_pham',
        'so_luong',
        'thanh_tien',
    ];

    public function donhang()
    {
        return $this->belongsTo(DonHang::class, 'ma_don_hang', 'ma_don_hang');
    }

    public function sanpham()
    {
        return $this->belongsTo(SanPham::class, 'ma_san_pham', 'ma_san_pham');
    }
}
