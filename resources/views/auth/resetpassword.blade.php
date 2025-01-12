@extends('auth.layout.dashboard')
<!-- title -->
@section('title', 'Reset Password')
<!-- nội dung -->
@section('content')
    <!-- particles.js container -->
    <div id="particles-js"></div>
    <!-- form đăng nhập -->
    <div class="form-tt py-3">
        <h4>Reset Password</h4>
        <form class="login" action="{{route('password.store')}}" method="post" >
            @csrf
            <div class="form-group">
                <div class="input-group">
                    <input type="hidden" name="token" id="token" class="form-control for-seo text-sm "
                            value="{{ request('token') ?? old('token') }}">
                </div>
            </div>
            <div class="form-group">
                <label for="email" class="form-card-boy-label"><b>Email:</b></label>
                <div class="input-group">
                    <input type="text" name="email" id="email" class="form-control for-seo text-sm @error('email') is-invalid @enderror"
                            placeholder="Nhập email :" required 
                            value="{{ request('email') ?? old('email') }}">
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            
            <div class="form-group">
                <label for="password" class="form-card-boy-label"><b>Password</b></label>
                <div class="input-group">
                    <input type="password" name="password" id="password" class="form-control for-seo text-sm @error('password') is-invalid @enderror"
                            placeholder="Nhập mật khẩu :" required >
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="password_confirmation" class="form-card-boy-label"><b>Confirm Password</b></label>
                <div class="input-group">
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control for-seo text-sm "
                            placeholder="Nhập mật khẩu :" required >
                </div>
            </div>
            <input type="submit" name="submit" value="Reset Password" />
        </form>
    </div>
@endsection