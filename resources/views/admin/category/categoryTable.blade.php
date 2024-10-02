@extends('admin.layout.master')

@section('content')
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="d-flex justify-content-between">
            <div class="">
                <h6 class="m-0 font-weight-bold text-primary">Category List</h6>
            </div>
            <div class="">
                <a href="{{route('category')}}"><i class="fa-solid fa-plus"></i> Add Category</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="d-flex justify-content-end align-items-center">
            <div class="mb-3">
                <span class="btn btn-primary">{{$count}}</span> Categories
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Category Name</th>
                        <th>Created at</th>
                        <th>Updated at</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->created_at}}</td>
                        <td>{{$item->updated_at}}</td>
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
