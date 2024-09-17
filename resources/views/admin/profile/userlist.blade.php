@extends('admin.layout.master')

@section('content')
<form action="{{route('userlist')}}" method="Get" class="d-flex justify-content-between align-items-center mb-3">
    @csrf
    <input type="search" placeholder="Search..." class="form-control m-1" name="searchKey" value="{{ request('searchKey')}}">
    <input type="submit" value="Search" class=" btn btn-outline-primary m-1">
</form>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="d-flex justify-content-between">
            <div class="">
                <h6 class="m-0 font-weight-bold text-primary">User List</h6>
            </div>
            <div class="">
                <a href="{{route('adminlist')}}"><i class="fa-solid fa-person-running"></i>Admin List</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Nickname</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Role</th>
                        <th>Log in Method</th>
                        <th>Created at</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($data) == 0)
                    <tr>
                        <td colspan="9" class="text-center fs-3 text-muted">
                            There is no data found.
                        </td>
                    </tr>

                    @else
                    @foreach ($data as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->name?? '-'}}</td>
                        <td>{{$item->nickname?? '-'}}</td>
                        <td>{{$item->email}}</td>
                        <td>{{$item->phone?? '-'}}</td>
                        <td class="text-primary">{{$item->role}}</td>
                        <td>{{$item->provider?? '-'}}</td>
                        <td>{{$item->created_at}}</td>
                        <td class="text-center"><a href="{{Route('listdelete', $item->id)}}" class="btn btn-outline-danger"><i class="fa-sharp fa-solid fa-trash"></i></a></td>
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
