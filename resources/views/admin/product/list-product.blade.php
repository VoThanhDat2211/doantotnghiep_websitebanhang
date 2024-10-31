@extends('admin/layouts/layout')
@section('admin-content')
    <link href="{{ asset('admin/css/product.css') }}" rel="stylesheet" />

    <div class="redirect-common text-end">
        <a href="{{ route('admin-product-form-create') }}" class="btn btn-primary link-redirect-common"><i
                class="fa-solid fa-circle-plus"></i> THÊM SẢN PHẨM</a>
    </div>
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Danh Sách Sản Phẩm
            </div>
            {{-- TABLE --}}
            @if (isset($products))
                <div class="table-responsive">
                    <table class="table text-center">
                        <thead>
                            <tr>
                                <th class="text-center">STT</th>
                                <th class="text-center">Tên sản phẩm</th>
                                <th class="text-center">Danh mục</th>
                                <th class="text-center">Số lượng đã bán</th>
                                <th class="text-center">Số lượng còn lại</th>
                                <th class="text-center">Giá(đ)</th>
                                <th class="text-center">Giảm giá(%)</th>
                                <th class="text-center" style="">Tùy Chọn</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ ++$increment }}</td>
                                    <td class="max-width: 100px"><span class="text-ellipsis">{{ $product->name }}</span>
                                    </td>
                                    <td><span class="text-ellipsis">{{ $product->category->name }}</span></td>
                                    <td><span class="text-ellipsis">{{ $product->sold_quantity }}</span></td>
                                    <td><span class="text-ellipsis">{{ $product->remain_quantity }}</span></td>
                                    <td><span class="text-ellipsis">{{ number_format($product->price, 0, ',', '.') }}</span>
                                    </td>
                                    <td><span class="text-ellipsis">{{ $product->discount }}</span></td>
                                    <td>
                                        <a title="Sửa sản phẩm"
                                            href="{{ route('admin-product-form-update', ['id' => $product->id]) }}"
                                            style="margin-right: 12px"><i class="fa-regular fa-pen-to-square"
                                                style="color: #0c9636;"></i>
                                        </a>
                                        <form action="{{ route('admin-product-delete', ['id' => $product->id]) }}"
                                            method="POST" style="display:inline; margin-right: 12px;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" title="Xóa sản phẩm" class="btn-delete"
                                                style="border: none; background: none; cursor: pointer; padding:0;">
                                                <i class="fa-solid fa-trash" style="color: #E9423F;"></i>
                                            </button>
                                        </form>
                                        <a title="Biến thể sản phẩm"
                                            href="{{ route('admin-product-variant-list', ['id' => $product->id]) }}"
                                            class="ml-2" style="margin-right: 12px"><i
                                                class="fa-solid fa-circle-info"></i>
                                        </a>
                                        <a title="Hình ảnh"
                                            href="{{ route('admin-product-image', ['id' => $product->id]) }}"
                                            class="ml-2"><i class="fa-solid fa-image" class="fa-solid fa-trash"
                                                style="color: #b1720d;"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $products->links() }}
                </div>
            @endif
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $("#myBtn").click(function() {
                $("#myModal").modal();
            });


        });
        $(document).ready(function() {
            $('.btn-delete').on('click', function(e) {
                e.preventDefault();
                var form = $(this).closest('form');

                Swal.fire({
                    text: "Bạn có chắc chắn xóa sản phẩm này?",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Xác Nhận',
                    cancelButtonText: 'Hủy'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endsection
