<!DOCTYPE html>
<html>
<head>
    <title>Change Password</title>
    <link type="text/css" rel="stylesheet" href="{{ asset('front/public/css/bootstrap.min.css') }}"/>
    <link rel="stylesheet" href="{{asset('front/public/css/font-awesome.min.css')}}">
</head>
<body>
    <!-- particles.js container -->
    <div id="particles-js"></div>
    <!-- Form -->
    <div class="form-tt py-3">
        <h4>Enter OTP</h4>
        <b>Kiểm Tra Email để có Mã OTP.</b>
        <form class="login" action="{{ url('/password-reset/change') }}" method="POST">
        @csrf
            <div class="form-group">
                <label for="password" class="form-card-boy-label my-2">Nhập Mật Khẩu:</label>
                <div class="input-group">
                    <input class="form-control @if ($errors->has('password')) is-invalid @endif" type="password" name="password"  placeholder="Nhập Mật Khẩu" required>
                    @if ($errors->has('password'))
                        <div class="invalid-feedback">
                            {{ $errors->first('password') }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <label for="password_confirmation" class="form-card-boy-label my-2">Nhập Lại Mật Khẩu:</label>
                <div class="input-group">
                    <input class="form-control @if ($errors->has('password_confirmation')) is-invalid @endif" type="password" name="password_confirmation" id="password_confirmation" placeholder="Nhập Lại Mật Khẩu" required>
                    @if ($errors->has('password_confirmation'))
                        <div class="invalid-feedback">
                            {{ $errors->first('password_confirmation') }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="text-center">
                <button class="btn btn-success mx-0" type="submit">Change Password</button>
                <p class="forget-password my-2"> <a href="{{url('/login')}}" class="login-link"> Quay về trang đăng nhập </a></p>
            </div>            
        </form>
    </div>
    <!-- Hiển thị Thông báo khi đăng nhập sai -->
</body>
</html>