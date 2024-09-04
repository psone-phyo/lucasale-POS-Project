@extends('admin.layout.master')

@section('content')
<!-- DataTales Example -->
<div class="row">
    <div class="card shadow mb-4 col-5">
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
    <div class="col-7">
        @foreach ($data as $item)
        <div class="card-header bg-white py-3 mb-2 gap-2 d-md-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">{{ $item->name }}</h6>
            <div>
                <a href="{{route('editform', $item->id)}}" class="btn btn-secondary"><i class="fa-solid fa-pen"></i></a>
                <a href="{{route('deleteCategory', $item->id    )}}" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
            </div>
        </div>
        @endforeach


    </div>
</div>

@endsection
