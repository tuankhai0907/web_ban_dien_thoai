<?php  

use Illuminate\Support\Facades\Route;  
use App\Http\Controllers\SanPhamController;  
use App\Http\Controllers\DanhMucController;  
use App\Http\Controllers\RegisterController;  
use App\Http\Controllers\LoginController;  
use App\Http\Controllers\CartController;  
use App\Http\Controllers\HomeController;  
use App\Http\Controllers\DonHangController;  

// Home Routes  
Route::get('home', [HomeController::class, 'index'])->name('home.index');  

// Authentication Routes  
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::get('dangki', [RegisterController::class, 'showRegistrationForm1'])->name('dangki');   
Route::post('/register', [RegisterController::class, 'register']);  
Route::post('/register1', [RegisterController::class, 'register1'])->name('register1');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');  
Route::post('/login', [LoginController::class, 'login']);  
Route::post('/logout', [LoginController::class, 'logout'])->name('logout'); 
Route::delete('/user/{id}', [LoginController::class, 'deleteAccount'])->name('user.delete'); 
Route::get('/auth/qltaikhoan', [LoginController::class, 'qltaikhoan'])->name('qltaikhoan')->middleware('admin');  
// Product Routes  
Route::prefix('sanpham')->group(function () {  
    Route::get('/', [SanPhamController::class, 'index'])->name('sanpham.index');  
    Route::get('/create', [SanPhamController::class, 'create'])->name('sanpham.create')->middleware('admin');  
    Route::post('/', [SanPhamController::class, 'store'])->name('sanpham.store');  
    Route::get('/qlsanpham', [SanPhamController::class, 'qlsanpham'])->name('sanpham.qlsanpham')->middleware('admin');  
    Route::delete('/{sanpham}', [SanPhamController::class, 'destroy'])->name('sanpham.destroy');  
    Route::get('/{ma_san_pham}', [SanPhamController::class, 'show'])->name('sanpham.show');  
    Route::get('/{sanpham}/edit', [SanPhamController::class, 'edit'])->name('sanpham.edit')->middleware('admin');  
    Route::put('/{sanpham}', [SanPhamController::class, 'update'])->name('sanpham.update');  
    Route::get('/muahang/{ma_san_pham}', [SanPhamController::class, 'muahang'])->name('muahang');  
});  

// Category Routes  
Route::prefix('danhmuc')->group(function () {  
    Route::get('/create', [DanhMucController::class, 'create'])->name('danmuc.create');  
    Route::post('/', [DanhMucController::class, 'store'])->name('danhmuc.store');  
});  

// Cart Routes  
Route::prefix('cart')->group(function () {  
    Route::get('/', [CartController::class, 'index'])->name('cart.index');  
    Route::post('/add', [CartController::class, 'addToCart'])->name('cart.add')->middleware('logincheck');
    Route::patch('/update/{id}', [CartController::class, 'updateCart'])->name('cart.update');  
    Route::delete('/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');  
});  

// Order Routes  
Route::prefix('donhang')->group(function () {  
    Route::get('/', [DonHangController::class, 'index'])->name('donhang.index')->middleware('logincheck');  
    Route::post('/', [DonHangController::class, 'store'])->name('donhang.store');  
    Route::get('/qldonhang', [DonHangController::class, 'qldonhang'])->name('donhang.qldonhang')->middleware('admin');  
    Route::get('/{ma_don_hang}', [DonHangController::class, 'show'])->name('donhang.show');  
    Route::delete('/{ma_don_hang}', [DonHangController::class, 'destroy'])->name('donhang.destroy');  
});  

// Admin Routes  
Route::middleware(['admin'])->group(function () {  
    Route::get('admin', function () {  
        // Admin dashboard or management  
    });  
});