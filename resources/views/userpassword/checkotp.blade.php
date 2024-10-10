@extends('admin.layout.dashboard')
<!-- title -->
@section('title', 'Check OTP')
<!-- nội dung -->
@section('content')
    <!-- particles.js container -->
    <div id="particles-js"></div>
    <!-- Form -->
    <div class="form-tt py-3">
        <h4>Enter OTP</h4>
        <b>Kiểm Tra Email để có Mã OTP.</b>
        <form class="login" action="{{ url('/password-reset/otp') }}" method="POST">
        @csrf
            <input type="hidden" name="email" value="{{ session('email') }}">
            <div class="form-group">
                <label for="otp" class="form-card-boy-label my-2">Nhập mã OTP:</label>
                <div class="input-group">
                    <input class="form-control @if (session('error')) is-invalid @endif" type="text" name="otp"  placeholder="Nhập OTP" required>
                    @if (session('error'))
                        <div class="invalid-feedback">
                            {{ session('error') }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="text-center">
                <button class="btn btn-success mx-0" type="submit">Verify OTP</button>
                <p class="forget-password my-2"> <a href="{{url('/login')}}" class="login-link"> Quay về trang đăng nhập </a></p>
            </div>
            
        </form>
    </div>
    <!-- Hiển thị Thông báo khi đăng nhập sai -->


@endsection