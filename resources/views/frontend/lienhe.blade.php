@extends('frontend.layout.master')

@section('title', 'Liên Hệ')

@section('body')
<!-- Content -->
<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-5 mr-auto mt-5">
                <h2>Nhóm B</h2>
                <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste quaerat autem corrupti asperiores accusantium et fuga! Facere excepturi, quo eos, nobis doloremque dolor labore expedita illum iusto, aut repellat fuga!</p>
                <ul class="list-unstyled pl-md-5 mb-5">
                    <li class="d-flex text-black mb-2">
                    <span class="mr-3"><span class="icon-map"></span></span> 53 Võ Văn Ngân, Linh Chiểu, Thành Phố Thủ Đức, Thành phố Hồ Chí Minh <br>Việt Nam
                    </li>
                    <li class="d-flex text-black mb-2"><span class="mr-3"><span class="icon-phone"></span></span> 0123 456 789</li>
                    <li class="d-flex text-black"><span class="mr-3"><span class="icon-envelope-o"></span></span> admin123456@gmail.com </li>
                </ul>
            </div>
            <div class="col-md-6 mt-5">
                <form action="{{ route('regis-customer') }}" class="mb-5" method="post" id="contactForm" name="contactForm" novalidate="novalidate">
                    @csrf
                    <div class="row justify-content-between">
                        <div class="col-md-6 form-group">
                            <label for="fullname" class="col-form-label">Name</label>
                            <input type="text" class="form-control" name="fullname" id="fullname" required>
                            @if ($errors->has('news_name'))
                                <span id="searchError" class="d-block alert text-danger" >{{ $errors->first('fullname') }}</span>
                            @endif
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="phone" class="col-form-label">Phone</label>
                            <input type="text" class="form-control" name="phone" id="phone" required>
                            @if ($errors->has('phone'))
                                <span id="searchError" class="d-block alert text-danger" >{{ $errors->first('phone') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="email" class="col-form-label">Email</label>
                            <input type="email" class="form-control" name="email" id="email" required>
                            @if ($errors->has('email'))
                                <span id="searchError" class="d-block alert text-danger" >{{ $errors->first('email') }}</span>
                            @endif
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
 <!-- script -->
 @endsection