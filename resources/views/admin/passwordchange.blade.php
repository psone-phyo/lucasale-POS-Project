@extends('admin.layout.master')

@section('content')
    <form action="{{route('updatepassword')}}" class=" m-auto" method="post">
        @csrf
        <h2 class="text-center text-primary col-md-6 offset-md-3">Change Password <hr class="bg-primary"></h2>
        <div class="col-md-6 offset-md-3 my-2 ">
            <label for="username" class="form-label mb-0">Current Password</label>
            <input type="password" class="form-control " id="username" placeholder="Enter Current Password..." name="oldpassword">
            @error('oldpassword')
            <small class="text-danger">{{$message}}</small>
            @enderror
            @session('wrongpassword')
            <small class="text-danger">{{session('wrongpassword')}}</small>
            @endsession
          </div>

          <div class="col-md-6 my-2 offset-md-3">
            <label for="nickname" class="form-label mb-0">New Password</label>
            <input type="password" class="form-control " id="nickname" placeholder="Enter New Password..." name="newpassword">
            @error('newpassword')
                <small class="text-danger">{{$message}}</small>
            @enderror
          </div>

          <div class="col-md-6 my-2 offset-md-3">
            <label for="nickname" class="form-label mb-0">New Password Confirmation</label>
            <input type="password" class="form-control " id="nickname" placeholder="Enter New Password Confirmation..." name="newpasswordconfirmation">
            @error('newpasswordconfirmation')
            <small class="text-danger">{{$message}}</small>
            @enderror
          </div>
          <div class="col-md-6 offset-3 text-center">
            <input type="submit" value="Change" class="btn btn-primary w-100">
          </div>
    </form>
@endsection
