<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title')</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" title="text/css" href="{{ asset('css/styles.css') }}">
<link rel="stylesheet" title="text/css" href="{{ asset('css/login.css') }}">
<link rel="stylesheet" title="text/css" href="{{ asset('css/giohang.css') }}">

</head>
<body>

    <nav class="navbar navbar-expand-lg">
        <a class="navbar-brand logo-text" href="#">SHOP BÁN ĐIỆN THOẠI</a>
        
        <form class="form-inline mx-auto my-2" action="{{ route('sanpham.index') }}" method="GET" class="mb-4">
            @csrf <!-- Thêm CSRF token cho form POST -->
            <input class="mr-sm-2 custom-input" name="search" type="search" placeholder="Tìm kiếm" aria-label="Search">
            <button class="btn btn-primary my-2 my-sm-0 ls" type="submit">Tìm kiếm</button>
        </form>

        <li class="login-item">
            @guest
                <a class="nav-link" href="{{ route('login') }}">
                    <i class="fa fa-user"></i> Đăng nhập
                </a>
            @else
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="custom-button">
                    <i class="fas fa-sign-out-alt"></i> Đăng xuất
                </button>
            </form>
               
            @endguest
        </li>
      

        @auth
        <a href="{{ route('cart.index') }}" class="btn btn-primary fixed-cart-button"><i class="fas fa-shopping-cart"></i> Giỏ hàng</a>
    @endauth
    </nav> 
  
    <nav class="navbar navbar-expand-lg flex-column-menu">
        <div class="dropdown">
            <a class="navbar-brand dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-list"></i> Danh mục sản phẩm
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <a class="dropdown-item" href="#"><i class="fas fa-mobile-alt"></i> Điện thoại</a>
                <a class="dropdown-item" href="#"><i class="fas fa-laptop"></i> Laptop</a>
                <a class="dropdown-item" href="#"><i class="fas fa-headphones"></i> Tai nghe</a>
                <a class="dropdown-item" href="#"><i class="fas fa-charging-station"></i> Sạc</a>
                <a class="dropdown-item" href="#"><i class="fas fa-mobile"></i> Phụ kiện</a>
              </div>
          </div>
    
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home.index') }}"><i class="fas fa-home"></i> Trang chủ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fas fa-info-circle"></i> Giới thiệu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('sanpham.index')}}"><i class="fas fa-mobile-alt"></i> Sản Phẩm</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://www.thegioididong.com/tin-tuc"><i class="fas fa-newspaper"></i> Tin tức</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('donhang.index') }}"><i class="fas fa-shopping-cart"></i> Đơn hàng</a>
                </li>
            </ul>
        </div>
    </nav>
    
   
        @yield('content')



      
    <footer class=" py-5">
       
            <div class="row">
                <div class="col-md-4">
                    <h5>Thông tin liên hệ</h5>
                    <p><i class="fas fa-map-marker-alt"></i> Địa chỉ: 123 ABC Street, XYZ City</p>
                    <p><i class="fas fa-envelope"></i> Email: contact@example.com</p>
                    <p><i class="fas fa-phone"></i> Điện thoại: 0345093952</p>
                </div>
                <div class="col-md-4">
                    <h5>Liên kết nhanh</h5>
                    <ul>
                        <li><a href="#">Trang chủ</a></li>
                        <li><a href="#">Dịch vụ</a></li>
                        <li><a href="#">Sản phẩm</a></li>
                        <li><a href="#">Liên hệ</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Theo dõi chúng tôi</h5>
                    <a href="https://www.facebook.com/profile.php?id=100035487368228&mibextid=JRoKGi"><i class="fab fa-facebook-square"></i></a>
                    <a href="#"><i class="fab fa-twitter-square"></i></a>
                    <a href="#"><i class="fab fa-instagram-square"></i></a>
                </div>
            </div>
        
    </footer>
    
    <script>
        var toastElList = [].slice.call(document.querySelectorAll('.toast'))
        var toastList = toastElList.map(function (toastEl) {
            return new bootstrap.Toast(toastEl)
        })
    </script>
    <script>
        $(document).ready(function(){
          $('.dropdown-toggle').dropdown();
        });
      </script>
      <script>
        $(document).ready(function() {
          $('#bannerCarousel').carousel({
            interval: 1000 // Đặt interval để chuyển slide sau mỗi 3 giây
          });
        });
      </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>
    </html>