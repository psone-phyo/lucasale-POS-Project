@extends('user.layout.master')

@section('title', 'Cart')

@section('content')
<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Cart</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Pages</a></li>
        <li class="breadcrumb-item active text-white">Cart</li>
    </ol>
</div>
<!-- Single Page Header End -->


<!-- Cart Page Start -->
<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="table-responsive">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Products</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Total</th>
                    <th scope="col">Handle</th>
                  </tr>
                </thead>
                <tbody>
                    <input type="hidden" id="userId" value="{{Auth::user()->id}}">
                    @foreach ($cartitems as $item)
                    <tr>
                        <th scope="row">
                            <div class="d-flex align-items-center">
                                <img src="{{asset('product/' . $item->photo)}}" class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;" alt="">
                            </div>
                        </th>
                        <td>
                            <p class="mb-0 mt-4">{{$item->name}}</p>
                        </td>
                        <td>
                            <p class="mb-0 mt-4 price">{{$item->price}} MMK</p>
                        </td>
                        <td>
                            <div class="input-group quantity mt-4" style="width: 100px;">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-minus rounded-circle bg-light border" >
                                    <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                                <input type="text" class="form-control qty form-control-sm text-center border-0 " value="{{$item->quantity}}">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-plus rounded-circle bg-light border">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </td>
                        <td>
                            <p class="mb-0 mt-4 totalAmount">{{$item->quantity * $item->price}}</p>
                        </td>
                        <td>
                            <input type="hidden" class="cartId" value="{{$item->id}}">
                            <input type="hidden" class="productId" value="{{$item->product_id}}">
                            <button class="btn btn-md rounded-circle bg-light border mt-4 btn-remove" >
                                <i class="fa fa-times text-danger"></i>
                            </button>
                        </td>

                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <div class="mt-5">
            <input type="text" class="border-0 border-bottom rounded me-5 py-3 mb-4" placeholder="Coupon Code">
            <button class="btn border-secondary rounded-pill px-4 py-3 text-primary" type="button">Apply Coupon</button>
        </div>
        <div class="row g-4 justify-content-end">
            <div class="col-8"></div>
            <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                <div class="bg-light rounded">
                    <div class="p-4">
                        <h1 class="display-6 mb-4">Cart <span class="fw-normal">Total</span></h1>
                        <div class="d-flex justify-content-between mb-4">
                            <h5 class="mb-0 me-4" >Subtotal:</h5>
                            <p class="mb-0" id='subtotal'>{{$total}} MMK</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h5 class="mb-0 me-4">Delivery</h5>
                            <div class="">
                                <p class="mb-0">5000 MMK</p>
                            </div>
                        </div>
                    </div>
                    <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                        <h5 class="mb-0 ps-4 me-4">Total</h5>
                        <p class="mb-0 pe-4" id='finaltotal'>{{$total + 5000}} MMK</p>
                    </div>
                    <button class="btn btn-checkout border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4 @if (count($cartitems) == 0)
                    disabled
                    @endif" type="button">Proceed Checkout</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Cart Page End -->
@endsection

@section('js-section')
<script>
    $(document).ready(function() {
    $('.btn-minus').click(function() {
        $parentNode = $(this).parents("tr");
        $price = parseInt($parentNode.find(".price").text().trim());
        $qty = parseInt($parentNode.find('.qty').val().trim());
        $totalAmount = $price * $qty;
        $parentNode.find('.totalAmount').text($totalAmount)
        finalCalculation();
    });

    $('.btn-plus').click(function() {
        $parentNode = $(this).parents("tr");
        $price = parseInt($parentNode.find(".price").text().trim());
        $qty = parseInt($parentNode.find('.qty').val().trim());
        $totalAmount = $price * $qty;
        $parentNode.find('.totalAmount').text($totalAmount)
        finalCalculation();
    });

    function finalCalculation() {
        $total = 0;
        $('.table tbody tr').each(function(index, item) {
            $total += parseInt($(item).find('.totalAmount').text());
        });
        $('#subtotal').text($total);
        $('#finaltotal').text($total + 5000);
    }

    $('.btn-remove').click(function() {
        $parentNode = $(this).parents('tr');
        $cartId = $parentNode.find('.cartId').val();
        $data = {
            'cardId': $cartId
        };

        // Delete cart item
        $.ajax({
            type: 'get',
            url: '/user/product/delete',
            data: $data,
            dataType: 'json',
            success: function(response) {
                if (response == '200') {
                    location.reload();
                }
            }
        });
    });

    $('.btn-checkout').click(function() {
        $orderList = [];
        $total_amt = $('#finaltotal').text().replace('MMK', '').trim();
        $orderCode = Math.floor(Math.random() * 1000000000);
        $userId = $('#userId').val();
        $('tbody tr').each(function(index, row) {
            $productId = $(row).find('.productId').val();
            $qty = $(row).find('.qty').val();

            $orderList.push({
                'userId': $userId,
                'productId': $productId,
                'qty': $qty,
                'orderCode': 'PS-'+ $orderCode,
                'total_amt': $total_amt,
            });
        });

        // Send order data via AJAX
        $.ajax({
            type: 'get',
            url: '/user/product/confirmcart',
            data: Object.assign({}, $orderList),
            dataType: 'json',
            success : function(res){
                res.status == 'success' ? location.href='/user/product/payment' : ''
            }
        });
    });
});

</script>
@endsection
