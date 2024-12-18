@extends('admin.layout.master')

@section('content')
@session('success')
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>{{session('success')}}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endsession
<h1 class="h3 mb-0 text-gray-800 text-center mb-3">Order Board</h1>

<form action="{{route('orderlist')}}" method="Get" class="d-flex justify-content-between align-items-center mb-3">
    @csrf
    <input type="search" placeholder="Search..." class="form-control m-1" name="searchKey" value="{{ request('searchKey')}}">
    <input type="submit" value="Search" class=" btn btn-outline-primary m-1">
</form>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="bg-primary">Date</th>
                        <th class="bg-primary">Order Code</th>
                        <th class="bg-primary">Customer Name</th>
                        <th class="bg-primary">Select action</th>
                        <th class="bg-primary">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($data) == 0)
                        <td colspan="5" class="text-center fs-4 text-muted">There is no order pending...</td>
                    @endif
                    @foreach ($data as $item)
                    <tr>
                        <input type="hidden" name="" value="{{$item->order_code}}" class="order_code">
                        <td>{{$item->created_at->format('j-F-Y')}}</td>
                        <td><a href="{{route('orderdetails', $item->order_code)}}">{{$item->order_code}}</a></td>
                        <td>{{$item->name ?? $item->nickname}}</td>
                        <td>
                            <select id="inputState" class="form-select status" @if ($item->status == 1) disabled @endif>
                                <option @if ($item->status == 0) selected @endif value="0">Pending</option>
                                {{-- <option @if ($item->status == 1) selected @endif value="1">Approve</option> --}}
                                <option @if ($item->status == 2) selected @endif value="2">Reject</option>
                            </select>
                        </td>
                        <td>
                            @if ($item->status == 0)
                            <span class="btn bg-warning text-center text-white me-2">Pending</span><i class="fa-regular fa-clock text-warning"></i>
                            @elseif($item->status == 1)
                            <span class="btn bg-success text-center text-white me-2">Approved</span><i class="fa-solid fa-check-double text-success"></i>
                            @else
                            <span class="btn bg-danger text-center text-white me-2">Rejected</span><i class="fa-solid fa-xmark text-danger"></i>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

@section('jquery')
<script>

    $(document).ready(function(){
        $('.status').change(function(){
            $order_code = $(this).parents('tr').find('.order_code').val();
            $status = $(this).val();

            $data = {
                'order_code' : $order_code,
                'status' : $status
            };

            $.ajax({
                type: 'get',
                url: '/admin/order/statuschange',
                data: $data,
                dataType: 'json',
                success: function(res){
                    res.status == 'success' ? location.reload() : ''
                }
            })


        })
    });

</script>


@endsection
