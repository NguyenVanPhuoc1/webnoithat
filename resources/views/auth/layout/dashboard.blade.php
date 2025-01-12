<!DOCTYPE html>
<html>
<head>
    <link rel="icon" href="{{ asset('front/public/image/' . $logo) }}" type="image/x-icon">
    <title> @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Styles -->
	<link href="{{ asset('admin/dist/css/login.css')}}" rel="stylesheet" >
    <!-- sign up -->
    <link href="{{ asset('admin/dist/css/signup.css')}}" rel="stylesheet" >
    <!-- particles.js css -->
    <link href="{{ asset('front/particles/css/style.css')}}" rel="stylesheet" >
    <!-- icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        crossorigin="anonymous" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <style>
        #particles-js{
            background-color: #2e2e2e!important;
        }
    </style>
</head>
<body>

    @yield('content')
    <!-- js particles -->
    <script src="{{ asset('front/particles/js/particles.js') }}"></script>
    <script src="{{ asset('front/particles/js/app.js') }}"></script>
    <script src="{{ asset('front/particles/js/stats.js') }}"></script>
</body>
</html>