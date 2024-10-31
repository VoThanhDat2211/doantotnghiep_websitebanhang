@extends('admin/layouts/layout')
@section('admin-content')
    @php
        use App\Enums\CategoryParentEnum;
    @endphp
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
            {{-- TABLE --}}
            <div class="table-responsive">
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th class="text-center">STT</th>
                            <th class="text-center">Tên Danh Mục</th>
                            <th class="text-center">Thể Loại</th>
                            <th class="text-center" style="">Tùy Chọn</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($categories))
                            @foreach ($categories as $category)
                                <tr>
                                    <td>{{ ++$increment }}</td>
                                    <td class="max-width: 100px"><span class="text-ellipsis">{{ $category->name }}</span>
                                    </td>
                                    <td>
                                        @if (!empty($categoryParents))
                                            @foreach ($categoryParents as $categoryParent)
                                                @if ($categoryParent->value == $category->parent_category)
                                                    <span
                                                        class="text-ellipsis">{{ CategoryParentEnum::getStatusText($categoryParent->value) }}</span>
                                                @endif
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>
                                        <a title="Sửa danh mục"
                                            href="{{ route('admin-category-form-update', ['id' => $category->id]) }}"
                                            style="margin-right: 12px"><i class="fa-regular fa-pen-to-square"
                                                style="color: #0c9636;"></i>
                                        </a>
                                        <form action="{{ route('admin-category-delete', ['id' => $category->id]) }}"
                                            method="POST" style="display:inline; margin-right: 12px;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" title="Xóa danh mục" class="btn-delete"
                                                style="border: none; background: none; cursor: pointer; padding:0;">
                                                <i class="fa-solid fa-trash" style="color: #E9423F;"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
                {{ $categories->links() }}
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.btn-delete').on('click', function(e) {
                e.preventDefault();
                var form = $(this).closest('form');

                Swal.fire({
                    text: "Bạn có chắc chắn xóa danh mục này?",
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
