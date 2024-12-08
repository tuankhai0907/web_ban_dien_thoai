<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }
     public function showRegistrationForm1()
    {
        return view('auth.dangki');
    }
    
    public function register(Request $request)
    {
        // Validate form data
        $validatedData = $request->validate([
            'ten_nguoi_dung' => 'required|string|max:255',
            'password' => 'required|string|min:2',
            'email' => 'required|string|email|max:255|unique:users,email',
            'dia_chi' => 'required|string|max:255',
            'so_dien_thoai' => 'required|string|max:20',
            'role' => 'required|string|max:255',

        ]);

        try {
            $user = User::create([
                'ten_nguoi_dung' => $validatedData['ten_nguoi_dung'],
                'password' => Hash::make($validatedData['password']),
                'email' => $validatedData['email'],
                'dia_chi' => $validatedData['dia_chi'],
                'so_dien_thoai' => $validatedData['so_dien_thoai'],
                'role' => $validatedData['role'],
                
            ]);

            Auth::login($user);

            return redirect('/login')->with('success', 'Đăng ký thành công. Đăng nhập để tiếp tục.');
        } catch (\Exception $e) {
            return response()->json(['message' => 'Đã xảy ra lỗi khi đăng ký'], 500);
        }
    }

    public function register1(Request $request)
    {
        // Validate form data
        $validatedData = $request->validate([
            'ten_nguoi_dung' => 'required|string|max:255',
            'password' => 'required|string|min:2',
            'email' => 'required|string|email|max:255|unique:users,email',
            'dia_chi' => 'required|string|max:255',
            'so_dien_thoai' => 'required|string|max:20',
            'role' => 'required|string|max:255',

        ]);

         {
            $user = User::create([
                'ten_nguoi_dung' => $validatedData['ten_nguoi_dung'],
                'password' => Hash::make($validatedData['password']),
                'email' => $validatedData['email'],
                'dia_chi' => $validatedData['dia_chi'],
                'so_dien_thoai' => $validatedData['so_dien_thoai'],
                'role' => $validatedData['role'],
                
            ]);


            return redirect()->route('qltaikhoan')->with('success', 'Tài khoản đã được tạo thành công.');
        }
    }
}