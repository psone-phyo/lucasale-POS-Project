@extends('admin.layout.master')

@section('content')
<body class="bg-light ">

    <div class="d-flex flex-column align-items-center justify-content-center">
        <h1 class="login mb-3">
            Create admin account
        </h1>
        <div class="row w-100">
            <div class="col-sm-6 offset-sm-3 col-md-8 offset-md-2 col-lg-4 offset-lg-4">
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <input type="hidden" name="role" value="admin">
                <div class="form-floating mb-3 ">
                    <input type="text" class="form-control shadow-sm" id="floatingInput" name="name" placeholder="Name" value="{{old('name')}}">
                    <label for="floatingInput">Name</label>
                    @error('name')
                    <small class="text-danger">{{$message}}</small>
                @enderror
                </div>


                <div class="form-floating mb-3">
                    <input type="email" class="form-control shadow-sm" id="floatingInput" name="email" placeholder="name@example.com" value="{{old('email')}}">
                    <label for="floatingInput">Email address</label>
                    @error('email')
                    <small class="text-danger">{{$message}}</small>
                @enderror
                </div>


                <div class="form-floating mb-3">
                    <input type="password" class="form-control shadow-sm" id="floatingPassword" name="password" placeholder="Password">
                    <label for="floatingPassword">Password</label>
                    @error('password')
                    <small class="text-danger">{{$message}}</small>
                @enderror
                </div>


                <div class="form-floating">
                    <input type="password" class="form-control shadow-sm" id="floatingPassword" name="password_confirmation" placeholder="Password Confirmation">
                    <label for="floatingPassword">Confirm Password</label>
                    @error('password_confirmation')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>


                <div class="d-flex justify-content-center align-items-center mt-3 ">
                    <input type="submit" value="Create" class="btn btn-secondary w-100">
                </div>
            </form>
            </div>
        </div>
    </div>

@endsection
