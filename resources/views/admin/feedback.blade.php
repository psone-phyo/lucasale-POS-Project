@extends('admin.layout.master')

@section('content')
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="bg-primary">User Id</th>
                        <th class="bg-primary">Name</th>
                        <th class="bg-primary">Email</th>
                        <th class="bg-primary">Message</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($feedback) == 0)
                        <td colspan="5" class="text-center fs-4 text-muted">There is no feedback yet...</td>
                    @endif
                    @foreach ($feedback as $item)
                    <tr>
                        <td>{{$item->user_id}}</td>
                        <td>{{$item->user_name}}</td>
                        <td>{{$item->email}}</td>
                        <td>{{$item->message}}</td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection


