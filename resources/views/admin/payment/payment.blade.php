@extends('admin.layout.master')

@section('content')
@session('success')
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>{{session('success')}}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endsession

<h1 class="text-center">Add Payment Method<hr class="bg-primary"></h1>
<form action="{{route('paymentstore')}}" method="POST" enctype="multipart/form-data" class="mb-5">
    @csrf
    <div class="row d-flex justify-content-center align-items-center m-auto w-75 shadow-sm p-5">
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
                        <button type="submit" class="btn btn-primary w-100">Create</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</form>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="bg-primary">ID</th>
                        <th class="bg-primary">Account Name</th>
                        <th class="bg-primary">Account Type</th>
                        <th class="bg-primary">Account Number</th>
                        <th class="bg-primary"></th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->account_name}}</td>
                        <td>{{$item->account_type}}</td>
                        <td>{{$item->account_number}}</td>
                            <td class="text-center">
                                <a href="{{route('editpayment',$item->id)}}" class=" text-secondary fs-5 me-2"><i class="fa-regular fa-pen-to-square"></i></a>
                                <a href="{{route('deletepayment',$item->id)}}" class=" text-danger fs-5"><i class="fa-solid fa-trash"></i></a>
                            </td>
                    </tr>
                    @endforeach


                </tbody>
            </table>
            <div class="d-flex justify-content-end align-items-center">
                <div>
                {{$data->links()}}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
