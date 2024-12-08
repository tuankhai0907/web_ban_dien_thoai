<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\SanPham;

class CartController extends Controller
{
    public function index()
    {
        // Lấy thông tin giỏ hàng từ cơ sở dữ liệu
        $cartItems = Cart::with('sanPham')->where('user_id', auth()->id())->get();

        // Tính tổng số lượng và tổng giá trị của giỏ hàng
        $totalQuantity = $cartItems->sum('quantity');
        $totalPrice = $cartItems->sum(function ($item) {
            return $item->quantity * $item->sanPham->gia;
        });

        // Trả về view hiển thị thông tin giỏ hàng
        return view('cart.index', compact('cartItems', 'totalQuantity', 'totalPrice'));
    }

        
    public function addToCart(Request $request)
    {
        $user_id = auth()->id();
        $san_pham_id = $request->san_pham_id;
        $quantity = $request->quantity;
    
        $cartItem = Cart::where('user_id', $user_id)
            ->where('san_pham_id', $san_pham_id)
            ->first();
    
        if ($cartItem) {
            // Nếu sản phẩm đã tồn tại trong giỏ hàng, cập nhật số lượng
            $cartItem->update([
                'quantity' => $cartItem->quantity + $quantity
            ]);
            $message = 'Đã cập nhật số lượng sản phẩm trong giỏ hàng.';
        } else {
            // Nếu sản phẩm chưa có trong giỏ hàng, tạo mới
            Cart::create([
                'user_id' => $user_id,
                'san_pham_id' => $san_pham_id,
                'quantity' => $quantity
            ]);
            $message = 'Đã thêm sản phẩm vào giỏ hàng.';
        }
    
        // Gửi thông báo sử dụng session
        session()->flash('success', $message);
    
        return redirect()->route('home.index');
    }
     public function removeFromCart($id)
     {
         $cartItem = Cart::find($id);
     
         if (!$cartItem) {
             return redirect()->back()->with('error', 'Sản phẩm không tồn tại trong giỏ hàng');
         }
     
         if ($cartItem->quantity > 1) {
             // Giảm số lượng sản phẩm đi 1 nếu số lượng lớn hơn 1
             $cartItem->update([
                 'quantity' => $cartItem->quantity - 1
             ]);
         } else {
             // Xoá sản phẩm nếu số lượng bằng 1
             $cartItem->delete();
         }
     
         return redirect()->route('cart.index')->with('success', 'Sản phẩm đã được xử lý khỏi giỏ hàng');
     }
}
