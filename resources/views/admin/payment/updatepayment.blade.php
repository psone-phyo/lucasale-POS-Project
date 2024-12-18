@extends('admin.layout.master')

@section('content')
<h1 class="text-center">Edit Payment Method<hr class="bg-primary"></h1>
<form action="{{route('editpayment', $data->id)}}" method="POST" enctype="multipart/form-data" class="">
    @csrf
    <div class="row d-flex justify-content-center align-items-center m-auto w-75 shadow-sm p-5">
        <div class="col mt-3">
            <div class="row g-3">
                <div class="col-md-6">
                  <label for="name" class="form-label mb-0">Account Name</label>
                  <input type="text" class="form-control" id="name" placeholder="Enter account name..." name="name" value="{{old('name', $data->account_name)}}">
                  @error('name')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>
                <div class="col-md-6">
                    <label for="price" class="form-label mb-0">Payment Type</label>
                    <input type="text" class="form-control" id="price" placeholder="Enter payment type..." name="type" value="{{old('type',$data->account_type)}}">
                    @error('type')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>
                  <div class="col-md-12">
                    <label for="stock" class="form-label mb-0">Card number</label>
                    <input type="text" class="form-control" id="stock" placeholder="Enter card number..." name="number" value="{{old('number',$data->account_number)}}">
                    @error('number')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                  </div>
                <div class=" d-flex justify-content-end align-items-center w-100 text-center">
                    <div class=" d-flex justify-content-between align-items-center w-100">
                        <button type="submit" class="btn btn-primary w-100">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</form>


@endsection
