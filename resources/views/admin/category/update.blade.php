@extends('admin.layout.master')

@section('title', 'Chỉnh Sửa Danh Mục')

@section('body')
@if(isset($cate))
    <div class="content-wrapper editdanhmuc" id="editdanhmuc">
        <form action="{{ route('admin-updateCate',['id' => $cate->id ]) }}" method="post" class="validation-form" id="edirCate" enctype="multipart/form-data">
        @csrf
        @method('patch')
            <!-- Content Header (Page header) -->
            <section class="content-header ">
                <div class="container-fluid">
                    <div class="row mb-2 ">
                        <div class=" col-md-12 ">
                            <h1>Quản Lí</h1>
                            <div class="row">
                                <div class="d-flex">
                                    <button class="btn btn-sm bg-gradient-primary text-white m-2"  title="Thêm mới" >
                                        <i class="fas fa-save mr-2">
                                        </i>Lưu
                                    </button>
                                    <a class="btn btn-sm bg-gradient-danger text-white m-2" id="delete-all" href="{{url('admin/quanlidanhmuc')}}" title="Xóa tất cả">
                                        <i class="fas fa-sign-out-alt mr-2"></i>Thoát
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <ol class="breadcrumb float-sm-left">
                                <li class="breadcrumb-item"><a href="index.php">Bảng Điều Khiển</a></li>
                                <li class="breadcrumb-item active">Chỉnh Sửa Danh Mục</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                    <!-- Default box -->
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card card-primary card-outline text-sm mb-0">
                                <div class="card-header">
                                    <h3 class="card-title">Nội dung Danh Mục</h3>
                                </div>
                                <!-- card-body table-responsive p-0 -->
                                <div class="card-body ">
                                    
                                    <div class="card card-primary card-outline card-outline-tabs">
                                        <div class="card-header p-0 border-bottom-0">
                                            <ul class="nav nav-tabs" id="custom-tabs-three-tab-lang" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" id="tabs-lang" data-toggle="pill" href="#tabs-lang-vi" role="tab"
                                                        aria-controls="tabs-lang-vi" aria-selected="true">Tiếng Việt</a>
                                                </li>                
                                            </ul>
                                        </div>
                                        <div class="card-body card-article">
                                            <div class="tab-content" id="custom-tabs-three-tabContent-lang">
                                                <div class="tab-pane fade show active" id="tabs-lang-vi" role="tabpanel" aria-labelledby="tabs-lang">
                                                    <div class="form-group">
                                                        <label for="slug">Đường dẫn mẫu (vi): </label>
                                                        <input type="text" class="form-control for-seo text-sm  @error('slug') is-invalid @enderror" 
                                                        name="slug" id="slug" placeholder="Đường dẫn" readonly value="{{ $cate->slug }}">
                                                        @error('slug')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="cate_name_vi">Tên Danh Mục (vi):</label>
                                                        <input type="text" class="form-control for-seo text-sm  @error('cate_name_vi') is-invalid @enderror" 
                                                        name="cate_name_vi" id="cate_name_vi" placeholder="Tên Danh Mục (vi)" value="{{ $cate->cate_name }}">
                                                        @error('cate_name_vi')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
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
        </form>
        <!-- /.content -->
    </div>  
@endif

@endsection

@section('javascript')
<script src="{{ asset('admin/dist/js/slug.js')}}"></script>
<script>
$(document).ready(function() {
    @if (session('success'))
        toastr.success("{{ session('success') }}");
    @endif
    
    @if (session('error'))
        alert("{{ session('error') }}");
    @endif
});

document.addEventListener("DOMContentLoaded", () => {
    autoUpdateSlug("#cate_name_vi", "#slug"); // Gắn với các input cụ thể
});
</script>

@endsection