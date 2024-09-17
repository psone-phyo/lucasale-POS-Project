@extends('admin.layout.master')

@section('content')

<div class="row d-flex justify-content-center align-items-center">
    <div class="row d-flex justify-content-center align-items-center w-75">
        <div class="col-md-3 offset-md-1">
            <img src="{{Auth::user()->profile ? asset('admin/img/'. Auth::user()->profile) : asset('admin/img/undraw_profile_2.svg')}}" alt="" class="w-100 rounded-circle" width="150px" height="150px">
        </div>
        <div class="col-md-7 offset-1">
            <div class="mb-2">
                Name : <span class="">{{ Auth::user()->name ?? Auth::user()->nickname }}</span>
            </div>
            <div class="mb-2">
                Email : <span class="">{{Auth::user()->email }}</span>
            </div>
            <div class="mb-2">
                Phone : <span class="">{{Auth::user()->phone }}</span>
            </div>
            <div class="mb-2">
                Address : <span class="">{{Auth::user()->address }}</span>
            </div>
            <div class="mb-2">
                Role : <span class="@if (Auth::user()->role == 'user')
                    text-primary
                    @else
                    text-danger
                @endif">{{Auth::user()->role }}</span>
            </div>
            <div class=" ">
                <a class=" btn btn-outline-dark mb-1" href="{{route('changepassword')}}">
                    <i class="fa-solid fa-lock"></i>
                    Change Password
                </a>
                <a class=" btn btn-outline-secondary mb-1" href="#">
                    <i class="fa-solid fa-lock"></i></i></i>
                    Forget Password
                </a>
            </div>
        </div>
        <div class="w-75 mt-3">
            <a href="{{route('profileedit')}}" class="btn btn-outline-primary mb-1 w-100">Edit</a>
        </div>
    </div>
</div>
@endsection
