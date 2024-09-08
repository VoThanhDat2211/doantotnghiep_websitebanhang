@extends('user/layouts/layout')
@section('content')
    <script src="https://esgoo.net/scripts/jquery.js"></script>
    <link href="{{ asset('frontend/css/pay.css') }}" rel="stylesheet" />
    <style>
        .error {
            display: inline-block;
            margin-top: 6px;
            color: red;
        }
    </style>
    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li class="active">Check out</li>
                </ol>
            </div><!--/breadcrums-->



            <div class="review-payment">
                <h2 style="font-weight: 700">SẢN PHẨM</h2>
            </div>

            <div class="table-responsive cart_info">
                <table class="table table-condensed">
                    <thead>
                        <tr class="cart_menu">
                            <td class="image">HÌNH ẢNH</td>
                            <td class="description">TÊN SẢN PHẨM</td>
                            <td class="price">GIÁ (VND)</td>
                            <td class="quantity">SỐ LƯỢNG</td>
                            <td class="total">TỔNG TIỀN (VND)</td>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($carts))
                            @foreach ($carts as $cart)
                                <tr>
                                    <td class="cart_product">
                                        <a href=""><img style="width: 80px; height: 80px;"
                                                src="{{ asset('/image/' . $cart->productVariant->image_path) }}"
                                                alt=""></a>
                                    </td>
                                    <td class="cart_description">
                                        <h4><a href="">{{ $cart->productVariant->product->name }}</a></h4>
                                        <p>{{ $cart->productVariant->color . ', ' . renderSize($cart->productVariant->size) }}
                                        </p>
                                    </td>
                                    <td class="cart_price">
                                        <p>{{ priceFormat(priceDiscount($cart->productVariant->product->price, $cart->productVariant->product->discount)) }}đ
                                        </p>
                                    </td>
                                    <td class="cart_quantity">
                                        <div class="cart_quantity_button">
                                            {{ $cart->quantity }}
                                        </div>
                                    </td>
                                    <td class="cart_total">
                                        <p class="cart_total_price">
                                            {{ priceFormat(priceDiscount($cart->productVariant->product->price, $cart->productVariant->product->discount) * $cart->quantity) }}
                                        </p>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>

            <form action="{{ route('create-pay', ['type' => 1]) }}" method="POST">
                @csrf
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Họ và tên</label>
                        <input type="text" class="form-control" id="inputEmail4" name="customer_name"
                            value="{{ old('customer_name') }}" placeholder="Họ và tên" required>
                        @error('customer_name')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Số điện thoại</label>
                        <input type="text" class="form-control" id="inputPassword4" name="customer_phone"
                            value="{{ old('customer_phone') }}" placeholder="Số điện thoại" required>
                        @error('customer_phone')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <label for="inputPassword4">Địa chỉ nhận hàng</label>
                <div class="row">
                    <div class="form-group col-md-4">
                        <select class="css_select" id="province" name="province" title="--Chọn Tỉnh Thành--"
                            class="form-control" required>
                            <option value="0">Tỉnh Thành</option>
                        </select>
                        @error('province')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <select class="css_select" id="district" name="district" title="--Chọn Quận Huyện--"
                            class="form-control" required>
                            <option value="0">--Quận Huyện--</option>
                        </select>
                        @error('district')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <select class="css_select" id="ward" name="ward" title="--Chọn Phường Xã-- "
                            class="form-control" required>
                            <option value="0">--Phường Xã--</option>
                        </select>
                        @error('ward')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <input type="text" class="form-control" id="inputEmail4" name="address_detail"
                            placeholder="Địa chỉ cụ thể" required value="{{ old('address_detail') }}">
                        @error('address_detail')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="inputState">Hình thức thanh toán</label>
                        <select name="payments" id="inputState" class="form-control" required>
                            <option value="1">Thanh Toán Khi Nhận Hàng</option>
                            <option value="2">Thanh Toán Trực Tuyến</option>
                        </select>
                        @error('payments')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label for="inputZip">Mã giảm giá</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Nhập mã giảm giá" name="voucher"
                                value="{{ old('voucher') }}">
                            <button class="btn  select-voucher" type="submit"><i
                                    class="fa-solid fa-ticket"></i></button>
                            @error('voucher')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row online-payment"></div>
                <div class="row">
                    <div class="col-md-8">

                    </div>
                    <div class="col-md-4">
                        <table class="table table-condensed total-result">
                            <tr>
                                <td>Số loại sản phẩm</td>
                                <td><strong>{{ $carts->count() }}</strong></td>
                            </tr>
                            <tr>
                                <td>Giảm giá</td>
                                <td><strong style="color: #9f9f9f">0</strong></td>
                            </tr>
                            <tr>
                                <td>Tồng tiền cần thanh toán</td>
                                <td><strong style="color: ">{{ priceFormat($total) }} VND</strong></td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-8"></div>
                    <div class="form-group col-md-4 text-center">
                        <button type="submit" class="btn btn-payment">ĐẶT HÀNG</button>
                    </div>
                </div>
            </form>
        </div>


        <script>
            $(document).ready(function() {
                //Lấy tỉnh thành
                $.getJSON('https://esgoo.net/api-tinhthanh/1/0.htm', function(data_tinh) {
                    if (data_tinh.error == 0) {
                        $.each(data_tinh.data, function(key_tinh, val_tinh) {
                            $("#province").append('<option value="' + val_tinh.full_name +
                                '" data-tinh_id="' + val_tinh.id + '">' + val_tinh.full_name +
                                '</option>');
                        });
                        $("#province").change(function(e) {
                            var idtinh = $(this).find(':selected').data('tinh_id');
                            //Lấy quận huyện
                            $.getJSON('https://esgoo.net/api-tinhthanh/2/' + idtinh + '.htm', function(
                                data_quan) {
                                if (data_quan.error == 0) {
                                    $("#district").html(
                                        '<option value="0">--Quận Huyện--</option>');
                                    $("#ward").html('<option value="0">--Phường Xã--</option>');
                                    $.each(data_quan.data, function(key_quan, val_quan) {
                                        $("#district").append('<option value="' +
                                            val_quan
                                            .full_name + '" data-quan_id="' +
                                            val_quan.id + '">' + val_quan
                                            .full_name +
                                            '</option>');
                                    });
                                    //Lấy phường xã  
                                    $("#district").change(function(e) {
                                        var idquan = $(this).find(':selected').data(
                                            'quan_id')
                                        $.getJSON('https://esgoo.net/api-tinhthanh/3/' +
                                            idquan + '.htm',
                                            function(data_phuong) {
                                                if (data_phuong.error == 0) {
                                                    $("#ward").html(
                                                        '<option value="0">--Phường Xã--</option>'
                                                    );
                                                    $.each(data_phuong.data,
                                                        function(key_phuong,
                                                            val_phuong) {
                                                            $("#ward").append(
                                                                '<option value="' +
                                                                val_phuong
                                                                .full_name +
                                                                '">' +
                                                                val_phuong
                                                                .full_name +
                                                                '</option>');
                                                        });
                                                }
                                            });
                                    });

                                }
                            });
                        });

                    }
                });
            });
        </script>
    </section> <!--/#cart_items-->
@endsection
