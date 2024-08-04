@extends('admin/layouts/layout')
@section('admin-content')
    <link href="{{ asset('admin/css/create-category.css') }}" rel="stylesheet" />

    <div class="redirect-common text-end">
        <a href="{{ route('admin-category-list') }}" class="btn btn-primary link-redirect-common">DANH SÁCH DANH MỤC</a>
    </div>
    <div class="row mt-form-common">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading heading-form-common">
                    Thêm Danh Mục
                </header>
                <div class="panel-body">
                    <div class=" form">
                        <form class="cmxform form-horizontal " id="commentForm" method="post"
                            action="{{ route('admin-category-create') }}">
                            <div class="form-group ">
                                @csrf
                                <label for="cname" class="control-label col-lg-4">Tên danh mục (<span
                                        style="color: red">*</span>)</label>
                                <div class="col-lg-6">
                                    <input class=" form-control" id="cname" name="name" minlength="2" type="text"
                                        required>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="cname" class="control-label col-lg-4">Loại danh mục (<span
                                        style="color: red">*</span>)</label>
                                <div class="col-lg-6">
                                    <select class="form-control" id="cname" required>
                                        <option value="1">Thời Trang Nam</option>
                                        <option value="2">Thời Trang Nữ</option>
                                        <option value="3">Đồ Thể Thao</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-12 text-center mt-12">
                                    <input class="btn btn-primary" type="submit">Lưu</input>
                                    <button class="btn btn-default" type="reset">Xóa</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
