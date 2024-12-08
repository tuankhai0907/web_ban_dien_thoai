<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\SanPham;

class SanPhamController extends Controller
{

    private $sanpham;

    public function __construct()
    {
        $this->sanpham = new SanPham();
    }

    public function index(Request $request)
    {
        $query = $this->sanpham->newQuery();
        $filtered = false;
    
        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('ten_san_pham', 'like', '%' . $searchTerm . '%')
                  ->orWhere('thuong_hieu', 'like', '%' . $searchTerm . '%')
                  ->orWhere('gia', 'like', '%' .$searchTerm.'%');
            });
            $filtered = true;
        }
        
        if ($request->has('gia')) {
            $gia = $request->gia;
            $query->where('gia', 'like', '%' . $gia . '%');
            $filtered = true;
        }
        
        if ($request->has('thuong_hieu')) {
            $thuong_hieu = $request->thuong_hieu;
            $query->where('thuong_hieu', 'like', '%' . $thuong_hieu . '%');
            $filtered = true;
        }
    
        $sanPhams = $query->paginate(4);
    
        return view('sanpham.index', compact('sanPhams', 'filtered'));
    }
    public function qlsanpham(Request $request)
    {
        $query = $this->sanpham->newQuery();
        $filtered = false;
        
        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('ten_san_pham', 'like', '%' . $searchTerm . '%')
                ->orWhere('thuong_hieu', 'like', '%' . $searchTerm . '%')
                ->orWhere('gia', 'like', '%' . $searchTerm . '%');
            });
            $filtered = true;
        }

        // Thêm điều kiện cho thuộc tính 'thương hiệu' là 'apple'
        $queryApple = clone $query;
        $queryApple->where('thuong_hieu', 'apple');
        $countApple = $queryApple->count();

          // Thêm điều kiện cho thuộc tính 'thương hiệu' là 'apple'
        $queryOppo = clone $query;
        $queryOppo->where('thuong_hieu', 'oppo');
        $countOppo = $queryOppo->count();

        $sanPhams = $query->paginate(4); // Phân trang với 4 sản phẩm trên mỗi trang
        $recordCount = $query->count();
        
        return view('sanpham.qlsanpham', compact('sanPhams', 'filtered', 'recordCount', 'countApple','countOppo'));
    }
    

    // Hiển thị form thêm sản phẩm
    public function create()
    {
        return view('sanpham.create');
    }

    // Xử lý dữ liệu từ form và lưu vào cơ sở dữ liệu
    public function store(Request $request)
    {
        $request->validate([
            'ten_san_pham' => 'required',
            'thuong_hieu' => 'required',
            'gia' => 'required|numeric',
            'mo_ta' => 'nullable',
            'duong_dan_hinh_anh' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'chi_tiet_1' =>'nullable',
            'chi_tiet_2' =>'nullable',
            'chi_tiet_3' =>'nullable',
            'chi_tiet_4' =>'nullable',
        ]);
    
        // Xử lý upload hình ảnh nếu có
        $imagePath = null;
        if ($request->hasFile('duong_dan_hinh_anh')) {
            $imagePath = $request->file('duong_dan_hinh_anh')->store('images', 'public');
        }
    
        // Lưu dữ liệu vào cơ sở dữ liệu
        SanPham::create([
            'ten_san_pham' => $request->input('ten_san_pham'),
            'thuong_hieu' => $request->input('thuong_hieu'),
            'gia' => $request->input('gia'),
            'mo_ta' => $request->input('mo_ta'),
            'duong_dan_hinh_anh' => $imagePath,
            'chi_tiet_1' => $request->input('chi_tiet_1'),
            'chi_tiet_2' => $request->input('chi_tiet_2'),
            'chi_tiet_3' => $request->input('chi_tiet_3'),
            'chi_tiet_4' => $request->input('chi_tiet_4'),
        ]);
    
        return redirect()->route('sanpham.qlsanpham')->with('success', 'Sản phẩm đã được thêm thành công.');
    }
    public function destroy(SanPham $sanpham)
    {
        // Kiểm tra và xóa hình ảnh nếu có
        if ($sanpham->duong_dan_hinh_anh) {
            Storage::disk('public')->delete($sanpham->duong_dan_hinh_anh);
        }

        // Xóa sản phẩm
        $sanpham->delete();

        session()->flash('success', 'Xoá sản phẩm thành công.');
        return redirect()->route('sanpham.qlsanpham');
    }
   
    public function show($ma_san_pham)
    {
        $sanpham = SanPham::find($ma_san_pham);
        if (!$sanpham) {
            abort(404); // Trả về trang 404 nếu không tìm thấy sản phẩm
        }
        
        return view('sanpham.show', compact('sanpham'));
    }
    // Hiển thị form sửa sản phẩm
    public function edit(SanPham $sanpham)
    {
        return view('sanpham.edit', compact('sanpham'));
    }

    // Xử lý dữ liệu từ form sửa và cập nhật vào cơ sở dữ liệu
    public function update(Request $request, SanPham $sanpham)
    {
        $request->validate([
            'ten_san_pham' => 'required',
            'thuong_hieu' => 'required',
            'gia' => 'required|numeric',
            'mo_ta' => 'nullable',
            'duong_dan_hinh_anh' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'chi_tiet_1' =>'nullable',
            'chi_tiet_2' =>'nullable',
            'chi_tiet_3' =>'nullable',
            'chi_tiet_4' =>'nullable',
            'so_luong' => 'required',
        ]);
    
        // Xử lý upload hình ảnh nếu có
        $imagePath = $sanpham->duong_dan_hinh_anh;
        if ($request->hasFile('duong_dan_hinh_anh')) {
            // Xóa hình ảnh cũ trước khi upload hình ảnh mới
            if ($imagePath) {
                Storage::disk('public')->delete($imagePath);
            }
            $imagePath = $request->file('duong_dan_hinh_anh')->store('images', 'public');
        }
    
        // Cập nhật dữ liệu vào cơ sở dữ liệu
        $sanpham->update([
            'ten_san_pham' => $request->ten_san_pham,
            'thuong_hieu' => $request->thuong_hieu,
            'gia' => $request->gia,
            'mo_ta' => $request->mo_ta,
            'duong_dan_hinh_anh' => $imagePath,
            'chi_tiet_1' => $request->chi_tiet_1,
            'chi_tiet_2' => $request->chi_tiet_2,
            'chi_tiet_3' => $request->chi_tiet_3,
            'chi_tiet_4' => $request->chi_tiet_4,
            'so_luong' => $request->so_luong,
        ]);
    
        return redirect()->route('sanpham.qlsanpham')->with('success', 'Sản phẩm đã được cập nhật thành công.');
    }
 }
