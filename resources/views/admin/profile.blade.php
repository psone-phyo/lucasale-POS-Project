@extends('admin.layout.master')

@section('content')

    <div class="row d-flex justify-content-center align-items-center">
        <div class="col-md-3">
            <img src="{{asset('admin/img/undraw_profile_1.svg')}}" alt="">
        </div>
        <div class="col mt-3">
            <form class="row g-3">
                <div class="col-md-6">
                  <label for="username" class="form-label mb-0">Username</label>
                  <input type="text" class="form-control" id="username" placeholder="Enter username...">
                </div>
                <div class="col-md-6 mb-3">
                  <label for="nickname" class="form-label mb-0">Nickname</label>
                  <input type="text" class="form-control" id="nickname" placeholder="Enter nickname...">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="email" class="form-label mb-0">Email</label>
                    <input type="text" class="form-control" id="email" placeholder="Enter email...">
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="text" class="form-label mb-0">Phone</label>
                    <input type="number" class="form-control" id="phone" placeholder="Enter phone...">
                  </div>
                  <div class="col-12 mb-3">
                    <label for="inputAddress" class="form-label mb-0">Address</label>
                    <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St...">
                  </div>
                <div class=" d-md-flex justify-content-end align-items-center w-100 px-3 text-center">
                    <div class=" d-md-flex justify-content-between align-items-center w-100">
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
                        <button type="submit" class="btn btn-primary mt-1">Sign in</button>
                    </div>
                </div>
              </form>
        </div>
    </div>
@endsection
