@extends('user/layouts/layout')
@section('content')
    <style>
        .product-image-wrapper {
            border-radius: 0;
        }

        .product-image-wrapper:hover {
            border: 2px solid #F89F53;
            cursor: pointer
        }

        .discount {
            font-size: 14px;
            font-weight: 400;
            background-color: antiquewhite;
            margin-left: 12px;
        }

        .productinfo h2 {
            color: #f89f53;
            font-size: 18px;
            margin-top: 0px;
            padding-left: 12px;
        }

        .productinfo .product-name {
            font-family: 'Roboto', sans-serif;
            font-size: 15px;
            font-weight: 500;
            color: #575050;
            margin-top: 22px;
            padding-left: 12px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .productinfo .sold-quantity {
            padding-left: 12px;
            margin-top: 7px;
            font-size: 14px;
            font-weight: 400;
        }

        .single-products a {
            text-decoration: none;
        }
    </style>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="left-sidebar">
                        <h2>DANH MỤC</h2>
                        <div class="panel-group category-products" id="accordian"><!--category-productsr-->
                            @if (isset($categories) && !$categories->isEmpty())
                                @foreach ($categories as $category)
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a>
                                                    <span data-toggle="collapse" data-parent="#accordian"
                                                        href="#{{ $category->name }}" class="badge pull-right"><i
                                                            class="fa fa-plus"></i></span>
                                                    {{ $category->name }}
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="{{ $category->name }}" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                @if (!$category->products->isEmpty())
                                                    <ul>
                                                        @foreach ($category->products as $product)
                                                            <li><a href="#">{{ $product->name }} </a></li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div><!--/category-products-->
                        <div class="shipping text-center"><!--shipping-->
                            <img src="{{ asset('frontend/images/home/shipping.jpg') }}" alt="" />
                        </div><!--/shipping-->

                        <div class="shipping text-center"><!--shipping-->
                            <img src="{{ asset('frontend/images/home/banner-2.jpg') }}" alt="" />
                        </div><!--/shipping-->

                        {{-- <div class="shipping text-center"><!--shipping-->
                            <img src="{{ asset('frontend/images/home/banner-3.jpg') }}" alt="" />
                        </div><!--/shipping--> --}}
                    </div>
                </div>
                <div class="col-sm-9 padding-right">
                    {{--  @yield('content')  --}}
                    <!--features_items-->
                    <div class="features_items">
                        <h2 class="title text-center">DANH SÁCH SẢN PHẨM</h2>
                        @if (isset($products))
                            @foreach ($products as $product)
                                @php
                                    $productVariant = $product->productVariants()->first();
                                @endphp
                                <div class="col-sm-3">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <a href="{{ route('product-detail', ['id' => $product->id]) }}">
                                                <div class="productinfo">
                                                    <img src="{{ asset('image/' . $productVariant->image_path) }}"
                                                        alt="" />
                                                    <p class="product-name">{{ $product->name }}</p>
                                                    <h2>{{ priceFormat(priceDiscount($product->price, $product->discount)) }}đ
                                                        @if ($product->discount > 0)
                                                            <span class="discount">-{{ $product->discount }}%</span>
                                                        @endif
                                                    </h2>
                                                    <p class="sold-quantity">Đã bán {{ $product->sold_quantity }}</p>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    @if (isset($products))
                        {{ $products->links() }}
                    @endif
                    <!--features_items-->

                    {{-- <div class="features_items">
                        <h2 class="title text-center">SẢN PHẨM BÁN CHẠY</h2>
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo">
                                        <img src="{{ 'frontend/images/home/product1.jpg' }}" alt="" />
                                        <p>Áo thun nam 3 lớp</p>
                                        <h2>1.200.000đ</h2>
                                        <a href="#" class="btn btn-default add-to-cart"><i
                                                class="fa fa-shopping-cart"></i>Add to
                                            cart</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo">
                                        <img src="{{ 'frontend/images/home/product2.jpg' }}" alt="" />
                                        <p>Áo thun nam 3 lớp</p>
                                        <h2>1.200.000đ</h2>
                                        <a href="#" class="btn btn-default add-to-cart"><i
                                                class="fa fa-shopping-cart"></i>Add to
                                            cart</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo">
                                        <img src="{{ 'frontend/images/home/product3.jpg' }}" alt="" />
                                        <p>Áo thun nam 3 lớp</p>
                                        <h2>1.200.000đ</h2>
                                        <a href="#" class="btn btn-default add-to-cart"><i
                                                class="fa fa-shopping-cart"></i>Add to
                                            cart</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo">
                                        <img src="{{ 'frontend/images/home/product4.jpg' }}" alt="" />
                                        <p>Áo thun nam 3 lớp</p>
                                        <h2>1.200.000đ</h2>
                                        <a href="#" class="btn btn-default add-to-cart"><i
                                                class="fa fa-shopping-cart"></i>Add to
                                            cart</a>
                                    </div>
                                    <img src="{{ 'frontend/images/home/new.png' }}" class="new" alt="" />
                                </div>

                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo">
                                        <img src="{{ 'frontend/images/home/product5.jpg' }}" alt="" />
                                        <p>Áo thun nam 3 lớp</p>
                                        <h2>1.200.000đ</h2>
                                        <a href="#" class="btn btn-default add-to-cart"><i
                                                class="fa fa-shopping-cart"></i>Add to
                                            cart</a>
                                    </div>
                                    <img src="{{ 'frontend/images/home/sale.png' }}" class="new" alt="" />
                                </div>

                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo">
                                        <img src="{{ 'frontend/images/home/product6.jpg' }}" alt="" />
                                        <p>Áo thun nam 3 lớp</p>
                                        <h2>1.200.000đ</h2>
                                        <a href="#" class="btn btn-default add-to-cart"><i
                                                class="fa fa-shopping-cart"></i>Add to
                                            cart</a>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div> --}}
                    <!--features_items-->
                    {{-- <div class="recommended_items">
                        <h2 class="title text-center">SẢN PHẨM MỚI</h2>

                        <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="item active">
                                    <div class="col-sm-4">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo">
                                                    <img src="{{ 'frontend/images/home/recommend1.jpg' }}"
                                                        alt="" />
                                                    <h2>$56</h2>
                                                    <p>Easy Polo Black Edition</p>
                                                    <a href="#" class="btn btn-default add-to-cart"><i
                                                            class="fa fa-shopping-cart"></i>Add to cart</a>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo">
                                                    <img src="{{ 'frontend/images/home/recommend2.jpg' }}"
                                                        alt="" />
                                                    <h2>$56</h2>
                                                    <p>Easy Polo Black Edition</p>
                                                    <a href="#" class="btn btn-default add-to-cart"><i
                                                            class="fa fa-shopping-cart"></i>Add to cart</a>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo">
                                                    <img src="{{ 'frontend/images/home/recommend3.jpg' }}"
                                                        alt="" />
                                                    <h2>$56</h2>
                                                    <p>Easy Polo Black Edition</p>
                                                    <a href="#" class="btn btn-default add-to-cart"><i
                                                            class="fa fa-shopping-cart"></i>Add to cart</a>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="col-sm-4">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo">
                                                    <img src="{{ 'frontend/images/home/recommend1.jpg' }}"
                                                        alt="" />
                                                    <h2>$56</h2>
                                                    <p>Easy Polo Black Edition</p>
                                                    <a href="#" class="btn btn-default add-to-cart"><i
                                                            class="fa fa-shopping-cart"></i>Add to cart</a>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo">
                                                    <img src="{{ 'frontend/images/home/recommend2.jpg' }}"
                                                        alt="" />
                                                    <h2>$56</h2>
                                                    <p>Easy Polo Black Edition</p>
                                                    <a href="#" class="btn btn-default add-to-cart"><i
                                                            class="fa fa-shopping-cart"></i>Add to cart</a>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo">
                                                    <img src="{{ 'frontend/images/home/recommend3.jpg' }}"
                                                        alt="" />
                                                    <h2>$56</h2>
                                                    <p>Easy Polo Black Edition</p>
                                                    <a href="#" class="btn btn-default add-to-cart"><i
                                                            class="fa fa-shopping-cart"></i>Add to cart</a>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                                <i class="fa fa-angle-left"></i>
                            </a>
                            <a class="right recommended-item-control" href="#recommended-item-carousel"
                                data-slide="next">
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </div> --}}
                    <!--/recommended_items-->
                </div>
            </div>
        </div>
    </section>
@endsection
