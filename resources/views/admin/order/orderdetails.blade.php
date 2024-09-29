@extends('admin.layout.master')

@section('content')
<a href="{{route('orderlist')}}" class="fs-5"><i class="fa-solid fa-arrow-left"></i>Back</a>
<h1 class="text-center text-decoration-underline">Pyament Details</h1>
<div class="row mt-5" style="width:90%;margin:auto;">
    <div class="col-5 me-5">
        <div class="row bg-white shadow-sm rounded-5 p-5">
            <div class="col-5 my-2 ">
                Name
            </div>
            <div class="col-7 my-2">
                : {{$orderdetails[0]['user_name'] ?? $orderdetails[0]['nickname']}}
            </div>

            <div class="col-5 my-2">
                Phone
            </div>
            <div class="col-7 my-2">
                : {{$orderdetails[0]['phone']}}
            </div>

            <div class="col-5 my-2">
                Order Code
            </div>
            <div class="col-7 my-2">
                : {{$orderdetails[0]['order_code']}}
            </div>
            <input type="hidden" value="{{$orderdetails[0]['order_code']}}" id='order_code'>

            <div class="col-5 my-2">
                Order Date
            </div>
            <div class="col-7 my-2">
                : {{$orderdetails[0]['created_at']->format('j-F-Y')}}
            </div>

            <div class="col-5 my-2 fw-bold">
                Contact Phone
            </div>
            <div class="col-7 my-2 fw-bold">
                : {{$slipdata->phone}}
            </div>

            <div class="col-5 my-2 fw-bold">
                Address
            </div>
            <div class="col-7 my-2 fw-bold">
                : {{$slipdata->address}}
            </div>

            <div class="col-5 my-2 fw-bold">
                Payment Method
            </div>
            <div class="col-7 my-2 fw-bold">
                : {{$slipdata->payment_type}}
            </div>

            <div class="col-5 my-2 fw-bold">
                Total
            </div>
            <div class="col-7 my-2 fw-bold">
                : {{$slipdata->total_amt}} MMK
                <div>
                    <small class="text-danger">(contains delivery fees)</small>
                </div>
            </div>
        </div>
    </div>
    <div class="col-5 ms-5 bg-white shadow-sm  rounded-5 p-2 text-center">
        <img src="{{asset('paymentslip/'. $slipdata->payslip_image)}}" alt=""  class="" height="100%">
    </div>
</div>

<div class="card shadow mb-4 mt-5">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="bg-primary">Product Image</th>
                        <th class="bg-primary">Product Name</th>
                        <th class="bg-primary">Quantity</th>
                        <th class="bg-primary">Available Stock</th>
                        <th class="bg-primary">Unit Price</th>
                        <th class="bg-primary">Total Amount</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($orderdetails as $item)
                    <tr>
                        <td class="text-center"><img src="{{ asset('product/'. $item->photo) }}" alt="" class="" width="150px" height="100%"></td>
                        <td>{{ $item->product_name }}</td>
                        <td>
                            <button type="button" class="btn btn-secondary">
                                {{$item->count}}
                                @if ($item->count > $item->stock)
                                <span class="badge text-bg-danger">Insufficient stock</span>
                                @endif
                              </button>
                        </td>
                        <td>
                            <div class=" btn btn-secondary">
                            {{ $item->stock }}
                            @if ($item->stock == 0)
                                <span class="badge text-bg-danger">Out of Stock</span>
                                @endif
                            </div>
                        </td>
                        <td>
                            <div class=" btn btn-light">
                            {{ $item->price }} MMK
                            </div>
                        </td>
                        <td>
                            <div class=" btn btn-light">
                                {{ $item->price *  $item->count}} MMK
                                </div>
                        </td>
                    </tr>
                    @endforeach


                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-end align-items-center">
            <button type="button" class="btn btn-danger me-2" id="reject">
                Reject
            </button>
            <button type="button" class="btn btn-success" id="approve">
                Approve
            </button>

        </div>
    </div>
</div>

@endsection

@section('jquery')
<script>

    $(document).ready(function(){
        $('#approve').click(function(){
            $order_code = $('#order_code').val();

            $data = {
                'order_code' : $order_code,
                'status' : 1
            }

            $.ajax({
                type : 'get',
                url: '/admin/order/statuschange',
                data: $data,
                dataType : 'json',
                success: function(res){
                    res.status == 'success' ? location.href = '/admin/order/orderlist' : ''
                }
            })
        })

        $('#reject').click(function(){
            $order_code = $('#order_code').val();

            $data = {
                'order_code' : $order_code,
                'status' : 2
            }

            $.ajax({
                type : 'get',
                url: '/admin/order/statuschange',
                data: $data,
                dataType : 'json',
                success: function(res){
                    res.status == 'success' ? location.href = '/admin/order/orderlist' : ''
                }
            })
        })
    })
</script>
@endsection
