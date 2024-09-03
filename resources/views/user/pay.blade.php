@extends('user/layouts/layout')
@section('content')
    <script src="https://esgoo.net/scripts/jquery.js"></script>
    <link href="{{ asset('frontend/css/pay.css') }}" rel="stylesheet" />

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
                        @if (isset($productVariant))
                            <tr>
                                <td class="cart_product">
                                    <a href=""><img style="width: 80px; height: 80px;"
                                            src="{{ asset('/image/' . $productVariant->image_path) }}" alt=""></a>
                                </td>
                                <td class="cart_description">
                                    <h4><a href="">{{ $productVariant->product->name }}</a></h4>
                                    <p>{{ $productVariant->color . ', ' . renderSize($productVariant->size) }}</p>
                                </td>
                                <td class="cart_price">
                                    <p>{{ priceFormat(priceDiscount($productVariant->product->price, $productVariant->product->discount)) }}đ
                                    </p>
                                </td>
                                <td class="cart_quantity">
                                    <div class="cart_quantity_button">
                                        {{ $buyQuantity }}
                                    </div>
                                </td>
                                <td class="cart_total">
                                    <p class="cart_total_price">
                                        {{ priceFormat(priceDiscount($productVariant->product->price, $productVariant->product->discount) * $buyQuantity) }}
                                    </p>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <form>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Họ và tên</label>
                        <input type="email" class="form-control" id="inputEmail4" placeholder="Họ và tên">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Số điện thoại</label>
                        <input type="text" class="form-control" id="inputPassword4" placeholder="Số điện thoại">
                    </div>
                </div>
                <label for="inputPassword4">Địa chỉ nhận hàng</label>
                <div class="row">
                    <div class="form-group col-md-4">
                        <select class="css_select" id="province" name="province" title="--Chọn Tỉnh Thành--"
                            class="form-control">
                            <option value="0">Tỉnh Thành</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <select class="css_select" id="district" name="district" title="--Chọn Quận Huyện--"
                            class="form-control">
                            <option value="0">--Quận Huyện--</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <select class="css_select" id="ward" name="ward" title="--Chọn Phường Xã-- "
                            class="form-control">
                            <option value="0">--Phường Xã--</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="inputState">Hình thức thanh toán</label>
                        <select id="inputState" class="form-control">
                            <option selected>Chọn...</option>
                            <option>...</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="inputZip">Mã giảm giá</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Nhập mã giảm giá">
                            <button class="btn  select-voucher" type="submit"><i class="fa-solid fa-ticket"></i></button>
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
                                <td>Tổng sản phẩm</td>
                                <td><strong>1</strong></td>
                            </tr>
                            <tr>
                                <td>Giảm giá</td>
                                <td><strong style="color: #9f9f9f">12.000</strong></td>
                            </tr>
                            <tr>
                                <td>Tồng tiền cần thanh toán</td>
                                <td><strong style="color: ">12.000.000 VND</strong></td>
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
                            $("#province").append('<option value="' + val_tinh.id + '">' + val_tinh
                                .full_name + '</option>');
                        });
                        $("#province").change(function(e) {
                            var idtinh = $(this).val();
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
                                            .id + '">' + val_quan.full_name +
                                            '</option>');
                                    });
                                    //Lấy phường xã  
                                    $("#district").change(function(e) {
                                        var idquan = $(this).val();
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
                                                                .id + '">' +
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
