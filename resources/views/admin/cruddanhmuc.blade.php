@extends('admin.layout.headerend')

@section('title', 'Quản Lí Danh Mục')

@section('body')
<!-- Content Wrapper. Contains page content -->

@if(!isset($cate))
<!--                                            Thêm Danh Mục                                    -->
    <div class="content-wrapper adddanhmuc" id="adddanhmuc">
        <form action="{{ route('add-cate') }}" method="post" class="validation-form" id="addCate" enctype="multipart/form-data">
        @csrf
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
                                <li class="breadcrumb-item active">Thêm mới Danh Mục</li>
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
                                                        <label for="cate_name">Tên Danh Mục (vi):</label>
                                                        <input type="text" class="form-control for-seo text-sm" name="cate_name" id="cate_name" placeholder="Tên Danh Mục (vi)"  required>
                                                        @if ($errors->has('cate_name'))
                                                            <span id="searchError" class="d-block alert text-danger" >{{ $errors->first('cate_name') }}</span>
                                                        @endif
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
<!--                                            Thêm Danh Mục                                    -->

@else
<!--                                            Sửa Danh Mục                                   -->
    <div class="content-wrapper editdanhmuc" id="editdanhmuc">
        <form action="{{route('admin-updateCate')}}" method="post" class="validation-form" id="updateCate" enctype="multipart/form-data">
        @csrf
            <!-- Content Header (Page header) -->
            <section class="content-header ">
                <div class="container-fluid">
                    <div class="row mb-2 ">
                        <div class=" col-md-12 ">
                            <h1>Quản Lí</h1>
                            <div class="row">
                                <div class="d-flex">
                                    <button class="btn btn-sm bg-gradient-primary text-white m-2"  title="Lưu" >
                                        <i class="fas fa-save mr-2">
                                        </i>Lưu
                                    </button>
                                    <a class="btn btn-sm bg-gradient-danger text-white m-2" id="thoat" href="{{url('admin/quanlidanhmuc')}}" title="Xóa tất cả">
                                        <i class="fas fa-sign-out-alt mr-2"></i>Thoát
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <ol class="breadcrumb float-sm-left">
                                <li class="breadcrumb-item"><a href="index.php">Bảng Điều Khiển</a></li>
                                <li class="breadcrumb-item active">Chi Tiết Danh Mục</li>
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
                                                    <input type="hidden" name="cate_id" value="{{ $cate->id }}">
                                                    <div class="form-group">
                                                        <label for="cate_name">Tên Danh Mục (vi):</label>
                                                        @if(strlen($cate->cate_name) <= 100)
                                                        <input type="text" class="form-control for-seo text-sm" name="cate_name" id="cate_name" placeholder="Tên Tin Tức (vi)" value="{{$cate -> cate_name}}" required>
                                                        @else
                                                        <input type="text" class="form-control for-seo text-sm" value="Tiêu đề không hợp lệ" >
                                                        @endif
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
@endif

@endsection

@section('javascript')
<!-- Tạo thư viện classEditor -->


@endsection