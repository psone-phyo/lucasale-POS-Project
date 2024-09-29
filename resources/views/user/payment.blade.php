@extends('user.layout.master')

@section('title', 'payment')

@section('content')

<div class="" style="margin-top: 200px">
    <div class="row w-75 shadow-sm m-auto">
        <div class="col-sm-12 col-md-6">
            <strong>Pay with Any</strong>
            @foreach ($banktype as $item)
                <div class="my-2">
                    <div class="my-1"><strong class="text-warning">{{$item->account_type}}</strong> (Account Name: <strong>{{$item->account_name}}</strong>)</div>
                    <div>Account Number: <b>{{$item->account_number}}</b></div>
                </div>
                <hr>
            @endforeach
        </div>
        <div class="col-sm-12 col-md-6">
            <h3><strong>User Info</strong></h3>
            <form action="{{route('order')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class=" col ps-2 d-flex justify-content-center align-items-center bg-light rounded-3">
                        <div class=" fw-bold">
                            Name: {{Auth::user()->name ?? Auth::user()->nickname}}
                        </div>
                    </div>
                      <div class="form-floating col ps-2">
                        <input type="text" class="form-control" id="floatingPassword" placeholder="Password" name="phone" value="{{old('phone')}}">
                        <label for="floatingPassword">Phone</label>
                        @error('phone')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                      </div>
                      <div class="form-floating col-12 ps-2 my-2">
                        <input type="text" class="form-control" id="floatingaddress" placeholder="Password" name="address" value="{{old('address')}}">
                        <label for="floatingaddress">Address</label>
                        @error('address')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                      </div>
                      <div class="input-group my-2">
                        <label class="input-group-text" for="inputGroupSelect01">Payment Method</label>
                        <select class="form-select" id="inputGroupSelect01" name="paymentmethod" name="paymentmethod">
                          <option value="" selected>Choose payment method...</option>
                          @foreach ($banktype as $item)
                            <option value="{{$item->account_type}}" @if ($item->id == old('paymentmethod'))
                                selected
                            @endif>{{$item->account_type}}</option>
                          @endforeach
                        </select>
                      </div>
                      @error('paymentmethod')
                      <small class="text-danger">{{$message}}</small>
                    @enderror

                      <div class="input-group mt-3 mb-1">
                        <label class="input-group-text bg-white" for="inputGroupFile01">Add Payment Slip</label>
                        <input type="file" class="form-control bg-white" id="inputGroupFile01" name="paymentslip">
                      </div>
                      @error('paymentslip')
                      <small class="text-danger">{{$message}}</small>
                    @enderror

                    </div>
                    <div class="row mt-3">
                        <input type="hidden" name="ordercode" value="{{$ordercart[0]['order_code']}}">
                        <input type="hidden" name="totalamount" value="{{$ordercart[0]['total_amt']}}">
                        <div class="col">Order Code : <span class="text-warning">{{$ordercart[0]['order_code']}}</span></div>
                        <div class="col">Total Amount : <strong class="text-bold">{{$ordercart[0]['total_amt']}} MMK</strong></div>
                    </div>
                    <div class="my-3">
                        <input type="submit" value="Order" class="btn btn-outline-success w-100">
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>


@endsection
