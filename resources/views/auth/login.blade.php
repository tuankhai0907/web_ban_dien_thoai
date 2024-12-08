@extends('layouts')

@section('content')

<div class="container">

    <div class="from-login">
        <div class="logo">
        <h1>Đăng Nhập</h1>
        </div>
          
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <input type="email" name="email" id="email" placeholder="Email"  required>
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
    
            <div class="form-group">
           
                <div class="input-container">
                    <input type="password" name="password" id="password"placeholder="Password"  required>
                    <button type="button" id="password-toggle"><i class="fas fa-eye"></i></button>
                </div>
                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn1 btn-primary mx-auto">Login</button>

            <p>Bạn chưa có tài khoản?   
                <a class="nav-link" href="{{ route('register') }}">  
                    Đăng kí tài khoản  
                </a>  
            </p>
            

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