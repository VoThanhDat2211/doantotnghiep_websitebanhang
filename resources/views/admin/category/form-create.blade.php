@extends('admin/layouts/layout')
@section('admin-content')
    <link href="{{ asset('admin/css/create-category.css') }}" rel="stylesheet" />

    <div class="redirect-common text-end">
        <a  href="{{ route('admin-category-list') }}" class="btn btn-primary link-redirect-common">DANH SÁCH DANH MỤC</a>
    </div>
    <div class="row mt-form-common">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading heading-form-common">
                    Thêm Danh Mục
                </header>
                <div class="panel-body">
                    <div class=" form">
                        <form class="cmxform form-horizontal " id="commentForm" method="get" action=""
                            novalidate="novalidate">
                            <div class="form-group ">
                                <label for="cname" class="control-label col-lg-3">Tên danh mục (<span style="color: red">*</span>)</label>
                                <div class="col-lg-6">
                                    <input class=" form-control" id="cname" name="name" minlength="2" type="text"
                                        required="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-offset-3 col-lg-6 mt-3">
                                    <button class="btn btn-primary" type="submit">Lưu</button>
                                    <button class="btn btn-default" type="reset" >Xóa</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
