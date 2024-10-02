@extends('admin.layout.master')

@section('content')
@session('success')
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>{{session('success')}}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endsession

<h1 class="h3 mb-0 text-gray-800 text-center mb-3">Sales</h1>

<form action="{{route('saleinformation')}}" method="Get" class="d-flex justify-content-between align-items-center mb-3">
    @csrf
    <input type="search" placeholder="Search..." class="form-control m-1" name="searchKey" value="{{ request('searchKey')}}">
    <input type="submit" value="Search" class=" btn btn-outline-primary m-1">
</form>
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-end mb-2">
            <div class="text-primary fw-bold">
                Total Sale Amount : {{$total}} MMK
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="bg-primary">Date</th>
                        <th class="bg-primary">Order Code</th>
                        <th class="bg-primary">Customer Name</th>
                        <th class="bg-primary">Status</th>
                        <th class="bg-primary">Total Amount</th>

                    </tr>
                </thead>
                <tbody>
                    @if (count($data) == 0)
                    <td colspan="5" class="text-center fs-4 text-muted">There is no sale information...</td>
                @endif
                    @foreach ($data as $item)
                    <tr>
                        <input type="hidden" name="" value="{{$item->order_code}}" class="order_code">
                        <td>{{$item->created_at->format('j-F-Y')}}</td>
                        <td><a href="{{route('orderdetails', $item->order_code)}}">{{$item->order_code}}</a></td>
                        <td>{{$item->name ?? $item->nickname}}</td>
                        <td>
                            @if ($item->status == 0)
                            <span class="btn bg-warning text-center text-white me-2">Pending</span><i class="fa-regular fa-clock text-warning"></i>
                            @elseif($item->status == 1)
                            <span class="btn bg-success text-center text-white me-2">Approved</span><i class="fa-solid fa-check-double text-success"></i>
                            @else
                            <span class="btn bg-danger text-center text-white me-2">Rejected</span><i class="fa-solid fa-xmark text-danger"></i>
                            @endif
                        </td>
                        <td>{{$item->total}} MMK</td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-end">
            <div>
                {{$data->links()}}
            </div>
        </div>
    </div>

</div>
@endsection
