@extends('user/layouts/layout')
@section('content')
    <style>
        .view-product img {
            width: 100%;
            margin-left: 0 !important;
            object-fit: contain !important;
            height: auto !important;
            aspect-ratio: 1 / 1 !important;
            /* Tỷ lệ 1:1 */
        }

        .view-product #similar-product {
            margin-top: 0;
        }

        .view-product .item-control {
            top: 50% !important;
            transform: translateY(-50%);
        }

        .view-product .item-control i {
            background: none;
            color: #a39797;
            font-size: 30px;
            padding: 5px 10px;
        }

        .product-information {
            padding: 30px !important;
        }

        .product-information .price span {
            margin-top: 0 !important;
            margin-bottom: : 0 !important;
        }

        .product-information .price {
            background: #fafafa;
            padding: 12px 20px;
        }

        .product-information .price-origin {
            color: #929292;
            font-size: 18px;
            margin-right: 10px;
            -webkit-text-decoration: line-through;
            text-decoration: line-through;
        }

        .product-information .price-sale {
            color: #CA3E46;
            font-size: 28px;
            font-weight: 500;
        }

        .product-information .color {
            margin-top: 32px;
            margin-bottom: 18px;
        }

        .product-information .size {
            margin-bottom: 18px;
        }

        .product-information .quantity {
            margin-bottom: 35px;
        }

        .product-information .color-item,
        .product-information .size-item {
            padding: 8px !important;
            border: 1px solid #ccc;
            text-align: center;
            margin-right: 12px;
            margin-bottom: 12px;
        }

        .product-information .color-item:hover,
        .product-information .size-item:hover {
            cursor: pointer;
            border: 1px solid #fcf0f0;
            BACKGROUND: #fcf0f0;
        }

        .product-information .title {
            font-size: 16px;
            color: #757575;
        }

        .product-information .cart_quantity_button a {
            background: #F0F0E9;
            color: #696763;
            display: inline-block;
            font-size: 16px;
            overflow: hidden;
            text-align: center;
            width: 35px;
            float: left;
            padding: 4px 0;
            height: auto;
        }

        .product-information .cart_quantity_input {
            padding: 4px 0;
            min-width: 90px;
            font-size: 14px;
            margin-bottom: 12px;
        }

        .product-information .btn-buy {
            padding: 14px 50px;
            background: #CA3E46;
            color: #fff;
        }

        .product-information .btn-cart {
            background: #220608;
            padding: 14px;
            color: #fff
        }

        .btn-buy:hover,
        .btn-cart:hover {
            opacity: 0.6;
        }

        .product-information .error {
            margin: 0;
            color: red;
        }

        .product-information .review-item {
            border-bottom: 1px solid #ccc
        }
    </style>
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
                                <div class="product-information"><!--/product-information-->
                                    <img src="images/product-details/new.jpg" class="newarrival" alt="" />
                                    <h2>ÁO THUN ADLV BASIC FORM RỘNG UNISEX VẢI 100% COTTON HAI CHIỀU CAO CẤP - BAPE PHẾCH
                                    </h2>
                                    <div class="price">
                                        <span class="price-origin">₫500.000</span>
                                        <span class="price-sale mx-2">₫429.000</span>
                                    </div>
                                    <p style="font-size: 20px">
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
                                                <span class="error">Số lượng không có sẵn!</span>
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
                            </div>

                        </div>
                    </div><!--/product-details-->

                    <div class="category-tab shop-details-tab"><!--category-tab-->
                        <div class="col-sm-12">
                            <ul class="nav nav-tabs">
                                <li><a href="#details" data-toggle="tab">Details</a></li>
                                <li class="active"><a href="#reviews" data-toggle="tab">Reviews (5)</a></li>
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

                            <div class="tab-pane fade" id="companyprofile">
                                <div class="col-sm-3">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img src="images/home/gallery1.jpg" alt="" />
                                                <h2>$56</h2>
                                                <p>Easy Polo Black Edition</p>
                                                <button type="button" class="btn btn-default add-to-cart"><i
                                                        class="fa fa-shopping-cart"></i>Add to cart</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img src="images/home/gallery3.jpg" alt="" />
                                                <h2>$56</h2>
                                                <p>Easy Polo Black Edition</p>
                                                <button type="button" class="btn btn-default add-to-cart"><i
                                                        class="fa fa-shopping-cart"></i>Add to cart</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img src="images/home/gallery2.jpg" alt="" />
                                                <h2>$56</h2>
                                                <p>Easy Polo Black Edition</p>
                                                <button type="button" class="btn btn-default add-to-cart"><i
                                                        class="fa fa-shopping-cart"></i>Add to cart</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img src="images/home/gallery4.jpg" alt="" />
                                                <h2>$56</h2>
                                                <p>Easy Polo Black Edition</p>
                                                <button type="button" class="btn btn-default add-to-cart"><i
                                                        class="fa fa-shopping-cart"></i>Add to cart</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="tag">
                                <div class="col-sm-3">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img src="images/home/gallery1.jpg" alt="" />
                                                <h2>$56</h2>
                                                <p>Easy Polo Black Edition</p>
                                                <button type="button" class="btn btn-default add-to-cart"><i
                                                        class="fa fa-shopping-cart"></i>Add to cart</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img src="images/home/gallery2.jpg" alt="" />
                                                <h2>$56</h2>
                                                <p>Easy Polo Black Edition</p>
                                                <button type="button" class="btn btn-default add-to-cart"><i
                                                        class="fa fa-shopping-cart"></i>Add to cart</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img src="images/home/gallery3.jpg" alt="" />
                                                <h2>$56</h2>
                                                <p>Easy Polo Black Edition</p>
                                                <button type="button" class="btn btn-default add-to-cart"><i
                                                        class="fa fa-shopping-cart"></i>Add to cart</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img src="images/home/gallery4.jpg" alt="" />
                                                <h2>$56</h2>
                                                <p>Easy Polo Black Edition</p>
                                                <button type="button" class="btn btn-default add-to-cart"><i
                                                        class="fa fa-shopping-cart"></i>Add to cart</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade active in" id="reviews">
                                <div class="col-sm-12 review-item">
                                    <ul>
                                        <li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
                                        <li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
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

        {{--  -------------------------------------------------------------------------------------------------------  --}}
    </section>
@endsection
