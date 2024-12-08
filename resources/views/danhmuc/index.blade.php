<!DOCTYPE html>  
<html>  
<head>  
    <title>Thêm Danh Mục</title>  
</head>  
<body>  
    <h1>Thêm Danh Mục</h1>  

    @if ($errors->any())  
        <div>  
            <ul>  
                @foreach ($errors->all() as $error)  
                    <li>{{ $error }}</li>  
                @endforeach  
            </ul>  
        </div>  
    @endif  

    <form action="{{ route('danhmuc.store') }}" method="POST">  
        @csrf  
        <label for="ma_danh_muc">Mã Danh Mục:</label>  
        <input type="text" name="ma_danh_muc" id="ma_danh_muc" required>  
        <br>  

        <label for="ten_danh_muc">Tên Danh Mục:</label>  
        <input type="text" name="ten_danh_muc" id="ten_danh_muc" required>  
        <br>  

        <button type="submit">Thêm</button>  
    </form>  
</body>  
</html>