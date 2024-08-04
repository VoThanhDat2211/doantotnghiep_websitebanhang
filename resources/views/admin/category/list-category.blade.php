@extends('admin/layouts/layout')
@section('admin-content')
    <link href="{{ asset('admin/css/category.css') }}" rel="stylesheet" />

    <div class="redirect-common text-end">
        <a href="{{ route('admin-category-form-create') }}" class="btn btn-primary link-redirect-common"><i
                class="fa-solid fa-circle-plus"></i> THÊM DANH MỤC</a>
    </div>
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Danh Sách Danh Mục
            </div>
            <div class="row w3-res-tb">
                <div class="col-sm-5 m-b-xs">
                    <select class="input-sm form-control w-sm inline v-middle">
                        <option value="0">Bulk action</option>
                        <option value="1">Delete selected</option>
                        <option value="2">Bulk edit</option>
                        <option value="3">Export</option>
                    </select>
                    <button class="btn btn-sm btn-default">Apply</button>
                </div>
                <div class="col-sm-4">
                </div>
                <div class="col-sm-3">
                    <div class="input-group">
                        <input type="text" class="input-sm form-control" placeholder="Search">
                        <span class="input-group-btn">
                            <button class="btn btn-sm btn-default" type="button">Go!</button>
                        </span>
                    </div>
                </div>
            </div>
            {{-- TABLE --}}
            <div class="table-responsive">
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th class="text-center" style="width:20px;"></th>
                            <th class="text-center">STT</th>
                            <th class="text-center">Tên Danh Mục</th>
                            <th class="text-center">Số Lượng Sản Phẩm</th>
                            <th class="text-center" style="">Tùy Chọn</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                            <td>1</td>
                            <td class="max-width: 100px"><span class="text-ellipsis">Quần áo nam</span></td>
                            <td><span class="text-ellipsis">Jul 11, 2013</span></td>
                            {{--  <td>
                            <a href="" class="active" ui-toggle-class=""><i class="fa fa-check text-success text-active"></i><i class="fa fa-times text-danger text"></i></a>
                        </td>  --}}
                            <td>
                                <a title="Sửa danh mục" href="" style="margin-right: 12px"><i
                                        class="fa-regular fa-pen-to-square" style="color: #0c9636;"></i>
                                    <a title="Xóa danh mục" href="" class="ml-2"><i class="fa-solid fa-trash"
                                            style="color: #E9423F;"></i>
                                    </a>
                            </td>
                        </tr>
                        <tr>
                            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                            <td>1</td>
                            <td class="max-width: 100px"><span class="text-ellipsis">Quần áo nam</span></td>
                            <td><span class="text-ellipsis">Jul 11, 2013</span></td>
                            {{--  <td>
                            <a href="" class="active" ui-toggle-class=""><i class="fa fa-check text-success text-active"></i><i class="fa fa-times text-danger text"></i></a>
                        </td>  --}}
                            <td>
                                <a title="Sửa danh mục" href="" style="margin-right: 12px"><i
                                        class="fa-regular fa-pen-to-square" style="color: #0c9636;"></i>
                                    <a title="Xóa danh mục" href="" class="ml-2"><i class="fa-solid fa-trash"
                                            style="color: #E9423F;"></i>
                                    </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $("#myBtn").click(function() {
                $("#myModal").modal();
            });
        });
    </script>
@endsection
