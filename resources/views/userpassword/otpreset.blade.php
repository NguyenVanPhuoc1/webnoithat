<!DOCTYPE html>
<html>
<head>
    <title>OTP Reset Password</title>
    <link type="text/css" rel="stylesheet" href="{{ asset('front/public/css/bootstrap.min.css') }}"/>
    <link rel="stylesheet" href="{{asset('front/public/css/font-awesome.min.css')}}">
</head>
<body>
    <!-- SECTION -->
    <div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
                    <div class="box-cart-confirm">
                        <h1 class="confirm-head" style="color: red" >OTP Code</h1>
                        <div class="confirm-body">
                            <div class="confirm-body-inner ">
                                <p>Your OTP code is: {{ $otp }}</p>
                                <p>This code is valid for 10 minutes.</p> 
                            </div>   
                        </div>
                    </div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>

</body>
</html>