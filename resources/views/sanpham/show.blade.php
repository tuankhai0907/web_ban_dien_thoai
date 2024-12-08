@extends('layouts')

@section('content')

{{-- <link rel="stylesheet" title="text/css" href="{{ asset('css/chitietsanpham.css') }}"> --}}
<div class="container d-flex justify-content-center align-items-center" style="height: 70vh;">
    <div class="show" style="width: 100%; margin-top: 40px;">
        <img src="{{ asset('storage/' . $sanpham->duong_dan_hinh_anh) }}" class="show-img-top" alt="{{ $sanpham->ten_san_pham }}" style="width: 40%; float: left;">
        <div class="show-body" style="margin-left: 500px; margin-top: 10px;">
            <h5 class="show-title" style="font-size: 30px"> Tên Sản Phẩm : {{ $sanpham->ten_san_pham }}</h5>
            <p class="show-text" style="font-size: 18px"> Giá Thành : ${{ number_format($sanpham->gia, 3) }}</p>
            <div class="rating">
                <p> Đánh Giá : 
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
                <i class="far fa-star"></i>
                </p>
            </div>
            <p class="show-text">Mô tả sản phẩm: {{ $sanpham->mo_ta ?: 'Chưa có mô tả.' }}</p>
            <ul class="list-group list-group-flush large-list">
                <li class="list-group-item">{{ $sanpham->chi_tiet_1 }}</li>
                <li class="list-group-item">{{ $sanpham->chi_tiet_2 }}</li>
                <li class="list-group-item">{{ $sanpham->chi_tiet_3 }}</li>
            </ul>
            
            <form action="{{ route('donhang.store') }}" method="POST">
                @csrf
                
                <input type="hidden" name="ma_san_pham" value="{{ $sanpham->ma_san_pham }}">
                <input type="hidden" name="so_luong" value="1" min="1">    
                <input type="hidden" name="gia" value="{{ $sanpham->gia }}">  
        
                @auth
                    <input type="hidden" name="ma_nguoi_dung" value="{{ Auth::id() }}"> <!-- Truyền mã người dùng vào form -->
                    <button type="submit" class="btn btn-danger mt-3 bnt1" >Mua Sản Phẩm</button>  
                @else
                    <p style="color: red; margin-top: 30px;">Vui lòng đăng nhập để mua hàng.</p>
                @endauth
            </form>
        </div>
    </div>
</div>
@endsection