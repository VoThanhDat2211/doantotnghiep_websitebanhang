@extends('admin/layouts/layout')
@section('admin-content')
    <link href="{{ asset('admin/css/customer.css') }}" rel="stylesheet" />

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
            @if ($orders)
                <div class="table-responsive">
                    <table class="table text-center">
                        <thead>
                            <tr>
                                <th class="text-center">STT</th>
                                <th class="text-center">Mã Đơn Hàng</th>
                                <th class="text-center">Tên Khách Hàng</th>
                                <th class="text-center">Tổng Đơn(đ)</th>
                                <th class="text-center">Ngày Đặt</th>
                                <th class="text-center">Trạng Thái</th>
                                <th class="text-center">Tùy chọn</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ ++$increment }}</td>
                                     <td><span class="text-ellipsis">{{ $order->order_code }}</span></td>
                                    <td class="max-width: 100px"><span class="text-ellipsis">{{ $order->customer->username }}</span>
                                    </td>
                                    <td><span class="text-ellipsis">{{ $order->total_amount }}</span></td>
                                    <td><span class="text-ellipsis">{{ $order->created_at }}</span></td>
                                    <td><span class="text-ellipsis">{{ $order->status }}</span></td>
                                    <td>1</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                  {{ $orders->links('pagination::tailwind') }}
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
                var confirmed = confirm("Bạn có chắc chắn muốn xóa sản phẩm này?");
                if (confirmed) {
                    $(this).closest('form').submit();
                }
            });
        });
    </script>
@endsection
