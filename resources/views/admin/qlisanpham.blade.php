@extends('admin.layout.headerend')

@section('title', 'Quản Lí Sản Phẩm')

@section('body')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper qlisanpham" id="qlisanpham">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <form action="{{route('productsAdmin.show')}}" method="GET" id="news_search" >
                    <div class="row mb-2">
                        <div class=" col-md-12 ">
                            <h1>Quản Lí</h1>
                            <div class="row">
                                <div class="d-flex">
                                    <a class="btn btn-sm bg-gradient-primary text-white m-2" href="/admin/quanlisanpham/create"
                                        title="Thêm mới">
                                        <i class="fas fa-plus mr-2">
                                        </i>Thêm mới
                                    </a>
                                    <a class="btn btn-sm bg-gradient-danger text-white m-2" id="delete-all" data-url="#"
                                        title="Xóa tất cả">
                                        <i class="far fa-trash-alt mr-2"></i>Xóa tất cả
                                    </a>
                                </div>
                                <div class="form-inline form-search d-inline-block align-middle col-lg-3 w-100  mt-2 mb-2">
                                        <div class="input-group input-group-sm">
                                            @csrf
                                            <input class="form-control form-control-navbar text-sm" type="search" name="keyword" id="keyword" placeholder="Tìm kiếm" aria-label="Tìm kiếm" >
                                            <div class="input-group-append bg-primary rounded-right">
                                                <button class="btn btn-navbar text-white" type="button" id="search-button" >
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                            <span id="searchError" class="d-none alert alert-danger" style="position: absolute;z-index: 1;width: 100%;transform: translateY(50%);opacity: 0.8;">Please enter your title</span>
                                        </div>      
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <ol class="breadcrumb float-sm-left">
                                    <li class="breadcrumb-item"><a href="/admin">Bảng Điều Khiển</a></li>
                                    <li class="breadcrumb-item active">Quản lí Sản Phẩm</li>
                                </ol>
                            </div>
                        </div>
                        <!-- Danh mục -->
                        <div class="card-footer form-group-category text-sm bg-light row">
                            <div class="form-group col-xl-2 col-lg-3 col-md-4 col-sm-4 mb-2">
                                <select id="categorySelect" name="cate_id" 
                                class="form-control filter-category select2 select2-hidden-accessible" data-select2-id="cate_id"
                                tabindex="-1" aria-hidden="true">
                                @isset($categories)
                                <option value="0" >Chọn danh mục</option>
                                @foreach ($categories as $category)
                                <option {{ request('cate_id') == $category->id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->cate_name }}</option>
                                @endforeach
                                @endisset
                            </select>
                        </div>
                    </div>
                    <!-- Danh mục  -->
                </form>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="container-fluid content">
            <!-- Default box -->
            <div class="card card-primary card-outline text-sm mb-0">
                <div class="card-header">
                    <h3 class="card-title">Danh Sách sản phẩm </h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>

                @if($productsList->count() > 0)
                    <div class="card-body table-responsive p-0">
                    <form action="{{route('deleteProducts')}}" method="get" id="delete-form">
                        @csrf
                        <input type="hidden" name="delete_type" id="delete_type" value="single">
                        <div class="card-body  p-0">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th class="align-middle" style="width: 5%;">
                                            <div class="custom-control custom-checkbox my-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="selectall-checkboxsanpham">
                                                <label for="selectall-checkboxsanpham" class="custom-control-label"></label>
                                            </div>
                                        </th>
                                        <th class="align-middle text-center" style="width: 10%;">STT</th>
                                        <th class="align-middle text-center">Ảnh</th>
                                        <th class="align-middle text-center" style="width: 30%;">Tên SP</th>
                                        <th class="align-middle text-center" style="width: 20%;">Danh mục</th>
                                        <th class="align-middle text-center">Nổi Bật</th>
                                        <th class="align-middle text-center">Thao Tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- Duyệt và hiển thị ra danh sách sản phẩm xuống bảng sản phẩm  --}}
                                    @foreach ($productsList as $product)
                                        <tr>
                                            <td class="align-middle">
                                                <div class="custom-control custom-checkbox my-checkbox">
                                                    <input type="checkbox" class="custom-control-input select-checkbox" name="selected_ids[]" id="select-checkbox-{{$product->id}}" value="{{$product->id}}">
                                                    <label for="select-checkbox-{{$product->id}}" class="custom-control-label"></label>
                                                </div>
                                            </td>
                                            <td class="align-middle">
                                                <p class="text-center m-1">{{ $loop->index + 1 }}</p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <a href="{{route('admin_view_product',['id' => $product->id])}} ">
                                                    <img class="rounded img-preview"
                                                        src="{{ asset('front/public/image/' . $product->images->first()->file_name) }}"
                                                        alt="Ảnh sản phẩm" style="max-width: 70px; max-height: 55px;"> </a>
                                            </td>
                                            <td class="align-middle">
                                                <a class="text-dark text-break" href="{{route('admin_view_product',['id' => $product->id])}}">{{ $product->name }}</a>
                                            </td>
                                            <td class="align-middle">
                                                <p class="text-center">{{ $product->category->cate_name }}</p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <div class="custom-control custom-checkbox my-checkbox">
                                                    <input type="checkbox" class="custom-control-input show-checkbox" id="show-checkbox-noibat-{{$product->id}}"
                                                        data-table="product_list" data-id="{{$product->id}}" data-attr="noibat" {{ $product->noi_bat ? 'checked' : '' }}
                                                        onchange="updateNoiBat({{$product->id}})" >
                                                    <label for="show-checkbox-noibat-{{$product->id}}" class="custom-control-label"></label>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center text-md text-nowrap">
                                                <a class="text-primary mr-2" href="{{route('admin_view_product',['id' => $product->id])}}"
                                                    title="Chỉnh sửa"><i class="fas fa-edit"></i></a>
                                                <a class="text-danger" id="delete-item" href="{{route('deleteProductbyId',['id' => $product->id ])}}"  title="Xóa"><i
                                                        class="fas fa-trash-alt" onclick="confirmDelete(event)"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- Hiển thị phân trang -->
                    <div class="pagination justify-content-center">
                        {{$productsList->appends(request()->query())->links('pagination::bootstrap-4')}}
                    </div>
                @else
                    <div class="alert alert-warning w-100 text-center" role="alert">
                        <strong>Products not found</strong>
                    </div>
                @endif
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>


    <!-- Modal xóa tất cả -->
    <div class="modal" id="confirmationModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Xác nhận xóa tất cả?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Bạn có chắc chắn muốn xóa tất cả các sản phẩm đã được chọn không?
                </div>
                <div class="modal-footer">
                    <button id="confirmDelete" type="button" class="btn btn-danger">Yes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>


    @if(session('success'))
    <div class="modal" id="successModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-success">Xóa Thành Công</h5>
                </div>
                <div class="modal-footer justify-content-center">
                    <button id="confirmDelete" type="button" class="btn btn-success" data-dismiss="modal" onclick="closeModal()">OK</button>
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection

@section('javascript')
<script src="{{ asset('admin/dist/js/quanli.js')}}"></script>
    <script>
        // chọn tất cả chekbox
        $(document).ready(function() {
            $('#selectall-checkboxsanpham').change(function() {
                $('.select-checkbox').prop('checked', this.checked);

                if (this.checked) {
                    $('#delete_type').val('all');
                } else {
                    $('#delete_type').val('single');
                }
            });

            $('.select-checkbox').change(function() {
                // huy click đi
                $('#selectall-checkboxsanpham').prop('checked', false);

                if ($('.select-checkbox:checked').length > 1) {
                    $('#delete_type').val('multiple');
                } else {
                    $('#delete_type').val('single');
                }    
            });
        });

        // Đặt sự kiện khi nút "Xóa tất cả" được nhấp
        $('#confirmDelete').click(function() {
            // Kiểm tra xem có ít nhất một checkbox nào đó được chọn không
            if ($('.select-checkbox:checked').length > 0) {
                // Gửi biểu mẫu để xử lý xóa
                $('#delete-form').submit();
            } else {
                alert('Vui lòng chọn ít nhất một sản phẩm để xóa.');
            }
        });


        // thay đổi url bằng javascript
        
        document.addEventListener("DOMContentLoaded", function() {
            var categorySelect = document.getElementById('categorySelect');
            var form = document.getElementById('news_search');
            var search_button = document.getElementById('search-button');

            // Lắng nghe sự kiện thay đổi giá trị trong dropdown danh mục
            categorySelect.addEventListener('change', function() {
                form.submit();
            });
            search_button.addEventListener('click', function() {
                const inputsearch = document.getElementById('keyword').value;
                if(inputsearch != ''){
                    form.submit();
                }else{
                    document.getElementById('searchError').style.setProperty('display', 'block', 'important');
                    
                }
            });
        });
        function updateNoiBat(productId) {
            var isChecked = $('#show-checkbox-noibat-' + productId).prop('checked');
            $.ajax({
                url: '/admin/quanlisanpham/san-pham-' + productId + '/update-noibat',
                type: 'get',
                data: {
                    _token: '{{ csrf_token() }}',
                    noi_bat: isChecked
                },
                success: function (response) {
                    console.log(response    );
                    // Có thể thêm các xử lý khác sau khi cập nhật thành công
                    
                },
                error: function (error) {
                    console.log('Có lỗi xảy ra: ' + error.statusText);
                    // Xử lý lỗi nếu cần thiết
                }
            });
        }

        function confirmDelete(event) {
            event.preventDefault();
            if (confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')) {
                var deleteUrl = event.target.parentElement.href;
                window.location.href = deleteUrl;
            }
        }
    </script>
@endsection
