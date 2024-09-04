@extends('customAuth.master')

@section('title','Log In')

@section('content')

<body class="bg-light ">

    <div class="d-flex flex-column align-items-center justify-content-center min-vh-100">
        <h1 class="login mb-5">
            Log In Page
        </h1>
        <div class="row w-100">
            <div class="col-sm-6 offset-sm-3 col-md-8 offset-md-2 col-lg-4 offset-lg-4 ">
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="form-floating mb-3">
                    <input type="email" class="form-control shadow-sm" id="floatingInput" name="email" placeholder="name@example.com" value="{{old('email')}}">
                    <label for="floatingInput">Email address</label>
                    @error('email')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>


                <div class="form-floating">
                    <input type="password" class="form-control shadow-sm" id="floatingPassword" name="password" placeholder="Password" value="{{old('password')}}">
                    <label for="floatingPassword">Password</label>
                    @error('password')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>


                <div class="d-flex justify-content-between align-items-center mt-3 ">
                    <a href="{{ route('register')}}" class="text-decoration-none reg text-dark">Create an account.</a>
                    <input type="submit" value="Login" class="btn btn-secondary d-block">
                </div>
                <div class="d-flex justify-content-end mt-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                          Remember me
                        </label>
                      </div>
                </div>


            </form>

            <a class="w-100 btn btn-outline-secondary my-1 rounded shadow-sm d-block" href="{{route('redirect', 'google')}}">
                <i class="fa-brands fa-google fs-5"></i><span class="ms-2 fw-bold fs-5">Login with Google</span>
            </a>
            <a class="w-100 btn btn-outline-dark my-1 rounded shadow-sm d-block" href="{{route('redirect', 'github')}}">
                <i class="fa-brands fa-github fs-5"></i><span class="ms-2 fw-bold fs-5">Login with Github</span>
            </a>
            </div>
        </div>
    </div>

@endsection
