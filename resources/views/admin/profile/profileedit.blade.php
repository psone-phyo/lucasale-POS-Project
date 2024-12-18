@extends('admin.layout.master')

@section('content')

<form action="{{route('profileedit')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col-lg-3">
            <img src="{{Auth::user()->profile ? asset('admin/img/'. Auth::user()->profile) : asset('admin/img/undraw_profile_2.svg')}}" alt="" id=output class="mb-2 w-100">
            <div class="input-group">
                <input type="file" class="form-control" id="inputGroupFile02" name="profile" onchange="loadFile(event)">
            </div>
        </div>
        <div class="col mt-3">
            <div class="row g-3">
                <div class="col-md-6">
                  <label for="username" class="form-label mb-0">Username</label>
                  <input type="text" class="form-control" id="username" placeholder="Enter username..." name="username" value="{{old('username',Auth::user()->name)}}">
                  @error('username')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>
                <div class="col-md-6">
                  <label for="nickname" class="form-label mb-0">Nickname</label>
                  <input type="text" class="form-control" id="nickname" placeholder="Enter nickname..." name="nickname" value="{{old('nickname',Auth::user()->nickname)}}">
                  @error('nickname')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>
                <div class="col-md-6">
                    <label for="email" class="form-label mb-0">Email</label>
                    <input type="text" class="form-control" id="email" placeholder="Enter email..." name="email" value="{{old('email',Auth::user()->email)}}">
                    @error('email')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>
                  <div class="col-md-6">
                    <label for="phone" class="form-label mb-0">Phone</label>
                    <input type="text" class="form-control" id="phone" placeholder="Enter phone..." name="phone" value="{{old('phone',Auth::user()->phone)}}">
                    @error('phone')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                  </div>
                  <div class="col-12">
                    <label for="inputAddress" class="form-label mb-0">Address</label>
                    <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St..." name="address" value="{{old('address',Auth::user()->address)}}">
                    @error('address')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                  </div>
                <div class=" d-flex justify-content-end align-items-center w-100 text-center">
                    <div class=" d-flex justify-content-between align-items-center w-100">
                        <div class=" ">
                            <a class=" btn btn-dark" href="{{route('profile')}}">
                                Back to profile
                            </a>
                        </div>
                        <button type="submit" class="btn btn-primary w-50">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</form>
@endsection
