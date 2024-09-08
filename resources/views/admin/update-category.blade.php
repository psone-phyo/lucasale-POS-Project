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
                  @if ($item->id == $id)
                  <form class="" action="{{route('editform', $id)}}" method="POST">
                  <td> @csrf
                    <input type="text" class="m-0 font-weight-bold text-primary border-0 w-auto  @error('updateCategory') is-invalid @enderror" name="updateCategory" autofocus value="{{$item->name}}">
                    </td>
                    <td>{{$item->created_at}}</td>
                    <td>{{$item->updated_at}}</td>
                    <td class="">
                      <input type="submit" class="btn btn-secondary" value="Update">
                    </td>
                  </form>
                  @else
                        <td>{{ $item->name }}</td>
                      <td>{{$item->created_at}}</td>
                      <td>{{$item->updated_at}}</td>
                      <td class="">
                        <a href="{{route('editform', $item->id)}}" class="btn btn-outline-secondary mb-1"><i class="fa-solid fa-pen"></i></a>
                    <a href="{{route('deleteCategory', $item->id )}}" class="btn btn-outline-danger"><i class="fa-solid fa-trash"></i></a>
                      </td>
                  @endif
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
        @foreach ($data as $item)
        <div class="card-header bg-white py-3 mb-2 gap-2 d-flex justify-content-between align-items-center ">
            @if ($item->id == $id)
            <form class=" d-flex justify-content-between align-items-center" action="{{route('editform', $id)}}" method="POST">
                @csrf
                <input type="text" class="m-0 font-weight-bold text-primary border-0 w-auto  d-block @error('updateCategory') is-invalid @enderror" name="updateCategory" autofocus value="{{$item->name}}">
                <input type="submit" class="btn btn-secondary" value="Update">
            </form>
            @else
            <p class="m-0 font-weight-bold text-primary d-block">{{$item->name}}</p>
            <div class="">
                <a href="{{route('editform', $item->id)}}" class="btn btn-secondary"><i class="fa-solid fa-pen"></i></a>
                <a href="{{route('deleteCategory', $item->id )}}" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
            </div>
            @endif
        </div>
        @endforeach
        </div>

    </div>
</div>

@endsection
