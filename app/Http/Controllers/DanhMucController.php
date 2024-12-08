<?php

namespace App\Http\Controllers;
use App\Models\DanhMuc;

use Illuminate\Http\Request;

class DanhMucController extends Controller
{
    public function create()
    {
        return view('danhmuc.create');
    }

    public function store(Request $request)  
    {  
        // Xác thực dữ liệu đầu vào  
        $request->validate([  
            'ten_danh_muc' => 'required|max:255',  
        ]);  
    
        // Tạo mới danh mục  
        DanhMuc::create([   
            'ten_danh_muc' => $request->input('ten_danh_muc'),  
        ]);  
    
        // Chuyển hướng về trang danh sách  
        return redirect()->route('danhmuc.index')->with('success', 'Danh mục đã được thêm thành công.');  
    }
    
}
