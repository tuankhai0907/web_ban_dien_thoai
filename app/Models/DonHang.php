<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonHang extends Model
{
    use HasFactory;

    protected $table = 'don_hangs'; // Tên bảng trong cơ sở dữ liệu

    protected $primaryKey = 'ma_don_hang'; // Khóa chính của bảng

    protected $fillable = [
        'ma_nguoi_dung',
        'ngay_dat_hang',
        'tong_tien'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'ma_nguoi_dung', 'ma_nguoi_dung');
    }
    public function chiTietDonHang()
    {
        return $this->hasMany(ChiTietDonHang::class, 'ma_don_hang', 'ma_don_hang');
    }
}