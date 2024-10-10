@extends('admin.layout.headerend')

@section('title', 'Thay Đổi Mật Khẩu')

@section('body')
<div class="content-wrapper edipassword" id="editpassword">
    <form action="{{route('change.password.post')}}" method="post" class="validation-form" id="updatePassword" enctype="multipart/form-data">
        @csrf
        <section class="content-header " id="changepassword">
            <div class="container-fluid">
                <div class="row mb-2 ">
                    <div class=" col-md-12 ">
                        <h1>Quản Lí</h1>
                        <div class="row">
                            <div class="d-flex">
                                <button class="btn btn-sm bg-gradient-primary text-white m-2"  title="Lưu">
                                    <i class="far fa-save mr-2">
                                    </i>Lưu
                                </button>
                                <button class="btn btn-sm  text-white m-2" type="button" id="reset-all" data-url="#" title="Xóa tất cả" style="background: #575a5c">
                                    <i class="far fas fa-redo mr-2"></i>Làm lại
                                </button>
                            </div>
                            <!-- Trong file change-password.blade.php -->
                        </div>
                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif
                    </div>
                    <div class="col-md-12">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item"><a href="{{url('admin/trang-chu')}}">Bảng Điều Khiển</a></li>
                            <li class="breadcrumb-item active">Quản Lí Mật Khẩu</li>
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
                                    <h3 class="card-title">Thông tin Admin</h3>
                                </div>
                                <!-- card-body table-responsive p-0 -->
                                <div class="card-body ">
                                    <div class="card-body card-changepassword">
                                        <div class="tab-content" id="custom-tabs-three-tabContent-lang">
                                            <div class="tab-pane fade show active d-flex " id="tabs-info-admin" role="tabpanel" aria-labelledby="tabs-lang" style="justify-content: space-between">
                                                    <div class="form-group mx4 position-relative">
                                                        <label for="old-password" class="form-card-boy-label"><b>Mật khẩu cũ:</b></label>
                                                        <div class="input-group">
                                                            <input type="password" name="old-password" id="old-password" class="form-control for-seo text-sm" placeholder="Nhập mật khẩu cũ:" required>
                                                            <div class="input-group-append">
                                                                <button type="button" class="btn btn-light" id="toggle-old-password">
                                                                    <i class="fas fa-eye"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        @if ($errors->has('old-password'))
                                                            <span id="searchError" class="d-block alert text-danger" >{{ $errors->first('old-password') }}</span>
                                                        @endif
                                                    </div> 
                                                    <div class="d-flex  " style="align-items:baseline">
                                                        <div class="d-flex flex-fill align-items-end" style="margin: 0 120px">
                                                            <div class="form-group mx-4">
                                                                <label for="new-password" class="form-card-boy-label"><b>Mật khẩu mới:</b></label>
                                                                <div class="input-group">
                                                                    <input type="password" name="new-password" id="new-password" class="form-control for-seo text-sm" placeholder="Nhập mật khẩu mới :" required>
                                                                    <div class="input-group-append">
                                                                        <button type="button" class="btn btn-light" id="toggle-new-password">
                                                                            <i class="fas fa-eye"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>  
                                                            @if ($errors->has('new-password'))
                                                                <span id="searchError" class="d-block alert text-danger" >{{ $errors->first('new-password') }}</span>
                                                            @endif
                                                            <div class="form-group">
                                                                <button type="button" class="btn btn-primary form-control for-seo text-sm" name="create-newpass">
                                                                    <i class="fas fa-random mr-2"></i>
                                                                    Tạo mật khẩu
                                                                </button>
                                                            </div>
                                                        </div>
                                    
                                                        <div class="form-group">
                                                            <label for="renew-password" class="form-card-boy-label"><b>Nhập Lại Mật khẩu mới:</b></label>
                                                            <div class="input-group">
                                                                <input type="password" name="renew-password" id="renew-password" class="form-control for-seo text-sm" placeholder="Nhập mật khẩu mới :" required>
                                                                <div class="input-group-append">
                                                                    <button type="button" class="btn btn-light" id="toggle-renew-password">
                                                                        <i class="fas fa-eye"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            @if ($errors->has('renew-password'))
                                                                <span id="searchError" class="d-block alert text-danger" >{{ $errors->first('renew-password') }}</span>
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

<!-- modal -->
<div class="modal fade" id="randomPasswordModal" tabindex="-1" aria-labelledby="randomPasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="randomPasswordModalLabel">Mật khẩu ngẫu nhiên đã được tạo (Note: Bạn phải lưu lại!!!)</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <p id="randomPasswordText"></p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
        </div>
        </div>
    </div>
</div>

@endsection

@section('javascript')
<script>
//xem mật khẩu
document.addEventListener('DOMContentLoaded', function() {
        var oldPasswordInput = document.getElementById('old-password');
        var toggleOldPasswordBtn = document.getElementById('toggle-old-password');

        var newPasswordInput = document.getElementById('new-password');
        var toggleNewPasswordBtn = document.getElementById('toggle-new-password');

        var renewPasswordInput = document.getElementById('renew-password');
        var togglereNewPasswordBtn = document.getElementById('toggle-renew-password');
        //mật khẫu cũ
        toggleOldPasswordBtn.addEventListener('click', function() {
            togglePasswordVisibility(oldPasswordInput, toggleOldPasswordBtn);
        });
        //mật khẫu mới
        toggleNewPasswordBtn.addEventListener('click', function() {
            togglePasswordVisibility(newPasswordInput, toggleNewPasswordBtn);
        });

        togglereNewPasswordBtn.addEventListener('click', function() {
            togglePasswordVisibility(renewPasswordInput, togglereNewPasswordBtn);
        });

        function togglePasswordVisibility(inputElement, toggleButton) {
            if (inputElement.type === 'password') {
                inputElement.type = 'text';
                toggleButton.innerHTML = '<i class="fas fa-eye-slash"></i>';
            } else {
                inputElement.type = 'password';
                toggleButton.innerHTML = '<i class="fas fa-eye"></i>';
            }
        }
        
        $('#reset-all').click(function() {
            // Kiểm tra xem có ít nhất một checkbox nào đó được chọn không
            oldPasswordInput.value = '';
            newPasswordInput.value = '';
            renewPasswordInput.value = '';
        });
    });
    //tọa ngẫu nhiên
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelector('[name="create-newpass"]').addEventListener('click', function() {
            var randomPassword = generateRandomPassword();
            document.getElementById('new-password').value = randomPassword;
            document.getElementById('renew-password').value = randomPassword;

            $('#randomPasswordModal').modal('show');
            $('#randomPasswordText').text(randomPassword);
        });

        function generateRandomPassword() {
            // Logic để tạo mật khẩu ngẫu nhiên 6 kí tự theo mô tả
            var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            var password = '';
            for (var i = 0; i < 6; i++) {
                password += characters.charAt(Math.floor(Math.random() * characters.length));
            }
            return password;
        }
    });
</script>
@endsection
