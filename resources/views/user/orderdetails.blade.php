@extends('user.layout.master')

@section('title', 'Order Details')

@section('content')

    <div class="" style="margin-top:10%;">
        <a href="{{ route('user#orderlist') }}" class="fs-5 ms-5"><i class="fa-solid fa-arrow-left"></i>Back</a>

        <h1 class="text-center text-decoration-underline">Order Details</h1>
        <div class="row mt-5 d-flex justify-content-center">
            <div class="col-5 me-5">
                <div class="row bg-white shadow-sm rounded-5 p-5">
                    <div class="col-5 my-2 ">
                        Name
                    </div>
                    <div class="col-7 my-2">
                        : {{ $orderdetails[0]['user_name'] ?? $orderdetails[0]['nickname'] }}
                    </div>

                    <div class="col-5 my-2">
                        Phone
                    </div>
                    <div class="col-7 my-2">
                        : {{ $orderdetails[0]['phone'] }}
                    </div>

                    <div class="col-5 my-2">
                        Order Code
                    </div>
                    <div class="col-7 my-2">
                        : {{ $orderdetails[0]['order_code'] }}
                    </div>
                    <input type="hidden" value="{{ $orderdetails[0]['order_code'] }}" id='order_code'>

                    <div class="col-5 my-2">
                        Order Date
                    </div>
                    <div class="col-7 my-2">
                        : {{ $orderdetails[0]['created_at']->format('j-F-Y') }}
                    </div>

                    <div class="col-5 my-2 fw-bold">
                        Contact Phone
                    </div>
                    <div class="col-7 my-2 fw-bold">
                        : {{ $slipdata->phone }}
                    </div>

                    <div class="col-5 my-2 fw-bold">
                        Address
                    </div>
                    <div class="col-7 my-2 fw-bold">
                        : {{ $slipdata->address }}
                    </div>

                    <div class="col-5 my-2 fw-bold">
                        Payment Method
                    </div>
                    <div class="col-7 my-2 fw-bold">
                        : {{ $slipdata->payment_type }}
                    </div>

                    <div class="col-5 my-2 fw-bold">
                        Total
                    </div>
                    <div class="col-7 my-2 fw-bold">
                        : {{ $slipdata->total_amt }} MMK
                        <div>
                            <small class="text-danger">(contains delivery fees)</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-5 ms-5 bg-white shadow-sm  rounded-5 p-2 text-center">
                <img src="{{ asset('paymentslip/' . $slipdata->payslip_image) }}" alt="" class="" height="100%">
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
                                <th class="bg-primary">Unit Price</th>
                                <th class="bg-primary">Total Amount</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orderdetails as $item)
                                <tr>
                                    <td class="text-center"><img src="{{ asset('product/' . $item->photo) }}" alt=""
                                            class="" width="150px" height="100%"></td>
                                    <td>{{ $item->product_name }}</td>
                                    <td>
                                        <div class=" btn btn-light">
                                            {{ $item->count }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class=" btn btn-light">
                                            {{ $item->price }} MMK
                                        </div>
                                    </td>
                                    <td>
                                        <div class=" btn btn-light">
                                            {{ $item->price * $item->count }} MMK
                                        </div>
                                    </td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-end align-items-center">
                    @if ($orderdetails[0]['status'] == 1)
                        <button type="button" class="btn me-2 text-success">
                            Already Approved<i class="fa-solid fa-check-double text-success ms-2"></i>
                        </button>
                    @elseif ($orderdetails[0]['status'] == 0)
                        <button type="button" class="btn me-2 text-warning">
                            Pending<i
                            class="fa-regular fa-clock text-warning ms-2"></i>
                        </button>
                    @else
                        <button type="button" class="btn me-2 text-danger">
                        Rejected<i
                        class="fa-solid fa-xmark text-danger"></i>
                    </button>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
