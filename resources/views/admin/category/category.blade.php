@extends('admin.layout.master')

@section('content')
<!-- DataTales Example -->
<div class="row">
    <div class="card shadow mb-4 col-lg-5  h-25">
        <div class="card-header bg-white py-3">
            <h6 class="m-0 font-weight-bold text-primary">Add Category Page</h6>
        </div>
        <div class="card-body">

            <form class="mb-3" action="{{route('category')}}" method="POST">
                @csrf
                <label for="exampleFormControlInput1" class="form-label">Category Name</label>

                <input type="text" class="form-control @error('category') is-invalid @enderror"  name="category" id="exampleFormControlInput1" placeholder="Fruits, Drinks,...">
                @error('category')
                <small class="text-danger">{{ $message }}</small>
                @enderror
                <input type="submit" value="Create" class="btn btn-primary mt-3 d-block">
            </form>
        </div>
    </div>
    <div class="col-lg-7">
        <form action="{{route('category')}}" method="Get" class="d-flex justify-content-between align-items-center mb-3">
            @csrf
            <input type="search" placeholder="Search..." class="form-control m-1" name="searchKey" value="{{ request('searchKey')}}">
            <input type="submit" value="Search" class=" btn btn-outline-primary m-1">
        </form>
<<<<<<< HEAD:resources/views/admin/category.blade.php

        <div class="category">
        <table class="table table-bordered table-striped fs-6 ">
                <tr class="text-primary">
                  <th scope="col">ID</th>
                  <th scope="col">Category Name</th>
                  <th scope="col">Created at</th>
                  <th scope="col">Updated at</th>
                </tr>
                @foreach ($data as $item)
                <tr class="text-dark">
                  <th scope="row">{{$item->id}}</th>
                  <td>{{$item->name}}</td>
                  <td>{{$item->created_at}}</td>
                  <td>{{$item->updated_at}}</td>
                  <td class="">
                    <a href="{{route('editform', $item->id)}}" class="btn btn-outline-secondary"><i class="fa-solid fa-pen"></i></a>
                <a href="{{route('deleteCategory', $item->id )}}" class="btn btn-outline-danger"><i class="fa-solid fa-trash"></i></a>
                  </td>
                </tr>
                @endforeach
          </table>
          <div class="d-flex justify-content-end align-content-center">
            <div>
              {{$tbdata->links()}}
            </div>
        </div>
    </div>


        <div class="d-none phone-category">
=======
        @if (count($data) == 0)
            <div class="fs-3 text-muted text-center">
                There is no data found.
            </div>

        @else
>>>>>>> 3aa2a25:resources/views/admin/category/category.blade.php
        @foreach ($data as $item)
        <div class="card-header bg-white py-3 mb-2 gap-2 d-flex justify-content-between align-items-center ">
            <p class="m-0 font-weight-bold text-primary">{{$item->name}}</p>
            <div class="">
                <a href="{{route('editform', $item->id)}}" class="btn btn-secondary"><i class="fa-solid fa-pen"></i></a>
                <a href="{{route('deleteCategory', $item->id )}}" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
            </div>
        </div>
        @endforeach
<<<<<<< HEAD:resources/views/admin/category.blade.php
        </div>
=======
        @endif
>>>>>>> 3aa2a25:resources/views/admin/category/category.blade.php

    </div>
</div>

@endsection
