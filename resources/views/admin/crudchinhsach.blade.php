@extends('admin.layout.headerend')

@section('title', 'Quản Lí Chính Sách')

@section('body')
<!-- Content Wrapper. Contains page content -->

@if(!isset($policy))
<!--                                            Thêm Tin Tức                                     -->
    <div class="content-wrapper addchinhsach" id="addchinhsach">
        <form action="{{ route('add-policy') }}" method="post" class="validation-form" id="addPolicy" enctype="multipart/form-data">
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
                                    <a class="btn btn-sm bg-gradient-danger text-white m-2" id="delete-all" href="{{url('admin/quanlichinhsach/chinhsach')}}" title="Xóa tất cả">
                                        <i class="fas fa-sign-out-alt mr-2"></i>Thoát
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <ol class="breadcrumb float-sm-left">
                                <li class="breadcrumb-item"><a href="index.php">Bảng Điều Khiển</a></li>
                                <li class="breadcrumb-item active">Thêm mới Chính Sách</li>
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
                                    <h3 class="card-title">Nội dung Chính Sách</h3>
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
                                                        <label for="poli_name">Tên Chính Sách (vi):</label>
                                                        <input type="text" class="form-control for-seo text-sm" name="poli_name" id="poli_name" placeholder="Tên Chính Sách (vi)"  required>
                                                        @if ($errors->has('poli_name'))
                                                            <span id="searchError" class="d-block alert text-danger" >{{ $errors->first('poli_name') }}</span>
                                                        @endif
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="contentvi">Nội dung (vi):</label>
                                                        <textarea name="contentvi" id="contentvi" cols="10" rows="80" plaintext></textarea>
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
                                    <h3 class="card-title">Hình ảnh Chính Sách</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                    </div>
                                </div>
                                <div class="card-body text-center">
                                    <div class="photoUpload-zone">
                                        <div class="photoUpload-detail mb-3 justify-content-center d-flex"  >
                                            <img class="rounded" src="{{ asset('admin/image/noimage.png')}}"
                                            alt="Alt Photo" id="photoUpload-preview" style="border: 1px solid black;"  >
                                        </div>
                                        <label class="photoUpload-file" id="photo-zone" for="fileToUpload">
                                            <input type="file" name="fileToUpload" id="fileToUpload" onchange="checkImage()">
                                            <i class="fas fa-cloud-upload-alt"></i>
                                            <p class="photoUpload-drop">Kéo và thả hình vào đây</p>
                                            <p class="photoUpload-or">hoặc</p>
                                            <p class="photoUpload-choose btn btn-sm bg-gradient-success">Chọn hình</p> 
                                        </label> 
                                        <div class="photoUpload-dimension">Width: 565 px - Height: 545 px (.jpg|.png)</div> 

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
<!--                                            Thêm Tin Tức                                     -->

@else
<!--                                            Sửa Tin Tức                                     -->
    <div class="content-wrapper editchinhsach" id="editchinhsach">
        <form action="{{route('admin-updatePolicys')}}" method="post" class="validation-form" id="updatePolicy" enctype="multipart/form-data">
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
                                    <a class="btn btn-sm bg-gradient-danger text-white m-2" id="thoat" href="{{url('admin/quanlichinhsach/chinhsach')}}" title="Xóa tất cả">
                                        <i class="fas fa-sign-out-alt mr-2"></i>Thoát
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <ol class="breadcrumb float-sm-left">
                                <li class="breadcrumb-item"><a href="index.php">Bảng Điều Khiển</a></li>
                                <li class="breadcrumb-item active">Chi Tiết Chính Sách</li>
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
                                    <h3 class="card-title">Nội dung Chính Sách</h3>
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
                                                    <input type="hidden" name="poli_id" value="{{ $policy->id }}">
                                                    <div class="form-group">
                                                        <label for="news_name">Tên Chính Sách (vi):</label>
                                                        @if(strlen($policy->poli_name) <= 100)
                                                        <input type="text" class="form-control for-seo text-sm" name="poli_name" id="poli_name" placeholder="Tên Chính Sách (vi)" value="{{$policy -> poli_name}}" required>
                                                        @else
                                                        <input type="text" class="form-control for-seo text-sm" value="Tiêu đề quá kí tự cho phép" >
                                                        @endif
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="namevi">Nội dung (vi):</label>
                                                        <textarea name="contentvi" id="contentvi" cols="10" rows="80" plaintext>{{$policy -> poli_desc}}</textarea>
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
                                    <h3 class="card-title">Hình ảnh Chính Sách</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                    </div>
                                </div>
                                <div class="card-body text-center">
                                    <div class="photoUpload-zone">
                                        @if(file_exists('front/public/image/'.$policy->poli_image))
                                        <div class="photoUpload-detail mb-3 justify-content-center d-flex"  >
                                            <img class="rounded" src="{{ asset('front/public/image/'.$policy->poli_image)}}"
                                            alt="Alt Photo" id="photoUpload-preview" style="border: 1px solid black;"  >
                                        </div>
                                        @else
                                        <div class="photoUpload-detail mb-3 justify-content-center d-flex"  >
                                            <img class="rounded" src="{{ asset('admin/image/noimage.png')}}"
                                            alt="Alt Photo" id="photoUpload-preview" style="border: 1px solid black;"  >
                                        </div>
                                        @endif
                                        <label class="photoUpload-file" id="photo-zone" for="fileToUpload">
                                            <input type="file" name="fileToUpload" id="fileToUpload" onchange="checkImage()">
                                            <i class="fas fa-cloud-upload-alt"></i>
                                            <p class="photoUpload-drop">Kéo và thả hình vào đây</p>
                                            <p class="photoUpload-or">hoặc</p>
                                            <p class="photoUpload-choose btn btn-sm bg-gradient-success">Chọn hình</p> 
                                        </label> 
                                        <div class="photoUpload-dimension">Width: 565 px - Height: 545 px (.jpg|.gif|.png|.jpeg|.gif)</div> 

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
<!--                                            Sửa Tin Tức                                     --> 
@endif
<!-- Modal thông báo sai đường dẫn ảnh -->
<div class="modal" id="ImageNotification" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body text-center">
                    Đường dẫn ảnh không hợp lệ!
                </div>
                <div class="modal-footer mx-auto">
                    <button id="confirmOK" type="button" class="btn btn-primary">OK</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('javascript')
<!-- Tạo thư viện classEditor -->
<script>
        ClassicEditor
            .create(document.querySelector('#contentvi'), {
            autoParagraph: false
            })
            .catch(error => {
                console.error(error);
            });

        // Kéo và láy ảnh
            // Lấy tham chiếu đến các phần tử cần sử dụng
        const dropzone = document.getElementById('photo-zone');
        const fileInput = document.getElementById('fileToUpload');
        var imagePreview = document.getElementById('photoUpload-preview');

        // lấy ảnh từ bên ngoài
        fileInput.addEventListener('change', () => {
            const selectedFile = fileInput.files[0];

            if (selectedFile) {
                const reader = new FileReader();

                reader.onload = function () {
                    imagePreview.src = reader.result;
                    imagePreview.style.display = 'block';
                }

                reader.readAsDataURL(selectedFile);
            }
        });

        dropzone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropzone.classList.add('scale');
        });

        dropzone.addEventListener('dragleave', (e) => {
            e.preventDefault();
            dropzone.classList.remove('scale');
        });

        dropzone.addEventListener('drop', (e) => {
            e.preventDefault();
            // dropzone.style.borderColor = '#cccccc';
            const file = e.dataTransfer.files[0];

            if (file) {
                const reader = new FileReader();

                reader.onload = function () {
                    imagePreview.src = reader.result;
                    imagePreview.style.display = 'block';
                }

                reader.readAsDataURL(file);
            }
        });

        // hàm kiểm tra đuôi ảnh
        function isImageValid(imageUrl) {
            // Kiểm tra đuôi của đường dẫn ảnh
            var validExtensions = ['jpg', 'png'];
            var extension = imageUrl.split('.').pop().toLowerCase();

            // So sánh đuôi với danh sách đuôi hợp lệ
            return validExtensions.includes(extension);
        }
        // bắt sự kiện change cho thẻ input
        var ImageNotify = document.getElementById('ImageNotification');
        function checkImage(){
            var fileInput = document.getElementById('fileToUpload');
            
            if (fileInput.files.length > 0) {
                // Lấy đường dẫn của tệp tin
                var filePath = fileInput.value;

                // Kiểm tra đuôi của tệp tin
                if (!isImageValid(filePath)) {
                    ImageNotify.style.display = "block";
                } 
            } 
        }
        if(document.getElementById('confirmOK')){
            document.getElementById('confirmOK').addEventListener('click', function (){
            // Đóng modal
            ImageNotify.style.display = "none";
            imagePreview.setAttribute('src', `{{ asset('admin/image/noimage.png')}}`);
        });
        }

    </script>

@endsection