@extends('admin.layout.master')

@section('title', 'Quản Lí Nhận Tin')

@section('body')

<!-- difference here  Body -->
<div class="content-wrapper qlitintuc" id="qlitintuc">
        <!-- Content Header (Page header) -->
        <section class="content-header ">
            <div class="container-fluid">
                <div class="row mb-2 ">
                    <div class=" col-md-12 ">
                        <h1>Quản Lí</h1>
                        <div class="row">
                            <div class="d-flex">
                                <a class="btn btn-sm bg-success text-white m-2" id="send-all" title="sendmail">
                                    <i class="fas fa-paper-plane mr-2">
                                    </i>Gửi Email
                                </a>
                                <!-- <a class="btn btn-sm bg-gradient-primary text-white m-2" href="#" title="Thêm mới">
                                    <i class="fas fa-plus mr-2">
                                    </i>Thêm mới
                                </a> -->
                                <a class="btn btn-sm bg-gradient-danger text-white m-2" id="delete-all" data-url="#" title="Xóa tất cả">
                                    <i class="far fa-trash-alt mr-2"></i>Xóa tất cả
                                </a>
                            </div>
                            <!-- <div class="form-inline form-search d-inline-block align-middle col-lg-3 w-100  mt-2 mb-2">
                                <div class="input-group input-group-sm">
                                    <input class="form-control form-control-navbar text-sm" type="search" id="keyword" placeholder="Tìm kiếm" aria-label="Tìm kiếm" value="" onkeypress="">
                                    <div class="input-group-append bg-primary rounded-right">
                                        <button class="btn btn-navbar text-white" type="button" onclick="">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </div>
                    <div class="col-md-12">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item"><a href="#">Bảng Điều Khiển</a></li>
                            <li class="breadcrumb-item active">Quản Lí Nhận Tin</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
    <form method="post" id="delete-form">
    @csrf
        <section class="content">
            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Danh Sách Người Gửi</h3>

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
                        <div class="card-body table-responsive p-0">
                            @if($cusList->count() > 0)
                            <table class="w-100 table table-hover table-bordered table-resizable ">
                                <thead> 
                                    <tr>
                                        <th class="align-middle" style="width: 5%;">
                                            <div class="custom-control custom-checkbox my-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="selectall-checkboxnhantin">
                                                <label for="selectall-checkboxnhantin" class="custom-control-label"></label>
                                            </div>
                                        </th>
                                        <th class="align-middle text-center">STT</th>
                                        <th class="align-middle text-center" style="min-width: 200px;" >Tên</th>
                                        <th class="align-middle text-center">Email</th>
                                        <th class="align-middle text-center">Số Điện Thoại</th>
                                        <th class="align-middle text-center" style="min-width: 200px;">Nội dung</th>
                                        <th class="align-middle text-center">Ngày Gửi</th>
                                        <th class="align-middle text-center">Thao Tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cusList as $item)
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
                                            {{$item->name}}
                                        </td>
                                        <td class="align-middle text-center">
                                            {{$item->email}}
                                        </td>
                                        <td class="align-middle text-center">
                                            {{$item->phone}}
                                        </td>
                                        <td class="align-middle text-center">
                                            @if($item->content != null)
                                                {{$item->content}}
                                            @else
                                                Chưa có
                                            @endif
                                        </td>
                                        <td class="align-middle text-center">
                                            @if($item->created_at != null)
                                            {{$item->created_at->format('d-m-Y')}} 
                                            @else
                                                Chưa cập nhật
                                            @endif
                                        </td>
                                        <td class="align-middle text-center text-md text-nowrap">
                                            <a class="text-danger" id="delete-item" href="{{ route('deleteNewsletterbyId',['id' => $item->id ]) }}"  title="Xóa"><i
                                                    class="fas fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="pagination justify-content-center">
                                {{$cusList->appends(request()->query())->links('pagination::bootstrap-4')}}
                            </div>
                            @else
                            <div class="alert alert-warning w-100 text-center" role="alert">
                                <strong>No Customer </strong>
                            </div>  
                            @endif
                        </div>
                </div>
            <!-- /.card-body -->
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->

        <!-- Main content -->
        <section class="content">
                <!-- Default box -->
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card card-primary card-outline text-sm mb-0">
                            <div class="card-header">
                                <h3 class="card-title">Gửi Email đến danh sách được chọn</h3>
                            </div>
                            <!-- card-body table-responsive p-0 -->
                            <div class="card-body ">
                                
                                <div class="card card-primary card-outline card-outline-tabs">
                                    <div class="card-body card-article">
                                        <div class="tab-content" id="custom-tabs-three-tabContent-lang">
                                            <div class="tab-pane fade show active" id="tabs-lang-vi" role="tabpanel" aria-labelledby="tabs-lang">
                                                <div class="form-group">
                                                    <label for="title_email">Tiêu đề :</label>
                                                    <input type="text" class="form-control for-seo text-sm" name="title_email" id="title_email" placeholder="Tiêu đề"  required>
                                                    <span id="titleError" class="d-block alert text-danger"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label for="content_email">Nội dung cần gửi:</label>
                                                    <input type="text" class="form-control for-seo text-sm" name="content_email" id="content_email" placeholder="Nội Dung">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>  
                    </div>
                </div>
                
                <!-- /.card -->
        </section>
        <!-- /.content -->
    </form>
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
                    Bạn có chắc chắn muốn xóa tất cả các bài viết không?
                </div>
                <div class="modal-footer">
                    <button id="confirmDelete" type="button" class="btn btn-danger">Yes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal send mail -->
    <div class="modal" id="confirmationModalsend" tabindex="-2">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Xác nhận gửi mail?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Bạn có chắc chắn muốn gửi đến các khách hàng đã chọn không?
                </div>
                <div class="modal-footer">
                    <button id="confirmSend" type="button" class="btn btn-danger">Yes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
<script>
    $(document).ready(function() {
        @if (session('success'))
            toastr.success("{{ session('success') }}");
        @endif
        
        @if (session('error'))
            alert("{{ session('error') }}");
        @endif
    });
</script>
    <script src="{{ asset('admin/dist/js/quanli.js')}}"></script>
    <script src="{{ asset('admin/dist/js/quanlinhantin.js')}}"></script>
@endsection