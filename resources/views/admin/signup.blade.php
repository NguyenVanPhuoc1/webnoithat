@extends('admin.layout.dashboard')

@section('title', 'Đăng Kí Tài Khoản')
<!-- nội dung -->
@section('content')
<!-- particles.js container -->
<div id="particles-js"></div>
<!-- Form đăng kí tài khoản -->
<div class="signup-form register-page">
    <div class="signup-box">
        <div class="card">
            <div class="card-body ">
                <h4 class="text-center">Đăng Kí Tài Khoản</h4>
                <form class="register" id="register-form" action="{{ route('users.register') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <!-- name -->
                    <div class="form-group">
                        <label for="name" class="form-card-boy-label"><b>Nhập Tên:</b></label>
                        <div class="input-group">
                            <input type="text" name="name" id="name" class="form-control for-seo text-sm @error('name') is-invalid @enderror"
                                placeholder="Nhập tên :" >
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                        </div>
                    </div>
                    <!-- Email -->
                    <div class="form-group">
                        <label for="email" class="form-card-boy-label"><b>Nhập Email:</b></label>
                        <div class="input-group">
                            <input type="text" name="email" id="email" class="form-control for-seo text-sm  @error('email') is-invalid @enderror"
                                placeholder="Nhập email :" >
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="new-password" class="form-card-boy-label"><b>Nhập Mật Khẩu:</b></label>
                        <div class="input-group">
                            <input type="password" name="new-password" id="new-password" class="form-control for-seo text-sm @error('new-password') is-invalid @enderror"
                                placeholder="Nhập mật khẩu mới :" >
                            <div class="input-group-append show-password">
                                <button type="button" class="btn btn-light" id="toggle-new-password">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            @error('new-password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                        <div class="form-group">
                            <label for="current-password" class="form-card-boy-label"><b>Nhập Lại Mật khẩu:</b></label>
                            <div class="input-group">
                                <input type="password" name="current-password" id="current-password" class="form-control for-seo text-sm @error('current-password') is-invalid @enderror"
                                    placeholder="Nhập lại mật khẩu :" >
                                <div class="input-group-append show-password m0-auto">
                                    <button type="button" class="btn btn-light" id="toggle-current-password">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                                <!-- báo lỗi -->
                                @error('current-password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="text-center">
                            <input class="btn btn-danger" type="submit" name="submit" value="Đăng kí tài khoản" />
                        </div>
                </form>
                <p class="m-3 sign-up-account text-center">Bạn đã có tài khoản ? <a href="{{route('login')}}" class="sign-up"> Đăng nhập </a></p>
            </div>
        </div>
    </div>
</div>
<!-- Hiển thị Thông báo khi đăng nhập sai -->

@if (session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

@endsection