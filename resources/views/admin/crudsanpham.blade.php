@extends('admin.layout.headerend')

@section('title', 'Quản Lí Sản Phẩm')

@section('body')

@if(!isset($product))
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper addproduct" id="themsanpham">
    <form action="{{ route('add-product') }}" method="post" class="validation-form" id="addProducts" enctype="multipart/form-data">
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
                                <a class="btn btn-sm bg-gradient-danger text-white m-2" id="delete-all" data-url="#" href="{{url('admin/quanlisanpham')}}">
                                    <i class="fas fa-sign-out-alt mr-2"></i>Thoát
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item"><a href="index.php">Bảng Điều Khiển</a></li>
                            <li class="breadcrumb-item active">Thêm mới sản phẩm</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
                <!-- Default box -->
                <div class="row">
                    <div class="col-xl-8">
                        <div class="card card-primary card-outline text-sm mb-0">
                            <div class="card-header">
                                <h3 class="card-title">Nội dung Product</h3>
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
                                                    <label for="product_name">Tên Sản Phẩm (vi):</label>
                                                    <input type="text" class="form-control for-seo text-sm @error('product_name') is-invalid @enderror" name="product_name" id="product_name" placeholder="Tên Sản Phẩm" value="" required>
                                                    @error('product_name')
                                                        <div class="invalid-feedback">{{ $errors->first('product_name') }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="product_desc">Nội dung (vi):</label>
                                                    <textarea name="product_desc" id="product_desc" cols="10" rows="80" placeholder="Nội Dung"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>  
                        <div class="card card-primary card-outline text-sm mb-0">
                            <div class="card-header">
                                <h3 class="card-title">Bộ sưu tập Product</h3>
                            </div>
                            <!-- card-body table-responsive p-0 -->
                            <div class="card-body">
                                <!-- Album ảnh -->
                                <div class="form-group">
                                    <input type="file" name="images[]" id="filer_input2" multiple="multiple">
                                </div>
                            </div>
                        </div>  
                    </div>
                    <div class="col-xl-4">
                        <div class="card card-primary card-outline text-sm">
                            <div class="card-header">
                                <h3 class="card-title"></h3> Product</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group-category row">
                                    <div class="form-group col-xl-12 col-sm-12">
                                        <label class="d-block" for="cate_id">Danh mục cấp 1:</label>
                                        <select id="cate_id" name="cate_id" data-level="0" data-type="product" 
                                            class="form-control select2 select-category select2-hidden-accessible" aria-hidden="true" required>
                                            <option value="" >Chọn danh mục</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->cate_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mr-2">
                                        <label for="product_price">Giá Sản Phẩm :</label>
                                        <input type="text" class="form-control for-seo text-sm" name="product_price" id="product_price"  value="0" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="discount_percent">Giảm Giá (%) :</label>
                                        <input type="text" class="form-control for-seo text-sm" name="discount_percent" id="discount_percent"  value="0" required>
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

@else
<div class="content-wrapper editproduct" id="suasanpham">
    <form action="{{route('updateProducts')}}" method="post" class="validation-form" id="editProducts" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product->id }}">
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
                                <a class="btn btn-sm bg-gradient-danger text-white m-2" id="delete-all" data-url="#" href="{{url('admin/quanlisanpham')}}">
                                    <i class="fas fa-sign-out-alt mr-2"></i>Thoát
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item"><a href="index.php">Bảng Điều Khiển</a></li>
                            <li class="breadcrumb-item active">Sửa sản phẩm</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
                <!-- Default box -->
                <div class="row">
                    <div class="col-xl-8">
                        <div class="card card-primary card-outline text-sm mb-0">
                            <div class="card-header">
                                <h3 class="card-title">Nội dung Product</h3>
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
                                                    <label for="product_name">Tên Sản Phẩm (vi):</label>
                                                    <input type="text" class="form-control for-seo text-sm @error('product_name') is-invalid @enderror" name="product_name" id="product_name" placeholder="Tên Sản Phẩm" value="{{$product->name}}" required>
                                                    @error('product_name')
                                                        <div class="invalid-feedback">{{ $errors->first('product_name') }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="product_desc">Nội dung (vi):</label>
                                                    <textarea name="product_desc" id="product_desc" cols="10" rows="80" placeholder="Nội Dung">{{$product->description}}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>  
                        <div class="card card-primary card-outline text-sm mb-0">
                            <div class="card-header">
                                <h3 class="card-title">Bộ sưu tập Product</h3>
                            </div>
                            <!-- card-body table-responsive p-0 -->
                            <div class="card-body">
                                <!-- Album ảnh -->
                                <div class="form-group">
                                    <div id="product-data" data-product='@json($product->images)' style="display: none;"></div>

                                    <input type="file" name="images[]" id="filer_input2" data-laravel-id="{{$product->id}}" multiple="multiple">
                                    @if ($errors->has('images'))
                                        <span id="searchError" class="d-block alert text-danger" >{{ $errors->first('images') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>      
                    </div>
                    <div class="col-xl-4">
                        <div class="card card-primary card-outline text-sm">
                            <div class="card-header">
                                <h3 class="card-title">Danh mục Product</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group-category row">
                                    <div class="form-group col-xl-12 col-sm-12">
                                        <label class="d-block" for="cate_id">Danh mục cấp 1:</label>
                                        <select id="cate_id" name="cate_id" data-level="0" data-type="product" 
                                            class="form-control select2 select-category select2-hidden-accessible" aria-hidden="true" required>
                                            <option value="" >Chọn danh mục</option>
                                            @foreach($categories as $item)
                                                @if($item->id == $product->cate_id)
                                                    <option selected value ="{{ $item->id}}">{{$item->cate_name}}</option>
                                                @else
                                                    <option value ="{{ $item->id}}">{{$item->cate_name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mr-2">
                                        <label for="product_price">Giá Sản Phẩm (vnd):</label>
                                        <input type="text" class="form-control for-seo text-sm" name="product_price" id="product_price"  value="{{$product->price}}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="discount_percent">Giảm Giá (%) :</label>
                                        <input type="text" class="form-control for-seo text-sm" name="discount_percent" id="discount_percent"  value="{{$product->discount_percent}}" required>
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
<script src="{{ asset('admin/dist/js/filterjs/custom.js')}}" type="text/javascript"></script>
<!-- Tạo thư viện classEditor -->
<script>
    ClassicEditor
        .create(document.querySelector('#product_desc'), {
            autoParagraph: false,
            enterMode: 2, // Tùy chọn này cũng giúp ngăn chặn thẻ <p> được thêm tự động
            // shiftEnterMode: CKEDITOR.ENTER_BR
        })
        .catch(error => {
            console.error(error);
        });
</script>

@endsection