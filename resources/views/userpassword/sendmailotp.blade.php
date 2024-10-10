@extends('admin.layout.dashboard')
<!-- title -->
@section('title', 'Khôi phục tài khoản')
<!-- nội dung -->
@section('content')
    <!-- particles.js container -->
    <div id="particles-js"></div>
    <!-- Form -->
    <div class="form-tt py-3">
        <h4>Đặt Lại Mật Khẩu</h4>
        <br>
        <p class="text-center">Forgot your password? Please fill in your email so we can send you OTP CODE to recover your password.</p>
        <form class="login" action="{{ url('/password-reset') }}" method="POST">
        @csrf
            <div class="form-group">
                <label for="name" class="form-card-boy-label my-2">Nhập Email:</label>
                <div class="input-group">
                    <input class="form-control @if (session('error')) is-invalid @endif" type="email" name="email"  placeholder="Nhập Email" required>
                    @if (session('error'))
                        <div class="invalid-feedback">
                            {{ session('error') }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="text-center">
                <button class="btn btn-success mx-0" type="submit">Gửi OTP</button>
                <p class="forget-password my-2"> <a href="{{url('/login')}}" class="login-link"> Quay về trang đăng nhập </a></p>
            </div>
            
        </form>
    </div>
    <!-- Hiển thị Thông báo khi đăng nhập sai -->


@endsection