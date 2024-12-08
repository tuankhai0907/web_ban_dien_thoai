<!-- resources/views/donhang/show.blade.php -->
@extends('admin')

@section('content')
<div class="container">
    <h1>Thông tin đơn hàng</h1>
    <p>Tên người dùng: {{ $donHang->user->ten_nguoi_dung }}</p>
    <p>Số điện thoại: {{$donHang->user->so_dien_thoai}} </p>
    <p>Email: {{$donHang->user->email}} </p>
    <p>Địa chỉ: {{$donHang->user->dia_chi}} </p>
    <p>Mã đơn hàng: {{ $donHang->ma_don_hang }}</p>
    <p>Ngày đặt hàng: {{ \Carbon\Carbon::parse($donHang->ngay_dat_hang)->format('d/m/Y') }}</p>
    <p>Tổng tiền: {{ number_format($donHang->tong_tien , 0, ',', '.') }} VND</p>
    
    <h2>Chi tiết đơn hàng</h2>
    
    <table class="table table-striped table-bordered"> 
        <thead>
            <tr>
                <th>Mã sản phẩm</th>
                <th>Tên sản phẩm</th>
                <th>hình ảnh</th>
                <th>Số lượng</th>
                <th>Thành tiền</th>

            </tr>
        </thead>
        <tbody>
            @foreach($chiTietDonHangData as $chiTiet)
                <tr>
                    <td>{{ $chiTiet->ma_san_pham }}</td>
                    <td>{{ $chiTiet->sanPham->ten_san_pham }}</td>
                    <td>   <img src="{{ asset('storage/' . $chiTiet->sanpham->duong_dan_hinh_anh) }}" class="card-img-top mt-2" alt="{{ $chiTiet->sanpham->ten_san_pham }}" style="width: 60px; height: auto; margin-top: 5px;"></td>
                    <td>{{ $chiTiet->so_luong }}</td>

                    <td>{{ number_format($chiTiet->thanh_tien , 0, ',', '.') }} VND</td>
                    
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection