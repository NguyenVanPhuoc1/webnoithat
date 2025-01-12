@extends('admin.layout.master')

@section('title', 'Quản Lí Favicon')

@section('body')
    <div class="content-wrapper qlidanhmuc" id="qlidanhmuc">
        <!-- Content Header (Page header) -->
        <section class="content-header ">
            <div class="container-fluid">
                <div class="row mb-2 ">
                    <div class=" col-md-12 ">
                        <h1>Quản Lí Favicon</h1>
                        <hr>
                        <p style="font-style: italic">Nên chọn ảnh có tỉ lệ 1:1, kích thước ảnh không quá 100Kb</p>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <form class="ml-5" action="{{ route('update_favicon') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <section class="content-header ">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12 ">
                            <div class="row">
                                <div class="d-flex">
                                    <button type="submit" class="btn btn-sm bg-gradient-primary text-white m-2" title="Thêm mới">
                                        <i class="fas fa-save mr-2">
                                        </i>Lưu
                                    </button>
                                    <a class="btn btn-sm bg-gradient-danger text-white m-2" href="/admin/trang-chu"
                                        title="Thoát">
                                        <i class="fas fa-sign-out-alt mr-2"></i>Thoát
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <!-- Main content -->
            @if ($favicon)
                <img id="previewFavicon" src="{{ asset( $favicon) }}" alt="" width="100px">
            @endif
            <input id="newFaviconInput" type="file" name="new_favicon" onchange="preview(event)" accept=".jpg,.jpeg,.png,.ico">
        </form>
    @endsection

    @section('javascript')
        <script>
            @if (session('success'))
                toastr.success("{{ session('success') }}");
            @endif

            @if (session('error'))
                alert("{{ session('error') }}");
            @endif
            function preview(event) {
                const file = event.target.files[0];
                const fileSize = file.size; // Dung lượng file

                // Kiểm tra dung lượng file (100kb = 100 * 1024 bytes)
                if (fileSize > 100 * 1024) {
                    alert("File quá lớn. Vui lòng chọn file có dung lượng dưới 100KB.");
                    // Xóa giá trị trong input để người dùng có thể chọn lại file
                    event.target.value = '';
                    return;
                }

                const reader = new FileReader();
                reader.onload = function() {
                    const preview = document.getElementById('previewFavicon');
                    preview.src = reader.result;
                };

                reader.readAsDataURL(file);
            }

        </script>
    @endsection
