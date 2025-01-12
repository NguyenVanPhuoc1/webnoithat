@extends('admin.layout.master')

@section('title', 'Chỉnh Sửa Sản Phẩm')

@section('body')
<div class="content-wrapper updatesanpham" id="updatesanpham">
    <form action="{{ route('admin-updateProduct',['id' => $product->id ]) }}" method="post" class="validation-form" id="addProduct" enctype="multipart/form-data">
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
                                <a class="btn btn-sm bg-gradient-danger text-white m-2" id="delete-all" href="{{route('product_admin')}}" title="Xóa tất cả">
                                    <i class="fas fa-sign-out-alt mr-2"></i>Thoát
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item"><a href="index.php">Bảng Điều Khiển</a></li>
                            <li class="breadcrumb-item active">Chỉnh Sửa Sản Phẩm</li>
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
                                <h3 class="card-title">Đường Dẫn Sản Phẩm</h3>
                            </div>
                            <!-- card-body table-responsive p-0 -->
                            <div class="card-body ">   
                                <div class="card card-primary card-outline card-outline-tabs">
                                    <div class="card-header p-0 border-bottom-0">
                                        <ul class="nav nav-tabs" id="custom-tabs-three-tab-lang" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link active" id="tabs-lang" data-bs-toggle="tab" data-bs-target="#tabs-lang-slug" type="button"  role="tab"
                                                    aria-controls="tabs-lang-vi" aria-selected="true">Tiếng Việt</a>
                                            </li>          
                                        </ul>
                                        
                                    </div>
                                    <div class="card-body card-article">
                                        <div class="tab-content" id="custom-tabs-three-tabContent-slug">
                                            <div class="tab-pane fade show active" id="slug-tab" role="tabpanel" aria-labelledby="slug-tab">
                                                <div class="form-group">
                                                    <label for="slug">Đường dẫn mẫu (vi): </label>
                                                    <input type="text" class="form-control for-seo text-sm @error('slug') is-invalid @enderror" 
                                                    name="slug" id="slug" placeholder="Đường dẫn" value="{{ $product->slug }}" readonly>
                                                    @error('slug')
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
                        <div class="card card-primary card-outline text-sm mb-0">
                            <div class="card-header">
                                <h3 class="card-title">Nội dung Sản Phẩm</h3>
                            </div>
                            <!-- card-body table-responsive p-0 -->
                            <div class="card-body">
                                <div class="card card-primary card-outline card-outline-tabs">
                                    <div class="card-header p-0 border-bottom-0">
                                        <ul class="nav nav-tabs" id="custom-tabs-three-tab-lang" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link active" id="tabs-lang" data-bs-toggle="tab" data-bs-target="#tabs-lang-vi" type="button"  role="tab"
                                                    aria-controls="tabs-lang-vi" aria-selected="true">Tiếng Việt</a>
                                            </li>    
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link" id="tabs-lang" data-bs-toggle="tab" data-bs-target="#tabs-lang-en" type="button" role="tab"
                                                    aria-controls="tabs-lang-en" aria-selected="false">Tiếng Anh</a>
                                            </li>                
                                        </ul>
                                        
                                    </div>
                                    <div class="card-body card-article">
                                        <div class="tab-content" id="custom-tabs-three-tabContent-lang">
                                            <!-- Tab Tiếng Việt -->
                                            <div class="tab-pane fade show active" id="tabs-lang-vi" role="tabpanel" aria-labelledby="tabs-lang-vi" tabindex="0">
                                                <div class="form-group">
                                                    <label for="product_name_vi">Tên Sản Phẩm (vi):</label>
                                                    <input type="text" class="form-control for-seo text-sm @error('product_name_vi') is-invalid @enderror" 
                                                    name="product_name_vi" id="product_name_vi" placeholder="Tên Sản Phẩm (vi)" value="{{ $product->translate['vi']['name'] }}">
                                                    @error('product_name_vi')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="contentvi">Nội dung (vi):</label>
                                                    <textarea name="contentvi" id="contentvi" cols="10" rows="80">{{ htmlspecialchars_decode($product->translate['vi']['description'], ENT_QUOTES) }}</textarea>
                                                </div>
                                            </div>
                                    
                                            <!-- Tab Tiếng Anh -->
                                            <div class="tab-pane fade" id="tabs-lang-en" role="tabpanel" aria-labelledby="tabs-lang-en" tabindex="0">
                                                <div class="form-group">
                                                    <label for="product_name_en">Tên Sản Phẩm (en):</label>
                                                    <input type="text" class="form-control for-seo text-sm @error('product_name_en') is-invalid @enderror" 
                                                    name="product_name_en" id="product_name_en" placeholder="Tên Sản Phẩm (en)" value="{{ $product->translate['en']['name'] }}">
                                                    @error('product_name_en')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="contenten">Nội dung (en):</label>
                                                    <textarea name="contenten" id="contenten" cols="10" rows="80">{{ htmlspecialchars_decode($product->translate['en']['description'], ENT_QUOTES) }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>  
                    </div>
                    <div class="col-xl-4">
                        <div class="card card-primary card-outline text-sm">
                            <div class="card-header">
                                <h3 class="card-title">Products</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                </div>
                            </div>
                            <div class="card-body ">
                                <div class="form-group-category row">
                                    <div class="form-group ">
                                        <label class="d-block" for="cate_id">Danh mục cấp 1:</label>
                                        <select id="cate_id" name="cate_id" data-level="0" data-type="product" 
                                            class="form-control select2 select-category select2-hidden-accessible" aria-hidden="true" required>
                                            <option value="0" >Chọn danh mục</option>
                                            @foreach($categories as $item)
                                                @if($item->id == $product->category['cate_id'])
                                                    <option selected value ="{{ $item->id}}">{{$item->cate_name}}</option>
                                                @else
                                                    <option value ="{{ $item->id}}">{{$item->cate_name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('cate_id')
                                            <span id="searchError" class="d-block alert text-danger m-0" >{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group mr-2 w-100">
                                        <label for="product_price">Giá Sản Phẩm (Vnd) :</label>
                                        <input type="text" class="form-control for-seo text-sm @error('product_price') is-invalid @enderror" 
                                        name="product_price" id="product_price" value="{{ $product->price }}">
                                        @error('product_price')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group w-100">
                                        <label for="discount_percent">Giảm Giá (%) :</label>
                                        <input type="text" class="form-control for-seo text-sm @error('discount_percent') is-invalid @enderror" 
                                        name="discount_percent" id="discount_percent" value="{{ $product->discount_percent }}">
                                        @error('discount_percent')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
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
                                <div id="product-data" data-product='@json($product->images)' data-productid='@json($product->id)' data-csrf='@json(csrf_token())' style="display: none;"></div>
                                <input type="file" name="files[]" id="filer_input"  data-jfiler-limit="5">
                            </div>
                        </div>
                    </div>  
                </div>
                <!-- /.card -->
        </section>
    </form>
    <!-- /.content -->
</div>  
@endsection

@section('javascript')
<script src="{{ asset('admin/dist/js/slug.js')}}"></script>
<script src="{{ asset('admin/dist/js/filterjs/jquery.filer.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('admin/dist/js/filterjs/custom.js')}}" type="text/javascript"></script>
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
    ClassicEditor
        .create(document.querySelector('#contentvi'), {
            autoParagraph: false
        })
        .catch(error => {
            console.error(error);
        });
    ClassicEditor
        .create(document.querySelector('#contenten'), {
            autoParagraph: false
        })
        .catch(error => {
            console.error(error);
        });
    autoUpdateSlug("#product_name_vi", "#slug"); // Gắn với các input cụ thể
});
</script>

@endsection