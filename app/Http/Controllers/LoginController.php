<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
    
        if (Auth::attempt($credentials)) {
            if (Auth::user()->role == 'admin') {
                return redirect()->route('sanpham.qlsanpham');
            } else {
                return redirect()->intended('home');
            }
        }
    
        return redirect()->route('login')->with('error', 'Email hoặc mật khẩu không chính xác. Vui lòng kiểm tra lại.');
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
    public function check(){
        $user = User::all();

        return dd($user);
    }

    public function qltaikhoan() {
        $users = User::all(); // Lấy tất cả người dùng từ bảng users

        return view('auth.qltaikhoan', compact('users')); // Trả về view và truyền danh sách người dùng
    }
    public function deleteAccount($id)
    {
        $user = User::find($id);

        if ($user) {
            $user->delete();
            return redirect()->route('qltaikhoan')->with('success', 'Tài khoản đã được xóa thành công.');
        }

        return redirect()->route('qltaikhoan')->with('error', 'Không tìm thấy tài khoản.');
    }
}