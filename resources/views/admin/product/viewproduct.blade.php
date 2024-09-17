@extends('admin.layout.master')

@section('content')
@session('success')
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Product is successfully Updated.</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endsession

<h1 class="text-center">Edit Product<hr class="bg-primary"></h1>
<div class="m-auto">
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col-lg-3 offset-lg-2">
            <img src="{{asset('admin/img/product/'. $data->photo)}}" alt="" class="mb-2 w-100">
        </div>
        <div class="col mt-3 offset-lg-1">
            <div class="row g-3">
                <div class="col-12">
                    <div class="">
                        Product ID : <span class="text-info">{{$data->id}}</span>
                    </div>
                </div>
                <div class="col-12">
                    <div class="">
                        Product Name : <span class="text-info">{{$data->product_name}}</span>
                    </div>
                </div>
                <div class="col-12">
                    <div class="">
                        Product Stock : <span class="text-info">{{$data->stock}}</span>
                    </div>
                </div>
                  <div class="col-12">
                    <div class="">
                        Product Unit Price : <span class="text-info">{{$data->price}}</span>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="">
                        Product Category : <span class="text-info">{{$data->category_name}}</span>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="">
                        Product Description : <span class="text-info">{{$data->description}}</span>
                    </div>
                  </div>
                <div class=" d-flex justify-content-end align-items-center w-100 text-center">
                    <div class=" d-flex justify-content-between align-items-center w-100">
                        <div class=" ">
                            <a class=" btn btn-dark" href="{{route('productlist')}}">
                                Product List <i class="fa-solid fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
