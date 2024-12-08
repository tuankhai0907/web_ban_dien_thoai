@extends('layouts')

@section('content')
<div class="container">
 <div class="from-login">
    <h1>Đăng ký </h1>

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="form-group">
            <label for="ten_nguoi_dung">Tên người dùng:</label>
            <input type="text" name="ten_nguoi_dung" required>
        </div>
        <div class="form-group">
            <label for="password">Mật khẩu:</label>
            <div class="input-container">
                <input type="password" name="password" id="password"placeholder="Password"  required>
                <button type="button" id="password-toggle"><i class="fas fa-eye"></i></button>
            </div>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="dia_chi">Địa chỉ:</label>
            <input type="text" name="dia_chi" required>
        </div>
        <div class="form-group">
            <label for="so_dien_thoai">Số điện thoại:</label>
            <input type="text" name="so_dien_thoai" required>
        </div>
        <div class="form-group">
           
            <input type="hidden" name="role" value="user">
        </div>
        <button type="submit" class="btn1 btn-primary mx-auto">Đăng ký</button>
    </form>

</form>
</div>
</div>
<script>
document.getElementById('password-toggle').addEventListener('click', function() {
    var passwordInput = document.getElementById('password');
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        this.innerHTML = '<i class="fas fa-eye-slash"></i>';
    } else {
        passwordInput.type = 'password';
        this.innerHTML = '<i class="fas fa-eye"></i>';
    }
});
</script>

@endsection