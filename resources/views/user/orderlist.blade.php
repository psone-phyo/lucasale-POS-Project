@extends('user.layout.master')

@section('title', 'orderlist')

@section('content')
<div class="card-body" style="margin-top:200px">
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th class="bg-primary">ID</th>
                    <th class="bg-primary">Order Code</th>
                    <th class="bg-primary">Status</th>
                    <th class="bg-primary">Created_at</th>
                </tr>
            </thead>
            <tbody>
                @if (count($orderlist) == 0)
                <tr>
                    <td colspan="7" class="text-center fs-3 text-muted">
                        There is no data.
                    </td>
                </tr>

                @else
                    @foreach ($orderlist as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->order_code}}</td>
                        @if ($item->status == 0)
                        <td><span class="btn bg-warning text-center text-white me-2">Pending...</span><i class="fa-regular fa-clock text-warning fs-5"></i></td>
                        @elseif($item->status == 1)
                        <td><span class="btn bg-success text-center text-white me-2">Approved</span><i class="fa-solid fa-check-double text-success fs-5"></i></td>
                        @else
                        <td><span class="btn bg-danger text-center text-white me-2">Rejected</span><i class="fa-solid fa-xmark text-danger fs-5"></i></td>
                        @endif
                        <td>{{$item->created_at->format('j-F-Y')}}</td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
