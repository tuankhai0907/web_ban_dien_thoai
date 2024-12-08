<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DonHang;
use App\Models\SanPham;
use App\Models\ChiTietDonHang;
use App\Models\User;

class DonHangController extends Controller
{

    private $donhang;

    public function __construct()
    {
        $this->donhang = new DonHang();
    }

    public function index()
    {
        $this->middleware('logincheck');

        $ma_nguoi_dung = auth()->id(); // Lấy mã người dùng từ đăng nhập
        $user = User::where('ma_nguoi_dung', $ma_nguoi_dung)->firstOrFail(); // Lấy thông tin người dùng
        $donHangList = DonHang::where('ma_nguoi_dung', $ma_nguoi_dung)->get(); // Lấy danh sách đơn hàng
        
        return view('donhang.index', compact('user', 'donHangList'));
    }


    public function qldonhang(Request $request)
    {
        $query = $this->donhang->newQuery();
        $filtered = false;
    
        if ($request->has('ngay_dat_hang')) {
            $ngay_dat_hang = $request->ngay_dat_hang;
            $query->whereDate('ngay_dat_hang', 'like', '%' . $ngay_dat_hang . '%');
            $filtered = true;
        }
    
        if ($request->has('ma_nguoi_dung')) {
            $ma_nguoi_dung = $request->ma_nguoi_dung;
            $query->where('ma_nguoi_dung', 'like', '%' . $ma_nguoi_dung . '%');
            $filtered = true;
        }
    
        $donHangs = $query->paginate(10); // Phân trang với 10 đơn hàng trên mỗi trang
    
        // Đếm số bản ghi thỏa mãn điều kiện tìm kiếm
        $recordCount = $query->count();
    
        return view('donhang.qldonhang', compact('donHangs', 'filtered', 'recordCount'));
    }

    
    public function create()
    {
        return view('donhang.create');
    }
    public function store(Request $request)
    {
        $ngay_dat_hang = now();
        $tong_tien = $request->gia;
        $ma_nguoi_dung = auth()->id();
        
        $donHangData = $request->all();
        $donHangData['ngay_dat_hang'] = $ngay_dat_hang;
        $donHangData['tong_tien'] = $tong_tien;
        $donHangData['ma_nguoi_dung'] = $ma_nguoi_dung;
        
        $donHang = DonHang::create($donHangData);
    
        if($donHang){
            $ma_san_pham = $request->ma_san_pham;
            $so_luong = $request->so_luong;
            $thanh_tien = $request->gia;
            $ma_don_hang = $donHang->ma_don_hang; // Lấy id của đơn hàng vừa tạo
            
            $chiTietDonHangData = [
                'ma_don_hang' => $ma_don_hang,
                'ma_san_pham' => $ma_san_pham,
                'so_luong' => $so_luong,
                'thanh_tien' => $thanh_tien
            ];
            
            // Lưu chi tiết đơn hàng vào cơ sở dữ liệu
            ChiTietDonHang::create($chiTietDonHangData);
            // Lấy thông tin sản phẩm tương ứng với ma_san_pham  
            $sanPham = SanPham::find($ma_san_pham);
            if ($sanPham) {
                $so_luong_hien_tai = $sanPham->so_luong;
                if ($so_luong_hien_tai == 1) {
                    // Xoá sản phẩm nếu số lượng là 1
                    $sanPham->delete();
                } else if ($so_luong_hien_tai > 1) {
                    $sanPham->so_luong = $so_luong_hien_tai - 1;
                    $sanPham->save();
                } else {
                    // Xử lý khi số lượng sản phẩm đã hết
                }
            }

        
            // Chuyển hướng đến route xử lý chi tiết đơn hàng
            return redirect()->route('donhang.index')->with('success', 'Sản phẩm đã được thêm thành công.');
        }
    }

    

    public function show($ma_don_hang)
    {
        $donHang = DonHang::where('ma_don_hang', $ma_don_hang)->firstOrFail();
        $chiTietDonHangData = ChiTietDonHang::where('ma_don_hang', $ma_don_hang)->get();
    
        return view('donhang.show', compact('donHang', 'chiTietDonHangData'));
    }
    public function edit($ma_don_hang)
    {
        $donHang = DonHang::findOrFail($ma_don_hang);
        return view('donhang.edit', compact('donHang'));
    }

    public function update(Request $request, $ma_don_hang)
    {
        $donHang = DonHang::findOrFail($ma_don_hang);
        $donHang->update($request->all());
        return redirect()->route('donhang.index');
    }

    public function destroy($ma_don_hang)
    {
        $donHang = DonHang::findOrFail($ma_don_hang);

        // Xóa các chi tiết đơn hàng tương ứng
        $donHang->chiTietDonHang()->delete();

        // Xóa đơn hàng
        $donHang->delete();

        return redirect()->route('donhang.qldonhang')->with('success', 'Đã xóa đơn hàng thành công!');
    }
}