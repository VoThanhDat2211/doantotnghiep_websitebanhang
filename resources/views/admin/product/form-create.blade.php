@extends('admin/layouts/layout')
@section('admin-content')
    <link href="{{ asset('admin/css/create-product.css') }}" rel="stylesheet" />

    <div class="redirect-common text-end">
        <a href="{{ route('admin-product-list') }}" class="btn btn-primary link-redirect-common">DANH SÁCH SẢN PHẨM</a>
    </div>
    <div class="row mt-form-common">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading heading-form-common">
                    Thêm Sản Phẩm
                </header>
                <div class="panel-body">
                    <div class=" form">
                        <form class="cmxform form-horizontal " id="" method="post" action="{{route('admin-product-create')}}">
                            @csrf
                            <div class="form-group ">
                                <label for="cname" class="control-label col-lg-4">Tên sản phẩm (<span
                                        style="color: red">*</span>)</label>
                                <div class="col-lg-7">
                                    <input class=" form-control" id="cname" name="name"  type="text"
                                           required value="{{ old('name') }}">
                                    @error('name')
                                    <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="category" class="control-label col-lg-4">Danh mục (<span
                                        style="color: red">*</span>)</label>
                                <div class="col-lg-7">
                                    <select class="form-control" id="category" required name="category_id">
                                        <option value="1">Thời Trang Nam</option>
                                        <option value="2">Thời Trang Nữ</option>
                                        <option value="3">Đồ Thể Thao</option>
                                    </select>
                                    @error('category_id')
                                    <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="description" class="control-label col-lg-4">Mô tả (<span
                                        style="color: red">*</span>)</label>
                                <div class="col-lg-7">
                                    <textarea name="description" rows="3" class="form-control"  value="">{{ old('description') }}</textarea>
                                    @error('name')
                                    <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="images" class="control-label col-lg-4">Hình ảnh (<span
                                        style="color: red">*</span>)</label>
                                <div class="col-lg-7">
                                    <input class=" form-control" id="images" name="images"  type="file"
                                           required multiple accept=".jpg, .png">
                                    @error('images')
                                    <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="discount" class="control-label col-lg-4">Giảm giá(%) (<span
                                        style="color: red">*</span>)</label>
                                <div class="col-lg-7">
                                    <input class=" form-control" id="discount" name="discount"  type="number" min="0" max="100"
                                           required value="{{ old('discount') }}">
                                    @error('discount')
                                    <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-12 text-center mt-12">
                                    <button class="btn btn-primary" type="submit">Lưu</button>
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
