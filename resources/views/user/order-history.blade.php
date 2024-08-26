@extends('user/layouts/layout')
@section('content')
    <style>
        section {
            background-color: #F5F5F5;
            padding-top: 30px;
            padding-bottom: 30px;
        }

        .order-history {
            background-color: #fff;
        }

        .header-order {
            padding: 22px 12px;
            font-size: 15px;
            border-bottom: 1px solid #ccc;
        }
    </style>

    <section>
        <div class="container order-history">
            <div class="order-item">
                <div class="row header-order">
                    <div class="col-sm-6 ">
                        <span><b>MÃ ĐƠN HÀNG: 12121212</b></span>
                    </div>
                    <div class="col-sm-6 text-right">
                        <span><b>NGÀY ĐẶT: 23/08/2010</b> </span>
                        <span> | </span>
                        <span>GIAO HÀNG THÀNH CÔNG</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
