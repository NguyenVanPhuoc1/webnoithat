@extends('admin.layout.master')

@section('title', 'Quản Lí Chính Sách')

@section('body')
<!-- difference here  Body -->
<div class="content-wrapper qlichinhsach" id="qlichinhsach">
    <!-- Content Header (Page header) -->
    <section class="content-header ">
        <div class="container-fluid">
            <div class="row mb-2 ">
                <div class=" col-md-12 ">
                    <h1>Quản Lí</h1>
                    <div class="row">
                        <div class="d-flex">
                            <a class="btn btn-sm bg-gradient-primary text-white m-2" href="{{ route('view_add_poli') }}" title="Thêm mới">
                                <i class="fas fa-plus mr-2">
                                </i>Thêm mới
                            </a>
                            <button class="btn btn-sm bg-gradient-danger text-white m-2" type="button" id="delete-all" data-url="#" title="Xóa tất cả">
                                <i class="far fa-trash-alt mr-2"></i>Xóa tất cả
                            </button>
                        </div>
                        <div class="form-inline form-search d-inline-block align-middle col-lg-3 w-100  mt-2 mb-2">
                            <form action="{{route('poli_admin')}}" method="GET" id="poli_search" >
                                <div class="input-group input-group-sm">
                                    @csrf
                                    <input class="form-control form-control-navbar text-sm" type="search" name="keyword" id="keyword" placeholder="Tìm kiếm" aria-label="Tìm kiếm" required >
                                    <div class="input-group-append bg-primary rounded-right">
                                        <button class="btn btn-navbar text-white" type="button" id="search-button" >
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                    <span id="searchError" class="d-none alert alert-danger" style="position: absolute;z-index: 1;width: 100%;transform: translateY(50%);opacity: 0.8;">Please enter your title</span>
                                    @if ($errors->has('keyword'))
                                        <span id="searchError" class="d-block alert alert-danger" style="position: absolute;z-index: 1;width: 100%;transform: translateY(50%);opacity: 0.8;">{{ $errors->first('keyword') }}</span>
                                    @endif
                                </div>      
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="#">Bảng Điều Khiển</a></li>
                        <li class="breadcrumb-item active">Quản Lí Chính Sách</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Danh Sách Chính Sách</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body p-0">
                <form id="delete-form">
                @csrf
                    <div class="m-4 card card-primary card-outline text-sm mb-0">
                        <div class="card-body table-responsive p-0">
                            @if($policysList->count() > 0)
                            <table class="w-100 table table-hover table-bordered table-resizable ">
                                <thead> 
                                    <tr>
                                        <th class="align-middle" style="width: 5%;">
                                            <div class="custom-control custom-checkbox my-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="selectall-checkboxchinhsach">
                                                <label for="selectall-checkboxchinhsach" class="custom-control-label"></label>
                                            </div>
                                        </th>
                                        <th class="align-middle text-center" style="width: 10%;">STT</th>
                                        <th class="align-middle text-center">Hình</th>
                                        <th class="align-middle text-center" style="min-width: 200px;" >Tiêu Đề</th>
                                        <th class="align-middle text-center">Nổi Bật</th>
                                        <th class="align-middle text-center">Thao Tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($policysList as $item)
                                    <tr>
                                        <td class="align-middle">
                                            <div class="custom-control custom-checkbox my-checkbox">
                                                <input type="checkbox" class="custom-control-input select-checkbox" name="selected_ids[]" id="select-checkbox-{{$item->id}}" value="{{$item->id}}">
                                                <label for="select-checkbox-{{$item->id}}" class="custom-control-label"></label>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <!-- biến đếm số thứ tự {{ $loop->index + 1 }}-->
                                            <p class="text-center m-1">{{ $loop->index + 1 }}</p>
                                        </td>
                                        <td class="align-middle text-center">
                                            <a href="" title="Bàn ăn">
                                                <img class="rounded img-preview" src="{{ asset($item -> poli_image)}}" alt="{{$item -> poli_image}}" style="max-width: 70px; max-height: 55px;">                                        </a>
                                        </td>
                                        <td class="align-middle text-center">
                                            <a class="text-dark text-break" href=""
                                                title="{{$item ->poli_name}}">{{$item ->poli_name}}</a>
                                        </td>
                                        <td class="align-middle text-center">
                                            <div class="custom-control custom-checkbox my-checkbox">
                                            <input type="checkbox" class="custom-control-input show-checkbox" id="show-checkbox-noibat-{{$item->id}}"
                                                    data-table="policy_list" data-id="{{$item->id}}" data-attr="noibat" {{ $item->noi_bat ? 'checked' : '' }}
                                                    onchange="updateNoiBat('{{$item->id}}')" >
                                                <label for="show-checkbox-noibat-{{$item->id}}" class="custom-control-label"></label>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center text-md text-nowrap">
                                            <a class="text-primary mr-2" href="{{route('view_update_poli',['id' => $item->id ])}}"
                                                title="Chỉnh sửa"><i class="fas fa-edit"></i></a>
                                            <a class="text-danger" id="delete-item" href="{{route('deletePolibyId',['id' => $item->id ])}}"  title="Xóa"><i
                                                    class="fas fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="pagination justify-content-center">
                                {{$policysList->appends(request()->query())->links('pagination::bootstrap-4')}}
                            </div>
                            @else
                            <div class="alert alert-warning w-100 text-center" role="alert">
                                <strong>Policy  not found</strong>
                            </div>  
                            @endif
                        </div>
                    </div>
                </form>       
            </div>
        <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>
<!-- difference here -->

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
                Bạn có chắc chắn muốn xóa tất cả các bài viết đã được chọn không?
            </div>
            <div class="modal-footer">
                <button id="confirmDelete" type="button" class="btn btn-danger">Yes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>
{{-- <!--   Hiện thông báo  -->
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif --}}

@endsection

@section('javascript')
<script>
    $(document).ready(function() {
        @if (session('success'))
            toastr.success("{{ session('success') }}");
        @endif
    });
    
    </script>
<script src="{{ asset('admin/dist/js/quanli.js')}}"></script>
<script src="{{ asset('admin/dist/js/quanlichinhsach.js')}}"></script>
<script>

function updateNoiBat(slug) {
    var isChecked = $('#show-checkbox-noibat-' + slug).prop('checked');
    $.ajax({
        url: '/admin/quanlibaiviet/chinhsach/update-noibat/' + slug ,
        type: 'post',
        data: {
            _token: '{!! csrf_token() !!}',
            noi_bat: isChecked
        },
        success: function (response) {
            // console.log(response);
            toastr.success(response.success);
            
        },
        error: function (error) {
            console.log('Có lỗi xảy ra: ' + error.statusText);
            // Xử lý lỗi nếu cần thiết
        }
    });
}
</script>
@endsection