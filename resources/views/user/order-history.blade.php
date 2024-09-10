@extends('user/layouts/layout')
@section('content')
    <style>
        #footer {
            margin-top: 0 !important;
        }

        section {
            background-color: #F5F5F5;
            padding-top: 30px;
            padding-bottom: 30px;
        }

        .order-history {
            background-color: #fff;
            margin-bottom: 20px;
            box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);
        }

        .header-order {
            padding: 22px 12px;
            font-size: 15px;
            border-bottom: 1px solid #ccc;
        }

        .order-item .status {
            color: rgb(254, 152, 15);
        }

        .order-detail {
            padding-top: 12px;
            border-bottom: 1px solid #ccc;
        }

        .product-name {
            font-size: 16px;
            font-weight: 600;
        }

        .variant {
            margin-bottom: 0;
            color: #978b8b;
        }

        .align-items-center {
            display: flex;
            align-items: center
        }

        .price {
            font-size: 18px;
        }

        .price .origin-price {
            text-decoration: line-through;
            color: #929292;
        }

        .price .buy-price {
            color: rgb(254, 152, 15);
        }

        .footer-order {
            padding-top: 20px;
            padding-bottom: 20px;
            font-size: 20px;
            background: rgb(255, 254, 251);
        }

        .mb-10 {
            margin-bottom: 10px;
        }

        .btn-status {
            font-size: 18px;
            background: #FE9F20;
            color: #fff;
            padding: 7px 15px;
            border-radius: 7px;
        }
    </style>

    <section>
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="{{ route('home_page_user') }}">Trang chủ</a></li>
                    <li class="active">LỊCH SỬ MUA HÀNG</li>
                </ol>
            </div>
            <div class="container order-history">
                <div class="order-item">
                    <div class="row header-order">
                        <div class="col-sm-6 ">
                            <span><b>MÃ ĐƠN HÀNG: 12121212</b></span>
                        </div>
                        <div class="col-sm-6 text-right">
                            <span style="color: #858585"><b>NGÀY ĐẶT: 23/08/2010</b> </span>
                            <span> | </span>
                            <span class="status">GIAO HÀNG THÀNH CÔNG</span>
                        </div>
                    </div>
                    <div class="row order-detail">
                        <div class="col-sm-2 text-center">
                            <img src="{{ asset('/image/sp8.jpg') }}" style="width:50%;">
                        </div>
                        <div class="col-sm-10">
                            <div class="row align-items-center">
                                <div class="col-sm-9">
                                    <p class="product-name">Chuột máy tính 𝙇𝙤𝙜𝙞𝙩𝙚𝙘𝙝 G102 OEM có dây 16,8 triệu màu
                                        LED
                                        RGB đổi
                                        màu Bảo hành 12 Tháng
                                        [ 1 đổi 1 ]</p>
                                    <p class="variant">Phân loại hàng: Đen, XL</p>
                                    <p>x1</p>
                                </div>
                                <div class="col-sm-3 price text-center">
                                    <span class="origin-price">120.000đ</span>
                                    <span class="buy-price">145.000đ</span>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row footer-order text-right">
                        <div class="col-sm-12 mb-10">
                            Giảm giá: <span><strong style="color: #929292">145.000đ</strong></span>
                        </div>
                        <div class="col-sm-12 total_amount mb-10">
                            Thành tiền: <span><strong style="color: rgb(254, 152, 15)">145.000đ</strong></span>
                        </div>
                        <div class="col-sm-12" style="margin-top: 12px">
                            <span class="btn-status">Hủy Đơn Hàng</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container order-history">
                <div class="order-item">
                    <div class="row header-order">
                        <div class="col-sm-6 ">
                            <span><b>MÃ ĐƠN HÀNG: 12121212</b></span>
                        </div>
                        <div class="col-sm-6 text-right">
                            <span style="color: #858585"><b>NGÀY ĐẶT: 23/08/2010</b> </span>
                            <span> | </span>
                            <span class="status">GIAO HÀNG THÀNH CÔNG</span>
                        </div>
                    </div>
                    <div class="row order-detail">
                        <div class="col-sm-2 text-center">
                            <img src="{{ asset('/image/sp8.jpg') }}" style="width:50%;">
                        </div>
                        <div class="col-sm-10">
                            <div class="row align-items-center">
                                <div class="col-sm-9">
                                    <p class="product-name">Chuột máy tính 𝙇𝙤𝙜𝙞𝙩𝙚𝙘𝙝 G102 OEM có dây 16,8 triệu màu
                                        LED
                                        RGB đổi
                                        màu Bảo hành 12 Tháng
                                        [ 1 đổi 1 ]</p>
                                    <p class="variant">Phân loại hàng: Đen, XL</p>
                                    <p>x1</p>
                                </div>
                                <div class="col-sm-3 price text-center">
                                    <span class="origin-price">120.000đ</span>
                                    <span class="buy-price">145.000đ</span>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row footer-order text-right">
                        <div class="col-sm-12 mb-10">
                            Giảm giá: <span><strong style="color: #929292">145.000đ</strong></span>
                        </div>
                        <div class="col-sm-12 total_amount mb-10">
                            Thành tiền: <span><strong style="color: rgb(254, 152, 15)">145.000đ</strong></span>
                        </div>
                        <div class="col-sm-12" style="margin-top: 12px">
                            <span class="btn-status">Hủy Đơn Hàng</span>
                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection
