@extends('layouts')

@section('content') 

<div class="container">
    <h1>Thông tin đơn hàng</h1>
    
    <h3>Danh sách đơn hàng của {{ $user->ten_nguoi_dung }}</h3>
    @foreach($donHangList as $donHang)
        <p>Mã đơn hàng: {{ $donHang->ma_don_hang }}</p>
        <p>Ngày đặt hàng: {{ \Carbon\Carbon::parse($donHang->ngay_dat_hang)->format('d/m/Y') }}</p>
        
        <h2>Chi tiết đơn hàng:</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Mã sản phẩm</th>
                    <th>Hình ảnh</th>
                    <td>Tên sản Phẩm</td>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                </tr>
            </thead>
            <tbody>
                @foreach($donHang->chiTietDonHang as $chiTietDonHang)
                    <tr>
                        <td>{{ $chiTietDonHang->ma_san_pham }}</td>
                        <td><img src="{{ asset('storage/' .  $chiTietDonHang->sanpham->duong_dan_hinh_anh) }}" class="card-img-top mt-2" alt="{{  $chiTietDonHang->sanpham->ten_san_pham }}" style="width: 60px; height: auto; margin-top: 5px;"></td>
                        <td>{{$chiTietDonHang->SanPham->ten_san_pham}}</td>
                        <td>{{ $chiTietDonHang->so_luong }}</td>
                        <td>{{ number_format($chiTietDonHang->thanh_tien, 0, ',', '.') }} VND</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <form action="{{ route('donhang.destroy', ['ma_don_hang' => $donHang->ma_don_hang]) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn huỷ đơn?')">Huỷ đơn</button>
        </form> 
    @endforeach
</div>

@endsection 