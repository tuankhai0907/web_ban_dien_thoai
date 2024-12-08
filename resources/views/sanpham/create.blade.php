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
        <form action="{{ route('sanpham.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="ten_san_pham">Tên Sản Phẩm:</label>
                <input type="text" id="ten_san_pham" name="ten_san_pham" class="form-control" value="{{ old('ten_san_pham') }}">
            </div>
            <div class="form-group">
                <label for="thuong_hieu">Thương Hiệu:</label>
                <input type="text" id="thuong_hieu" name="thuong_hieu" class="form-control" value="{{ old('thuong_hieu') }}">
            </div>
            <div class="form-group">
                <label for="gia">Giá:</label>
                <input type="text" id="gia" name="gia" class="form-control" value="{{ old('gia') }}">
            </div>
            <div class="form-group">
                <label for="mo_ta">Mô Tả:</label>
                <textarea id="mo_ta" name="mo_ta" class="form-control">{{ old('mo_ta') }}</textarea>
            </div>
            <div class="form-group">
                <label for="duong_dan_hinh_anh">Hình Ảnh:</label>
                <input type="file" id="duong_dan_hinh_anh" name="duong_dan_hinh_anh" class="form-control">
            </div>
            <div class="form-group">
                <label for="chi_tiet_1">Chi Tiết 1:</label>
                <textarea id="chi_tiet_1" name="chi_tiet_1" class="form-control">{{ old('chi_tiet_1') }}</textarea>
            </div>
            <div class="form-group">
                <label for="chi_tiet_2">Chi Tiết 2:</label>
                <textarea id="chi_tiet_2" name="chi_tiet_2" class="form-control">{{ old('chi_tiet_2') }}</textarea>
            </div>
            <div class="form-group">
                <label for="chi_tiet_3">Chi Tiết 3:</label>
                <textarea id="chi_tiet_3" name="chi_tiet_3" class="form-control">{{ old('chi_tiet_3') }}</textarea>
            </div>
            <div class="form-group">
                <label for="chi_tiet_4">Chi Tiết 4:</label>
                <textarea id="chi_tiet_4" name="chi_tiet_4" class="form-control">{{ old('chi_tiet_4') }}</textarea>
            </div>
            <div style="display: flex; justify-content: center; align-items: center; height: 100px;">
                <button type="submit" class="btn btn-primary btn2">Thêm Sản Phẩm</button>
            </div>
        </form>
</main>  
@endsection

