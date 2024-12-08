<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\SanPham;

class HomeController extends Controller  
{  
    private $sanpham;

    public function __construct()
    {
        $this->sanpham = new SanPham();
    }
    public function index(Request $request)
    {
        $sanPhams = $this->sanpham->where('thuong_hieu', 'Apple')->orderBy('created_at', 'desc')->paginate(4);
    
        $oppo = $this->sanpham->where('thuong_hieu', 'Oppo')->orderBy('created_at', 'desc')->paginate(4);

        $samsung = $this->sanpham->where('thuong_hieu', 'samsung')->orderBy('created_at', 'desc')->paginate(4);
    
        return view('home.index', compact('sanPhams', 'oppo','samsung',));
    }
    
}
