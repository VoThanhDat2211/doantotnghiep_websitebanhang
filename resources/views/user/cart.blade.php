@extends('user/layouts/layout')
@section('content')
    <style>
        .cart_menu {
            height: 70px !important;
        }

        .cart_menu td {
            text-align: center
        }

        tbody td {
            text-align: center
        }

        .cart_quantity {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card {
                border-radius: 12px;
                border: 1px solid #ccc;
                padding: 12px;
                margin-bottom: 26px;
        }

        .btn-block {
            border-radius: 10px !important;
            background: crimson !important;
        }

    </style>

    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li class="active">Shopping Cart</li>
                </ol>
            </div>
            <div class="table-responsive cart_info">
                <table class="table table-condensed">
                    <thead>
                        <tr class="cart_menu">
                            <td></td>
                            <td class="image">HÌNH ẢNH</td>
                            <td class="description">TÊN SẢN PHẨM</td>
                            <td class="price">GIÁ</td>
                            <td class="quantity">SỐ LƯỢNG</td>
                            <td class="total">TỔNG TIỀN</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="checkbox" name="select_product[]" value="" /></td>
                            <td class="cart_product">
                                <a href=""><img src="{{ asset('frontend/images/cart/two.png') }}" alt=""></a>
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
                                    <input class="cart_quantity_input" type="number" name="quantity" value="1"
                                        min="0">
                                </div>
                            </td>
                            <td class="cart_total">
                                <p class="cart_total_price">$59</p>
                            </td>
                            <td class="cart_delete">
                                <a class="cart_quantity_delete" href=""><i class="fa-solid fa-trash"></i></a>
                            </td>
                        </tr>

                        <tr>
                            <td><input type="checkbox" name="select_product[]" value="" /></td>
                            <td class="cart_product">
                                <a href=""><img src="{{ asset('frontend/images/cart/two.png') }}" alt=""></a>
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
                                    <input class="cart_quantity_input" type="number" name="quantity" value="1"
                                        autocomplete="off" size="2">
                                </div>
                            </td>
                            <td class="cart_total">
                                <p class="cart_total_price">$59</p>
                            </td>
                            <td class="cart_delete">
                                <a class="cart_quantity_delete" href=""><i class="fa-solid fa-trash"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="checkbox" name="select_product[]" value="" /></td>
                            <td class="cart_product">
                                <a href=""><img src="{{ asset('frontend/images/cart/two.png') }}" alt=""></a>
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
                                    <input class="cart_quantity_input" type="number" name="quantity" value="1"
                                        autocomplete="off" size="2">
                                </div>
                            </td>
                            <td class="cart_total">
                                <p class="cart_total_price">$59</p>
                            </td>
                            <td class="cart_delete">
                                <a class="cart_quantity_delete" href=""><i class="fa-solid fa-trash"></i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-md-9">
                </div>
                <div class="col-md-3 mb-5">
                    <div class="card mb-4">
                        <div class="card-header py-3">
                            <h4 class="mb-0">HÓA ĐƠN</h4>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <li
                                    class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                                    TỔNG ĐƠN HÀNG| 
                                    <span><strong>1</strong></span> SẢN PHẨM
                                </li>
                                <li
                                    class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                                    <div>
                                        <strong>TỔNG TIỀN ĐƠN ĐẶT HÀNG</strong>
                                    </div>
                                    <span style="color: #f32f2f"><strong>12.000.000 VND</strong></span>
                                </li>
                            </ul>

                            <button type="button" data-mdb-button-init data-mdb-ripple-init
                                class="btn btn-primary btn-lg btn-block">
                                <a style="color: #fff" href="{{ route('user-pay') }}"> THANH TOÁN</a>
                               
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        

    </section> <!--/#cart_items-->
@endsection
