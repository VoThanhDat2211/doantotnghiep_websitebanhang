@extends('admin/layouts/layout')
@section('admin-content')
    <link href="{{ asset('admin/css/customer.css') }}" rel="stylesheet" />
    </style>
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Danh Sách Đơn Hàng
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
            @if (isset($orderLines))
                <div class="table-responsive">
                    <table class="table text-center">
                        <thead>
                            <tr>
                                <th class="text-center">STT</th>
                                <th class="text-center">Tên sản phẩm</th>
                                <th class="text-center">Loại</th>
                                <th class="text-center">Số lượng</th>
                                <th class="text-center">Đơn giá(đ)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orderLines as $orderLine)
                                <tr>
                                    <td>{{ ++$increment }}</td>
                                    <td class="max-width: 100px"><span
                                            class="text-ellipsis">{{ $orderLine->productVariant->product->name }}</span>
                                    </td>
                                    <td><span class="text-ellipsis">{{ $orderLine->productVariant->color }},
                                            {{ $orderLine->productVariant->size }}</span></td>
                                    <td><span class="text-ellipsis">{{ $orderLine->quantity }}</span></td>
                                    <td><span
                                            class="text-ellipsis">{{ number_format($orderLine->price, 0, ',', '.') }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.btn-update-confirm').on('click', function(e) {
                e.preventDefault();
                var form = $(this).closest('form');

                Swal.fire({
                    title: 'Xác nhận đơn hàng',
                    text: "Bạn có chắc chắn xác nhận đơn hàng này?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Xác nhận',
                    cancelButtonText: 'Hủy'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });

            $('.btn-update-ship').on('click', function(e) {
                e.preventDefault();
                var form = $(this).closest('form');

                Swal.fire({
                    title: 'Chuyển trạng thái đơn hàng',
                    text: "Bạn có chắc chắn muốn chuyển trạng thái đơn hàng sang đang giao hàng không?",
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
