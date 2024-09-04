@extends('customAuth.master')

@section('title','Register')

@section('content')

<body class="bg-light ">

    <div class="d-flex flex-column align-items-center login-main">
        <h1 class="login mb-5">
            Register Page
        </h1>
        <div class="row w-50">
            <div class="col-6 offset-3">
            <form action="{{ route('register') }}" method="POST">
                @csrf
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


                <div class="d-flex justify-content-between align-items-center mt-3 ">
                    <a href="{{ route('login')}}" class="text-decoration-none reg text-dark">Already had an account?</a>
                    <input type="submit" value="Register" class="btn btn-secondary">
                </div>
            </form>
            </div>
        </div>
    </div>

@endsection
