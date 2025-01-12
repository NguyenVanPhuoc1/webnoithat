@extends('frontend.layout.master')

@section('title', 'Liên Hệ')

@section('body')
<!-- Content -->
<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-5 mr-auto mt-5">
                <div class="intro-vi">
                    <h4>Nội Thất NVP : <span class="text-success">(Việt Nam)</span></h4>
                    <p class="mb-3">Ngày nay, trong thiết kế nội thất, đồ nội thất bằng gỗ đang trở nên phổ biến và đã trở thành dòng sản phẩm chủ lực của các doanh nghiệp nội thất. Đồ nội thất làm từ gỗ tự nhiên luôn mang lại vẻ đẹp bề mặt, màu sắc hài hòa, độ bền theo thời gian, thiết kế đa dạng và chi phí hợp lý!</p>
                    <ul class="list-unstyled pl-md-5 ">
                        <li class="d-flex text-black mb-2">
                            <span class="mr-3"><span class="icon-map"></span></span> 53 Võ Văn Ngân, Linh Chiểu, Thành Phố Thủ Đức, Thành phố Hồ Chí Minh <br>Việt Nam
                        </li>
                        <li class="d-flex text-black mb-2">
                            <span class="mr-3"><span class="icon-phone"></span></span> Hotline: 0123 456 789
                        </li>
                        <li class="d-flex text-black">
                            <span class="mr-3"><span class="icon-envelope-o"></span></span> Email: nguyenvanphuoc031123@gmail.com
                        </li>
                    </ul>
                </div>
                <div class="intro-en">
                    <h4>NVP Furniture : <span class="text-success">(English)</span></h4>
                    <p class="mb-3">Nowadays, in interior design, wooden furniture is on the rise and has become a key product line for interior businesses. Furniture made from natural wood always boasts a beautiful surface, harmonious colors, durability over time, versatile designs, and reasonable costs!</p>
                    <ul class="list-unstyled pl-md-5 ">
                        <li class="d-flex text-black mb-2">
                            <span class="mr-3"><span class="icon-map"></span></span> 53 Vo Van Ngan, Linh Chieu, Thu Duc City, Ho Chi Minh City <br>Vietnam
                        </li>
                        <li class="d-flex text-black mb-2">
                            <span class="mr-3"><span class="icon-phone"></span></span> Hotline:  0123 456 789
                        </li>
                        <li class="d-flex text-black">
                            <span class="mr-3"><span class="icon-envelope-o"></span></span> Email: nguyenvanphuoc031123@gmail.com
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="col-md-6 mt-5">
                <form action="{{ route('regis-customer') }}" class="mb-5" method="post" id="contactForm" name="contactForm" novalidate="novalidate">
                    @csrf
                    <div class="row justify-content-between">
                        <div class="title-main">
                            <span> Đăng Kí Nhận Tin</span>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="fullname" class="col-form-label">Name</label>
                            <input type="text" class="form-control @error('fullname') is-invalid @enderror" name="fullname" id="fullname" >
                            @error('fullname')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="phone" class="col-form-label">Phone</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone" >
                            @error('phone')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="email" class="col-form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" >
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="content" class="col-form-label">Content</label>
                            <textarea class="form-control" name="content" id="content" cols="30" rows="7" required></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <input type="submit" value="Gửi Yêu Cầu" class="btn btn-primary rounded-2 py-2 px-4 mt-2">
                            <span class="submitting"></span>
                        </div>
                    </div>
                </form>
                <!-- <div id="form-message-warning mt-4"></div>
                <div id="form-message-success">
                Your message was sent, thank you! -->
            </div>
        </div>
    </div>
</div>


 @endsection


@section('script')
<script>
    $(document).ready(function() {
        @if (session('success'))
            toastr.success("{{ session('success') }}");
        @endif
        
        @if (session('error'))
            alert("{{ session('error') }}");
        @endif
    });

</script>
@endsection