@extends('admin')  

@section('content')  
<main class="content px-3 py-2">  
    <div class="container-fluid">  
        <div class="mb-6">  
            <h3>Quản lý đơn hàng</h3>  
        </div>  
        <div class="search-bar mb-3">  
            <form class="form-inline mx-auto my-2" action="{{ route('donhang.qldonhang') }}" method="GET" class="mb-4">
                @csrf <!-- Thêm CSRF token cho form GET -->
                <input class="mr-sm-2 custom-input" name="ngay_dat_hang" id="ngay_dat_hang" type="date" placeholder="Ngày đặt hàng" aria-label="Ngày đặt hàng">
                <input class="mr-sm-2 custom-input" name="ma_nguoi_dung"  id="ma_nguoi_dun" type="text" placeholder="Mã người dùng" aria-label="Mã người dùng">
                <button class="btn btn-primary my-2 my-sm-0 ls" type="submit">
                    <i class="fas fa-search"></i> <!-- Icon tìm kiếm từ Font Awesome -->
                </button>
            </form>  
        </div>

        @if (session('success'))  
            <div class="alert alert-success">  
                {{ session('success') }}  
            </div>  
        @endif  

        <div class="box">
                <p>Số hoá đơn: {{ $recordCount }}</p>  
        </div>

        {{-- <a href="{{ route('sanpham.create') }}" class="btn btn-primary mb-3 btn1">Thêm Sản Phẩm</a>   --}}

        <table class="table table-striped table-bordered">  
            <thead>  
                <tr>  
                    
                    <th>Mã Đơn Hàng</th>  
                    <th>Tên Khách Hàng</th>
                    <th>Ngày Đặt Hàng</th>
                    <th>Tổng tiền</th>  
                 
                </tr>  
            </thead>  
            <tbody>  
                @foreach($donHangs as $donhang)
                <tr>  
                    <td>{{ $donhang->ma_don_hang }}</td>  
                    <td>{{ $donhang->user->ten_nguoi_dung }}</td>
                    <td>{{ \Carbon\Carbon::parse($donhang->ngay_dat_hang)->format('d/m/Y') }}</td>
                    <td>{{ number_format($donhang->tong_tien, 0, '.', '.') }} đ</td>
                    <td>  
                        <a href="{{ route('donhang.show', ['ma_don_hang' => $donhang->ma_don_hang]) }}" class="btn btn-secondary btn-sm">Xem chi tiết</a>  
                        <form action="{{ route('donhang.destroy', ['ma_don_hang' => $donhang->ma_don_hang]) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xoá?')">Xoá</button>
                        </form> 
                    </td> 
                </tr>  
            @endforeach
            </tbody>  
        </table>  
        {{-- <div class="row">
            <div class="col-md-12">
                <ul class="pagination">
                    {{ $sanPhams->links() }}
                </ul>
            </div>
        </div>
         --}}
    </div>  
</main>  
@endsection