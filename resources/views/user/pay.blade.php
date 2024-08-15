@extends('user/layouts/layout')
@section('content')
    <script src="https://esgoo.net/scripts/jquery.js"></script>
    <style type="text/css">
        .css_select_div {
            text-align: center;
        }

        .css_select {
            display: block;
            width: 100%;
            height: 34px;
            padding: 6px 12px;
            font-size: 14px;
            line-height: 1.428571429;
            color: #555;
            vertical-align: middle;
            background-color: #fff;
            background-image: none;
            border: 1px solid #ccc;
            border-radius: 4px;
            -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
            -webkit-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
            transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
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

            <div>
                <form>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Họ và tên</label>
                            <input type="email" class="form-control" id="inputEmail4" placeholder="Email">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Số điện thoại</label>
                            <input type="text" class="form-control" id="inputPassword4" placeholder="Password">
                        </div>
                    </div>
                    <label style="padding-left: 15px" for="inputPassword4">Địa chỉ nhận hàng</label>
                    <div class="form-row">
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
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="inputState">State</label>
                            <select id="inputState" class="form-control">
                                <option selected>Choose...</option>
                                <option>...</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputZip">Zip</label>
                            <input type="text" class="form-control" id="inputZip">
                        </div>
                    </div>
                    <div class="form-row">
                        <button type="submit" class="btn btn-primary">Sign in</button>
                    </div>

                </form>
            </div>

            <div class="review-payment">
                <h2>Review & Payment</h2>
            </div>

            <div class="table-responsive cart_info">
                <table class="table table-condensed">
                    <thead>
                        <tr class="cart_menu">
                            <td class="image">Item</td>
                            <td class="description"></td>
                            <td class="price">Price</td>
                            <td class="quantity">Quantity</td>
                            <td class="total">Total</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="cart_product">
                                <a href=""><img src="images/cart/one.png" alt=""></a>
                            </td>
                            <td class="cart_description">
                                <h4><a href="">Colorblock Scuba</a></h4>
                                <p>Web ID: 1089772</p>
                            </td>
                            <td class="cart_price">
                                <p>$59</p>
                            </td>
                            <td class="cart_quantity">
                                <div class="cart_quantity_button">
                                    <a class="cart_quantity_up" href=""> + </a>
                                    <input class="cart_quantity_input" type="text" name="quantity" value="1"
                                        autocomplete="off" size="2">
                                    <a class="cart_quantity_down" href=""> - </a>
                                </div>
                            </td>
                            <td class="cart_total">
                                <p class="cart_total_price">$59</p>
                            </td>
                            <td class="cart_delete">
                                <a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
                            </td>
                        </tr>

                        <tr>
                            <td class="cart_product">
                                <a href=""><img src="images/cart/two.png" alt=""></a>
                            </td>
                            <td class="cart_description">
                                <h4><a href="">Colorblock Scuba</a></h4>
                                <p>Web ID: 1089772</p>
                            </td>
                            <td class="cart_price">
                                <p>$59</p>
                            </td>
                            <td class="cart_quantity">
                                <div class="cart_quantity_button">
                                    <a class="cart_quantity_up" href=""> + </a>
                                    <input class="cart_quantity_input" type="text" name="quantity" value="1"
                                        autocomplete="off" size="2">
                                    <a class="cart_quantity_down" href=""> - </a>
                                </div>
                            </td>
                            <td class="cart_total">
                                <p class="cart_total_price">$59</p>
                            </td>
                            <td class="cart_delete">
                                <a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td class="cart_product">
                                <a href=""><img src="images/cart/three.png" alt=""></a>
                            </td>
                            <td class="cart_description">
                                <h4><a href="">Colorblock Scuba</a></h4>
                                <p>Web ID: 1089772</p>
                            </td>
                            <td class="cart_price">
                                <p>$59</p>
                            </td>
                            <td class="cart_quantity">
                                <div class="cart_quantity_button">
                                    <a class="cart_quantity_up" href=""> + </a>
                                    <input class="cart_quantity_input" type="text" name="quantity" value="1"
                                        autocomplete="off" size="2">
                                    <a class="cart_quantity_down" href=""> - </a>
                                </div>
                            </td>
                            <td class="cart_total">
                                <p class="cart_total_price">$59</p>
                            </td>
                            <td class="cart_delete">
                                <a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4">&nbsp;</td>
                            <td colspan="2">
                                <table class="table table-condensed total-result">
                                    <tr>
                                        <td>Cart Sub Total</td>
                                        <td>$59</td>
                                    </tr>
                                    <tr>
                                        <td>Exo Tax</td>
                                        <td>$2</td>
                                    </tr>
                                    <tr class="shipping-cost">
                                        <td>Shipping Cost</td>
                                        <td>Free</td>
                                    </tr>
                                    <tr>
                                        <td>Total</td>
                                        <td><span>$61</span></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="payment-options">
                <span>
                    <label><input type="checkbox"> Direct Bank Transfer</label>
                </span>
                <span>
                    <label><input type="checkbox"> Check Payment</label>
                </span>
                <span>
                    <label><input type="checkbox"> Paypal</label>
                </span>
            </div>
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
        <div class="css_select_div">
            <select class="css_select" id="tinh" name="tinh" title="Chọn Tỉnh Thành">
                <option value="0">Tỉnh Thành</option>
            </select>
            <select class="css_select" id="quan" name="quan" title="Chọn Quận Huyện">
                <option value="0">Quận Huyện</option>
            </select>
            <select class="css_select" id="phuong" name="phuong" title="Chọn Phường Xã">
                <option value="0">Phường Xã</option>
            </select>
        </div>
    </section> <!--/#cart_items-->
@endsection
