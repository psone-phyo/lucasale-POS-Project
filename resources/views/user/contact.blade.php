@extends('user.layout.master')

@section('title', 'Contact')

@section('content')
@session('success')
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>{{session('success')}}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endsession
<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Contact</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Pages</a></li>
        <li class="breadcrumb-item active text-white">Contact</li>
    </ol>
</div>
<!-- Single Page Header End -->


<!-- Contact Start -->
<div class="container-fluid contact py-5">
    <div class="container py-5">
        <div class="p-5 bg-light rounded">
            <div class="row g-4">
                <div class="col-lg-7">
                    <form action="" class="" method="post">
                        @csrf
                        <input type="text" class="w-100 form-control border-0 py-3
                        @error('name')
                        is-invalid
                        @enderror
                        " placeholder="Your Name" name="name" value="{{old('name')}}">
                        @error('name')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                        <input type="email" class="w-100 form-control border-0 py-3 mt-4 @error('email')
                        is-invalid
                        @enderror" placeholder="Enter Your Email" name="email" value="{{old('email')}}">
                        @error('email')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                        <textarea class="w-100 form-control border-0 mt-4 @error('message')
                        is-invalid
                        @enderror" rows="5" cols="10" placeholder="Your Message" name="message">{{old('message')}}</textarea>
                        @error('message')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                        <button class="w-100 btn form-control border-secondary py-3 bg-white text-primary mt-4" type="submit">Submit</button>
                    </form>
                </div>
                <div class="col-lg-5">
                    <div class="d-flex p-4 rounded mb-4 bg-white">
                        <i class="fas fa-map-marker-alt fa-2x text-primary me-4"></i>
                        <div>
                            <h4>Address</h4>
                            <p class="mb-2">123 Street Yangon</p>
                        </div>
                    </div>
                    <div class="d-flex p-4 rounded mb-4 bg-white">
                        <i class="fas fa-envelope fa-2x text-primary me-4"></i>
                        <div>
                            <h4>Mail Us</h4>
                            <p class="mb-2">lucasale@gmail.com</p>
                        </div>
                    </div>
                    <div class="d-flex p-4 rounded bg-white">
                        <i class="fa fa-phone-alt fa-2x text-primary me-4"></i>
                        <div>
                            <h4>Telephone</h4>
                            <p class="mb-2">(+959) 998 122 99</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="h-100 rounded">
                        <iframe class="rounded w-100"
                        style="height: 400px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15275.752126463949!2d96.12273890980225!3d16.829430030413857!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30c194ceb49d7c6d%3A0x6c44656c9a64bd45!2sNo%20(3)%20Ward%2C%20Yangon!5e0!3m2!1sen!2smm!4v1727703998542!5m2!1sen!2smm" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact End -->

@endsection
