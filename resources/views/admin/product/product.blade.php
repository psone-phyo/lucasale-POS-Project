@extends('admin.layout.master')

@section('content')
@session('success')
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>{{session('success')}}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endsession
<div class="row">
    <div class="col">
        <a href="{{route('productlist')}}" class="btn btn-outline-primary">All Products</a>
        <a href="{{route('productlist', 'lowamount')}}" class="btn btn-outline-danger">Low Stock Products List</a>
    </div>
    <div class="col">
        <form action="{{route('productlist')}}" method="Get" class="d-flex justify-content-between align-items-center">
            @csrf
            <input type="search" placeholder="Search..." class="form-control m-1" name="searchKey" value="{{ request('searchKey')}}">
            <input type="submit" value="Search" class=" btn btn-outline-primary m-1">
        </form>
    </div>
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="d-flex justify-content-between">
            <div class="">
                <h6 class="m-0 font-weight-bold text-primary">Product List</h6>
            </div>
            <div class="">
                <a href="{{route('createproduct')}}"><i class="fa-solid fa-plus"></i> Add Product</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="bg-primary">ID</th>
                        <th class="bg-primary">Image</th>
                        <th class="bg-primary">Product Name</th>
                        <th class="bg-primary">Stock</th>
                        <th class="bg-primary">Category Name</th>
                        <th class="bg-primary">Unit Price</th>
                        <th class="bg-primary"> Tools</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($data) == 0)
                    <tr>
                        <td colspan="7" class="text-center fs-3 text-muted">
                            There is no data found.
                        </td>
                    </tr>

                    @else
                        @foreach ($data as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td class="text-center">
                                <img src="{{asset('admin/img/product/'. $item->photo)}}" alt="" width="100px" height="70px">
                            </td>
                            <td>{{$item->product_name}}</td>
                            <td>
                                <div class="btn btn-primary position-relative w-75">
                                    {{$item->stock}}
                                    @if ($item->stock <= 3)
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        Low Stock
                                        <span class="visually-hidden">unread messages</span>
                                      </span>
                                    @endif
                                  </button>
                                </td>
                            <td>{{$item->category_name}}</td>
                            <td>{{$item->price}} MMK</td>
                            <td class="text-center">
                                <a href="{{route('viewproduct',$item->id)}}" class=" fs-5 me-2"><i class="fa-solid fa-eye"></i></a>
                                <a href="{{route('editproduct',$item->id)}}" class=" text-secondary fs-5 me-2"><i class="fa-regular fa-pen-to-square"></i></a>
                                <a href="{{route('productdelete',$item->id)}}" class=" text-danger fs-5"><i class="fa-solid fa-trash"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    @endif
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
