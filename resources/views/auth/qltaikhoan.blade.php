@extends('admin')  

@section('content')  
<main class="content px-3 py-2">  
    <div class="container-fluid">  
        @if (session('success'))  
        <div class="alert alert-success">  
            {{ session('success') }}  
        </div>  
    @endif  
        <div class="mb-6">  
            <h3>Quản lý tài khản</h3>  
        </div>  
        <a class="btn btn-primary btn2" href="{{ route('dangki') }}">Thêm TK quản lý</a>
        <table class="table table-striped table-bordered">  
            <thead>  
                <tr>  
                    
                    <th>Mã Tài Khoản</th>  
                    <th>Tên Người Dùng</th>
                    <th>Gmail</th>
                    <th>Số ĐT</th>  
                    <th>Địa chỉ</th>
                 
                </tr>  
            </thead>  
            <tbody>  
                @foreach($users as $user)
                <tr>  
                    <td>{{ $user->ma_nguoi_dung }}</td>  
                    <td>{{ $user->ten_nguoi_dung }}</td>
                    <td>{{ $user->email}}</td>  
                    <td>{{ $user->so_dien_thoai}}</td>
                    <td>{{ $user->dia_chi}}</td>
                    <td>
                    <form action="{{ route('user.delete', $user->ma_nguoi_dung) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa tài khoản này?')">Xóa</button>
                    </form>
                    </td>
                </tr>  
            @endforeach
         </tbody>  
        </table>  
    </div>  
</main>  
@endsection