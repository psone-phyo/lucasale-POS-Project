@extends('admin.layout.master')

@section('content')
<!-- DataTales Example -->
<div class="card shadow mb-4 col-5">
    <div class="card-header py-3">
        <div class="">
            <div class="">
                <h6 class="m-0 font-weight-bold text-primary">Add Category Page</h6>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Category Name</label>
            <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Drinks...">
        </div>

        <input type="submit" value="Create" class="btn btn-primary">
    </div>
</div>
@endsection
