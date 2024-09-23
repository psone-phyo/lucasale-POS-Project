@extends('admin.layout.master')

@section('content')
@session('success')
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>{{session('success')}}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endsession

<h1 class="text-center">Add Product<hr class="bg-primary"></h1>
<form action="{{route('paymentstore')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col mt-3">
            <div class="row g-3">
                <div class="col-md-6">
                  <label for="name" class="form-label mb-0">Account Name</label>
                  <input type="text" class="form-control" id="name" placeholder="Enter account name..." name="name" value="{{old('name')}}">
                  @error('name')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>
                <div class="col-md-6">
                    <label for="price" class="form-label mb-0">Payment Type</label>
                    <input type="text" class="form-control" id="price" placeholder="Enter payment type..." name="type" value="{{old('type')}}">
                    @error('type')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>
                  <div class="col-md-12">
                    <label for="stock" class="form-label mb-0">Card number</label>
                    <input type="text" class="form-control" id="stock" placeholder="Enter card number..." name="number" value="{{old('number')}}">
                    @error('number')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                  </div>
                <div class=" d-flex justify-content-end align-items-center w-100 text-center">
                    <div class=" d-flex justify-content-between align-items-center w-100">
                        <div class=" ">
                            <a class=" btn btn-dark" href="{{route('productlist')}}">
                                Product List <i class="fa-solid fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                        <button type="submit" class="btn btn-primary w-50">Create</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</form>
@endsection
