<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DanhMuc extends Model
{
    protected $table = 'danh_mucs';

    protected $primaryKey = 'ma_danh_muc';

    protected $fillable = ['ten_danh_muc'];
}
