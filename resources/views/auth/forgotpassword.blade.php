@extends('auth.layout.dashboard')
<!-- title -->
@section('title', 'Forgot Password')
<!-- nội dung -->
@section('content')
    <!-- particles.js container -->
    <div id="particles-js"></div>
    <!-- Form -->
    <div class="form-tt py-3">
        <h3 class="fw-bold">Forgot your password</h3>
        <br>
        <form class="login" action="{{ route('password.email') }}" method="POST">
            @csrf
            <p class="text-center">Forgot your password? No problem. Just let us know your email address and we will 
            email you a password reset link that will allow you to choose a new one.</p>
            <div class="form-group">
                <label for="name" class="form-card-boy-label my-2">Nhập Email:</label>
                <div class="input-group">
                    <input class="form-control " type="email" name="email"  placeholder="Nhập Email" required>
                </div>
            </div>
            <div class="text-center">
                <button class="btn btn-success mx-0" type="submit">Send Mail</button>
                @if ($errors->has('email'))
                    <div class="alert alert-danger">
                        {{ $errors->first('email') }}
                    </div>
                @endif

                <!-- Hiển thị thông báo thành công nếu có -->
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <p class="forget-password my-2"> <a href="{{url('/login')}}" class="login-link"> Login Page </a></p>
            </div>
            
        </form>
    </div>
    <!-- Hiển thị Thông báo khi đăng nhập sai -->


@endsection