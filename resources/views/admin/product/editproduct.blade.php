@extends('admin.layout.master')

@section('content')
@session('success')
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>{{session('success')}}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endsession

<h1 class="text-center">Edit Product<hr class="bg-primary"></h1>
<form action="{{route('editproduct', $data->id)}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col-lg-3">
            <input type="hidden" name="oldphoto" value="{{$data->photo}}">
            <img src="{{asset('product/' . $data->photo)}}" alt="" id=output class="mb-2 w-100">
            <div class="input-group">
                <input type="file" class="form-control" id="inputGroupFile02" name="image" onchange="loadFile(event)">
            </div>
            @error('image')
            <small class="text-danger">{{ $message }}</small>
          @enderror
        </div>
        <div class="col mt-3">
            <div class="row g-3">
                <div class="col-md-6">
                  <label for="name" class="form-label mb-0">Product Name</label>
                  <input type="text" class="form-control" id="name" placeholder="Enter product name..." name="name" value="{{old('name', $data->name)}}">
                  @error('name')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label mb-0" for="inlineFormSelectPref">Category</label>
                    <select class="form-select " id="inlineFormSelectPref" name="category">
                      <option selected class=" text-muted" value="">Choose product category</option>
                      @foreach ($category as $item)
                        <option value="{{$item->id}}" @if (old('category', $data->category_id) == $item->id)
                            selected
                        @endif>{{$item->name}}</option>
                      @endforeach
                    </select>
                    @error('category')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>
                <div class="col-md-6">
                    <label for="price" class="form-label mb-0">Price (MMK)</label>
                    <input type="text" class="form-control" id="price" placeholder="Enter unit price..." name="price" value="{{old('price', $data->price)}}">
                    @error('price')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>
                  <div class="col-md-6">
                    <label for="stock" class="form-label mb-0">Stock</label>
                    <input type="text" class="form-control" id="stock" placeholder="Enter stock..." name="stock" value="{{old('stock', $data->stock)}}">
                    @error('stock')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                  </div>
                  <div class="col-12">
                    <label for="description" class="form-label mb-0">Description</label>
                    <textarea class="form-control" id="description" placeholder="Enter description..." name="description">{{old('description', $data->description)}}</textarea>
                    @error('description')
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
                        <button type="submit" class="btn btn-primary w-50">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</form>
@endsection
