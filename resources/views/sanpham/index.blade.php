@extends('layouts')

@section('content')

{{-- <div class="container-fluid">
    <div id="bannerCarousel" class="carousel slide mt-4" data-ride="carousel">
       <div class="carousel-inner">
         <div class="carousel-item active">
          <img src="{{ asset('storage/images/baner1.png') }}" class="d-block w-100" alt="Hình ảnh 2">
         </div>
         <div class="carousel-item">
          <img src="{{ asset('storage/images/baner2.png') }}" class="d-block w-100" alt="Hình ảnh 2">
         </div>      
     </div> 
    </div>
</div> --}}
<!-- Nút chuyển hướng đến trang donhang.index -->

<form id="filterForm" method="GET">  
    @csrf 
    <div class="filter-container">  
        <div class="form-group1">
            <input type="text" name="gia" id="gia" placeholder="Nhập giá">
        </div>
        <div class="form-group1">  
            <select name="thuong_hieu" id="thuong_hieu">  
                <option value="">Hãng</option>  
                <option value="Apple">Apple</option>
                <option value="SamSung">SamSung</option>
                <option value="Oppo">Oppo</option>
            </select>  
        </div>  
        <button type="submit" class="btn-icon">
            <i class="fas fa-search"></i>
        </button>
    </div>  
</form>



<div class="container mt-4">
    <div class="row">
        @foreach($sanPhams as $sanpham)
            <div class="col-md-3 mb-4 d-flex">
                <div class="card">
                    <a href="{{ route('sanpham.show', ['ma_san_pham' => $sanpham->ma_san_pham]) }}">
                        <img src="{{ asset('storage/' . $sanpham->duong_dan_hinh_anh) }}" class="card-img-top mt-2" alt="{{ $sanpham->ten_san_pham }}">
                    </a>
                    <div class="card-body">
                        <h5 class="card-title">{{ $sanpham->ten_san_pham }}</h5>
                        <p class="card-text"> {{ number_format($sanpham->gia, 0, ',', '.') }} VND</p>
                        <div class="rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                            <i class="far fa-star"></i>
                        </div>
                        <p class="card-text1">Mô tả sản phẩm: {{ $sanpham->mo_ta ?: 'Chưa có mô tả.' }}</p>
{{--                                 
                        <a href="{{ route('sanpham.show', ['ma_san_pham' => $sanpham->ma_san_pham]) }}" class="btn btn-primary btn-sm">Thêm vào giỏ hàng</a>
                    
                        <a href="{{ route('muahang', ['ma_san_pham' => $sanpham->ma_san_pham]) }}" class="btn btn-danger btn-sm" style="background-color: red !important;">Mua hàng</a>
                        
                    </div> --}}
                    <form action="{{ route('cart.add') }}" method="POST">  
                        @csrf  
                        <input type="hidden" name="san_pham_id" value="{{ $sanpham->ma_san_pham }}">  
                        <input type="hidden" name="user_id" value="{{ Auth::id() }}">  
                        <input type="hidden" name="quantity" value="1" min="1">  
                        <button type="submit" class="btn btn-primary btn-sm">Thêm vào giỏ hàng</button>  
                    </form>  
                </div>
                </div>
            </div>
        @endforeach
    </div>
</div>


    <div class="row">
        <div class="col-md-12">
            <ul class="pagination">
                {{ $sanPhams->links() }}
            </ul>
        </div>
    </div>
</div>

@endsection
