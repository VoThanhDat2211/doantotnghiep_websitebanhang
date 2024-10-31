@extends('admin/layouts/layout')
@section('admin-content')
    <link href="{{ asset('admin/css/customer.css') }}" rel="stylesheet" />

    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Danh Sách Khách Hàng
            </div>

            {{-- TABLE --}}
            @if (isset($customers))
                <div class="table-responsive">
                    <table class="table text-center">
                        <thead>
                            <tr>
                                <th class="text-center">STT</th>
                                <th class="text-center">Username</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Ngày sinh</th>
                                <th class="text-center">Số đơn hàng</th>
                                <th class="text-center">Khóa tài khoản</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customers as $customer)
                                <tr>
                                    <td>{{ ++$increment }}</td>
                                    <td class="max-width: 100px"><span
                                            class="text-ellipsis">{{ $customer->username }}</span>
                                    </td>
                                    <td><span class="text-ellipsis">{{ $customer->email }}</span></td>
                                    <td><span class="text-ellipsis">{{ $customer->birthday->format('d-m-Y') }}</span></td>
                                    <td>{{ $customer->orders()->count() }}</td>
                                    <td>
                                        <form action="{{ route('admin-lock-account', ['id' => $customer->id]) }}"
                                            method="POST" style="display:inline; margin-right: 12px;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" title="Khóa tài khoản" class="btn-delete"
                                                style="border: none; background: none; cursor: pointer; padding:0;">
                                                <i class="fa-solid fa-lock" style="color: #E9423F;"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $customers->links() }}
                </div>
            @endif
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $("#myBtn").click(function() {
                $("#myModal").modal();
            });

            $('.btn-delete').on('click', function(e) {
                e.preventDefault();
                var form = $(this).closest('form');

                Swal.fire({
                    text: "Bạn có chắc chắn khóa tài khoản này không?",
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
