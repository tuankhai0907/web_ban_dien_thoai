@extends('admin')  

@section('content')  
<main class="content px-3 py-2">  
    <div class="container-fluid">  
        <div class="mb-6">  
            <h3>Quản lý điện thoại</h3>  
        </div> 
    <div class="top-container">
        <a href="{{ route('sanpham.create') }}" class="btn btn-primary mb-3 btn2">Thêm Sản Phẩm</a>  
        <div class="search-bar mb-3">  
            <form class="form-inline mx-auto my-2" action="{{ route('sanpham.qlsanpham') }}" method="GET" class="mb-4">
                @csrf <!-- Thêm CSRF token cho form POST -->
                <input class="mr-sm-2 custom-input" name="search" type="search" placeholder="Tìm kiếm" aria-label="Search">
                <button class="btn btn-primary my-2 my-sm-0 ls" type="submit">
                    <i class="fas fa-search"></i> <!-- Icon tìm kiếm từ Font Awesome -->
                </button>
            </form>  
        </div> 
    </div> 
       
        <div class="box-container">
            <div class="box">      
                <h4>Số sản phẩm </h4>
                <p> {{ $recordCount }}</p>
            </div>
            <div class="box">      
                <h4> Iphone </h4>
                <p>{{ $countApple }}</p>
            </div>
            <div class="box">      
                <h4>Oppo</h4>
                <p> {{ $countOppo }}</p>
            </div>
        </div>
        @if (session('success'))  
            <div class="alert alert-success">  
                {{ session('success') }}  
            </div>  
        @endif  

        <table class="table table-striped table-bordered">  
            <thead>  
                <tr>  
                    <th>#</th>  
                    <th>Tên Sản Phẩm</th>  
                    <th>Thương Hiệu</th>  
                    <th>Giá</th>  
                    <th>Hình Ảnh</th>  
                    <th>Số lượng</th>
                    <th>Hành Động</th>  
                </tr>  
            </thead>  
            <tbody>  
                @foreach ($sanPhams as $sanPham)  
                    <tr>  
                        <td>{{ $sanPham->ma_san_pham }}</td>  
                        <td>{{ $sanPham->ten_san_pham }}</td>  
                        <td>{{ $sanPham->thuong_hieu }}</td>  
                        <td>{{ number_format($sanPham->gia, 0, '.', '.') }} đ</td>  
                        <td>  
                            @if ($sanPham->duong_dan_hinh_anh)  
                                <img src="{{ asset('storage/' . $sanPham->duong_dan_hinh_anh) }}" alt="Hình Ảnh" width="100">  
                            @else  
                                Không có hình ảnh  
                            @endif  
                        </td>  
                        <td>{{ $sanPham->so_luong}}</td>
                        <td>  
                            <a href="{{ route('sanpham.edit', $sanPham->ma_san_pham) }}" class="btn btn-secondary btn-sm">Chỉnh sửa</a> 
                            <form action="{{ route('sanpham.destroy', $sanPham->ma_san_pham) }}" method="POST" class="d-inline">  
                                @csrf  
                                @method('DELETE')  
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xoá?')">Xoá</button>  
                            </form>  
                        </td>  
                    </tr>  
                @endforeach  
            </tbody>  
        </table>  
        <div class="row">
            <div class="col-md-12">
                <ul class="pagination">
                    {{ $sanPhams->links() }}
                </ul>
            </div>
        </div>
        
    </div>  
</main>  
@endsection