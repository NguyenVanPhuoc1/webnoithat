<!DOCTYPE html>
<html>
<head>
    <title>Nhóm B | TDC</title>
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
                        <h1 class="confirm-head" style="color: red" >{{$details['title']}}</h1>
                        <div class="confirm-body">
                            <div class="confirm-body-inner ">
                                @if($details['content'])
                                <p>{{$details['content']}}</p>
                                @else
                                <p>Cảm ơn Quý Khách đã tin tưởng chúng tôi!</p>
                                @endif
                                
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