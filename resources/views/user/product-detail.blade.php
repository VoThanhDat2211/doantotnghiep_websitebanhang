@extends('user/layouts/layout')
@section('content')
    <script src="https://esgoo.net/scripts/jquery.js"></script>
    <link href="{{ asset('frontend/css/product-detail.css') }}" rel="stylesheet" />
    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-12 padding-right">
                    <div class="product-details"><!--product-details-->
                        <div class="col-sm-5">
                            <div class="view-product">
                                <div id="similar-product" class="carousel slide" data-ride="carousel" data-interval="false">

                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner">
                                        <div class="item active">
                                            <a href=""><img
                                                    src="{{ asset('frontend/images/product-details/1.jpg') }}"
                                                    alt=""></a>
                                        </div>
                                        <div class="item">
                                            <a href=""><img
                                                    src="{{ asset('frontend/images/product-details/1.jpg') }}"
                                                    alt=""></a>
                                        </div>
                                        <div class="item">
                                            <a href=""><img
                                                    src="{{ asset('frontend/images/product-details/1.jpg') }}"
                                                    alt=""></a>
                                        </div>
                                        <div class="item">
                                            <a href=""><img
                                                    src="{{ asset('frontend/images/product-details/1.jpg') }}"
                                                    alt=""></a>
                                        </div>
                                        <div class="item">
                                            <a href=""><img
                                                    src="{{ asset('frontend/images/product-details/1.jpg') }}"
                                                    alt=""></a>
                                        </div>
                                        <div class="item">
                                            <a href=""><img
                                                    src="{{ asset('frontend/images/product-details/1.jpg') }}"
                                                    alt=""></a>
                                        </div>
                                    </div>

                                    <!-- Controls -->
                                    <a class="left item-control" href="#similar-product" data-slide="prev">
                                        <i class="fa fa-angle-left"></i>
                                    </a>
                                    <a class="right item-control" href="#similar-product" data-slide="next">
                                        <i class="fa fa-angle-right"></i>
                                    </a>
                                </div>
                            </div>
                            <div id="similar-product" class="carousel slide" data-ride="carousel">

                                <!-- Wrapper for slides -->
                                <div class="carousel-inner">
                                    <div class="item active">
                                        <a href=""><img
                                                src="{{ asset('frontend/images/product-details/similar1.jpg') }}"
                                                alt=""></a>
                                        <a href=""><img
                                                src="{{ asset('frontend/images/product-details/similar1.jpg') }}"
                                                alt=""></a>
                                        <a href=""><img
                                                src="{{ asset('frontend/images/product-details/similar1.jpg') }}"
                                                alt=""></a>
                                        <a href=""><img
                                                src="{{ asset('frontend/images/product-details/similar1.jpg') }}"
                                                alt=""></a>
                                        <a href=""><img
                                                src="{{ asset('frontend/images/product-details/similar1.jpg') }}"
                                                alt=""></a>
                                        <a href=""><img
                                                src="{{ asset('frontend/images/product-details/similar1.jpg') }}"
                                                alt=""></a>
                                        <a href=""><img
                                                src="{{ asset('frontend/images/product-details/similar1.jpg') }}"
                                                alt=""></a>
                                        <a href=""><img
                                                src="{{ asset('frontend/images/product-details/similar1.jpg') }}"
                                                alt=""></a>
                                    </div>
                                </div>


                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="row">
                                <form id="product-information">
                                    <div class="product-information"><!--/product-information-->
                                        <img src="images/product-details/new.jpg" class="newarrival" alt="" />
                                        <h2>ÁO THUN ADLV BASIC FORM RỘNG UNISEX VẢI 100% COTTON HAI CHIỀU CAO CẤP - BAPE
                                            PHẾCH
                                        </h2>
                                        <div class="price">
                                            <span class="price-origin">₫500.000</span>
                                            <span class="price-sale mx-2">₫429.000</span>
                                        </div>
                                        <p style="font-size: 20px; margin-top: 12px;">
                                            <span>Đã bán: <strong>100</strong></span> | <span>Còn lại:
                                                <strong>200</strong></span>
                                        </p>
                                        <div class="row color">
                                            <div class="col-sm-3 title">Màu</div>
                                            <div class="col-sm-9">
                                                <div class="row">
                                                    <div class="col-sm-2 color-item">ĐEN</div>
                                                    <div class="col-sm-2 color-item">ĐỎ</div>
                                                    <div class="col-sm-2 color-item">VÀNG</div>
                                                    <div class="col-sm-2 color-item">XANH</div>
                                                    <div class="col-sm-2 color-item">XANH</div>
                                                    <div class="col-sm-2 color-item">XANH</div>
                                                    <div class="col-sm-2 color-item">XANH</div>
                                                </div>
                                                <div class="row">
                                                    <span class="error">Vui lòng chọn màu sắc!</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row size">
                                            <div class="col-sm-3 title">Size</div>
                                            <div class="col-sm-9">
                                                <div class="row">
                                                    <div class="col-sm-2 size-item">ĐEN</div>
                                                    <div class="col-sm-2 size-item">ĐỎ</div>
                                                    <div class="col-sm-2 size-item">VÀNG</div>
                                                    <div class="col-sm-2 size-item">XANH</div>
                                                    <div class="col-sm-2 size-item">XANH</div>
                                                    <div class="col-sm-2 size-item">XANH</div>
                                                    <div class="col-sm-2 size-item">XANH</div>
                                                </div>
                                                <div class="row">
                                                    <span class="error">Vui lòng chọn size!</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row quantity">
                                            <div class="col-sm-3 title">Số lượng</div>
                                            <div class="col-sm-9">
                                                <div class="row">
                                                    <div class="cart_quantity_button">
                                                        <a class="cart_quantity_up" href=""> + </a>
                                                        <input class="cart_quantity_input" type="text" name="quantity"
                                                            value="1" autocomplete="off" size="2">
                                                        <a class="cart_quantity_down" href=""> - </a>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <span class="error quantity-error">Số lượng không có sẵn!</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <button type="button" class="btn btn-fefault btn-cart">
                                                    <i class="fa fa-shopping-cart"></i>
                                                    THÊM VÀO GIỎ HÀNG
                                                </button>
                                            </div>
                                            <div class="col-sm-4">
                                                <button type="button" class="btn btn-default btn-buy">
                                                    MUA NGAY
                                                </button>
                                            </div>
                                        </div>

                                    </div><!--/product-information-->
                                </form>
                            </div>

                        </div>
                    </div><!--/product-details-->

                    <div class="category-tab shop-details-tab"><!--category-tab-->
                        <div class="col-sm-12">
                            <ul class="nav nav-tabs">
                                <li><a href="#details" data-toggle="tab">MÔ TẢ CHI TIẾT</a></li>
                                <li class="active"><a href="#reviews" data-toggle="tab">ĐÁNH GIÁ (5)</a></li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane fade" id="details">
                                <div class="container">
                                    <h3>CHI TIẾT SẢN PHẨM</h3>
                                    <table class="table table-striped" style="max-width:60%">
                                        <thead>
                                            <tr>
                                                <th>Firstname</th>
                                                <th>Lastname</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>John</td>
                                                <td>Doe</td>

                                            </tr>
                                            <tr>
                                                <td>Mary</td>
                                                <td>Moe</td>

                                            </tr>
                                            <tr>
                                                <td>July</td>
                                                <td>Dooley</td>

                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="tab-pane fade active in" id="reviews">
                                <div class="col-sm-12 review-item">
                                    <ul>
                                        <li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
                                        <li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
                                    </ul>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud
                                        exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure
                                        dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                                        pariatur.</p>
                                </div>
                                <div class="col-sm-12 review-item">
                                    <ul>
                                        <li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
                                        <li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
                                    </ul>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud
                                        exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure
                                        dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                                        pariatur.</p>
                                </div>
                            </div>

                        </div>
                    </div><!--/category-tab-->

                </div>
            </div>
        </div>
    </section>
    <script>
        $(document).ready(function() {
            $('.cart_quantity_input').on('keypress', function(e) {
                let charCode = e.which;
                if (charCode < 48 || charCode > 57) {
                    e.preventDefault();
                }
            });

            $('.cart_quantity_input').on('input', function() {
                this.value = this.value.replace(/[^0-9]/g, '');
            });

            $('.cart_quantity_up').on('click', function(e) {
                e.preventDefault();
                let inputValue = $('.cart_quantity_input').val();
                $('.cart_quantity_input').val(++inputValue);
            })

            $('.cart_quantity_down').on('click', function(e) {
                e.preventDefault();
                let inputValue = $('.cart_quantity_input').val();
                inputValue = (inputValue > 1) ? (--inputValue) : inputValue;
                $('.cart_quantity_input').val(inputValue);
            })

            $('.cart_quantity_input').on('blur', function() {
                let inputValue = parseInt($('.cart_quantity_input').val());
                if (Number.isNaN(inputValue)) {
                    $('.cart_quantity_input').val(1);
                }

                if (inputValue > 100) {
                    $('.quantity-error').show();
                } else {
                    $('.quantity-error').hide();
                }
            });
        });
    </script>
@endsection
