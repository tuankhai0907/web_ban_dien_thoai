@extends('admin')  

@section('content')  

    <div class="container mt-4">
        <h1>Thêm Sản Phẩm</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

<form method="POST" action="{{ route('sanpham.update', $sanpham->ma_san_pham) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="ten_san_pham">Tên Sản Phẩm:</label>
        <input type="text" id="ten_san_pham" name="ten_san_pham" class="form-control" value="{{ $sanpham->ten_san_pham }}">
    </div>
    <div class="form-group">
        <label for="thuong_hieu">Thương Hiệu:</label>
        <input type="text" id="thuong_hieu" name="thuong_hieu" class="form-control" value="{{ $sanpham->thuong_hieu }}">
    </div>
    <div class="form-group">
        <label for="gia">Giá:</label>
        <input type="text" id="gia" name="gia" class="form-control" value="{{ $sanpham->gia }}">
    </div>
    <div class="form-group">
        <label for="mo_ta">Mô Tả:</label>
        <textarea id="mo_ta" name="mo_ta" class="form-control">{{ $sanpham->mo_ta }}</textarea>
    </div>
     <!-- Hiển thị hình ảnh sản phẩm cũ -->
     @if ($sanpham->duong_dan_hinh_anh)
     <img src="{{ asset('storage/' . $sanpham->duong_dan_hinh_anh) }}" alt="Hình ảnh sản phẩm" style="max-width: 100px; max-height: 100px;">
     @endif

    <div class="form-group">
        <label for="duong_dan_hinh_anh">Hình Ảnh:</label>
        <input type="file" id="duong_dan_hinh_anh" name="duong_dan_hinh_anh" class="form-control">
    </div>
    <div class="form-group">
        <label for="chi_tiet_1">Mô Tả:</label>
        <textarea id="chi_tiet_1" name="chi_tiet_1" class="form-control">{{ $sanpham->chi_tiet_1 }}</textarea>
    </div>
    <div class="form-group">
        <label for="chi_tiet_2">Mô Tả:</label>
        <textarea id="chi_tiet_2" name="chi_tiet_2" class="form-control">{{ $sanpham->chi_tiet_2 }}</textarea>
    </div>
    <div class="form-group">
        <label for="chi_tiet_3">Mô Tả:</label>
        <textarea id="chi_tiet_3" name="chi_tiet_3" class="form-control">{{ $sanpham->chi_tiet_3 }}</textarea>
    </div>
    <div class="form-group">
        <label for="chi_tiet_4">Mô Tả:</label>
        <textarea id="chi_tiet_4" name="chi_tiet_4" class="form-control">{{ $sanpham->chi_tiet_4 }}</textarea>
    </div>
    <div class="form-group">
        <label for="so_luong">Số lượng</label>
        <input type="text" id="so_luong" name="so_luong" class="form-control" value="{{ $sanpham->so_luong }}">
    </div>
    <div style="display: flex; justify-content: center; align-items: center; height: 100px;">
        <button type="submit" class="btn btn-primary">Cập Nhật Sản Phẩm</button>
    </div>
</form>

@endsection