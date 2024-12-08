@extends('layouts')

@section('content')



@if ($cartItems->isEmpty())
    <p>Giỏ hàng của bạn trống rỗng.</p>
@else
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Giỏ hàng</h2>
                <table class="table">
                <thead>
                    <tr>
                    <th>STT</th>
                    <th>Tên Sản Phẩm</th>
                    <th>Hình Ảnh</th>
                    <th>Giá</th>
                    <th>Số Lượng</th>
                    <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cartItems as $cartItem)
                    <tr>
                            <td></td>

                            <td>
                                <a href="{{ route('sanpham.show', ['ma_san_pham' => $cartItem->SanPham->ma_san_pham ]) }}">
                                    {{ $cartItem->SanPham->ten_san_pham }}
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('sanpham.show', ['ma_san_pham' => $cartItem->SanPham->ma_san_pham ]) }}">
                                     <img src="{{ asset('storage/' . $cartItem->sanpham->duong_dan_hinh_anh) }}" class="card-img-top mt-2" alt="{{ $cartItem->sanpham->ten_san_pham }}" style="width: 60px; height: auto; margin-top: 5px;">
                                </a>
                            </td>
                            <td>{{ number_format($cartItem->SanPham->gia, 0, ',', '.') }} VND</td>
                            
                            <td>{{ $cartItem->quantity }}</td>
                           
                            <td><form action="{{ route('cart.remove', $cartItem->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Xoá</button>
                            </form></td>
                        </tr>
                    @endforeach
                </tr>
                </tbody>
                </table>
            </div>
        </div>
    </div>
<div class="pxp">
    <p>Tổng số lượng: {{ $totalQuantity }}</p>
    <p>Tổng giá trị: {{ number_format($totalPrice, 0, ',', '.') }} VND</p>
    <a href="#">Thanh toán</a>
</div>
@endif
@endsection