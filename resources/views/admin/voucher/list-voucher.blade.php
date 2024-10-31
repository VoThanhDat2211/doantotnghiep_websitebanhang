@extends('admin/layouts/layout')
@section('admin-content')
    <link href="{{ asset('admin/css/product.css') }}" rel="stylesheet" />

    <div class="redirect-common text-end">
        <a href="{{ route('admin-voucher-form-create') }}" class="btn btn-primary link-redirect-common"><i
                class="fa-solid fa-circle-plus"></i> THÊM VOUCHER</a>
    </div>
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Danh Sách Voucher
            </div>
            {{-- TABLE --}}
            @if (isset($vouchers))
                <div class="table-responsive">
                    <table class="table text-center">
                        <thead>
                            <tr>
                                <th class="text-center">STT</th>
                                <th class="text-center">Mã voucher</th>
                                <th class="text-center">Loại voucher</th>
                                <th class="text-center">Số lượng</th>
                                <th class="text-center">Số lượng còn lại</th>
                                <th class="text-center">Giá trị voucher(%)</th>
                                <th class="text-center">Thời gian áp dụng</th>
                                <th class="text-center" style="">Tùy Chọn</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($vouchers as $voucher)
                                <tr>
                                    <td>{{ ++$increment }}</td>
                                    <td class="max-width: 100px"><span
                                            class="text-ellipsis">{{ $voucher->voucher_code }}</span>
                                    </td>
                                    <td><span class="text-ellipsis">{{ $voucherTypeArray[$voucher->voucher_type] }}</span>
                                    </td>
                                    <td><span class="text-ellipsis">{{ $voucher->quantity }}</span></td>
                                    <td><span class="text-ellipsis">{{ $voucher->remain_quantity }}</span></td>
                                    <td><span class="text-ellipsis">{{ $voucher->value }}</span></td>
                                    <td><span class="text-ellipsis">{{ $voucher->start_date->format('d/m/Y') }} <span> --
                                            </span>
                                            {{ $voucher->end_date->format('d/m/Y') }}</span></td>
                                    <td>
                                        <form action="{{ route('admin-voucher-delete', ['id' => $voucher->id]) }}"
                                            method="POST" style="display:inline; margin-right: 12px;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" title="Xóa voucher" class="btn-delete"
                                                style="border: none; background: none; cursor: pointer; padding:0;">
                                                <i class="fa-solid fa-trash" style="color: #E9423F;"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $vouchers->links() }}
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
                    text: "Bạn có chắc chắn xóa voucher này?",
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
