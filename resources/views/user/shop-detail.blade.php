@extends('user.layout.master')

@section('title', 'Fruitables - Vegetable Website')

@section('content')
    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Shop Detail</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pages</a></li>
            <li class="breadcrumb-item active text-white">Shop Detail</li>
        </ol>
    </div>
    <!-- Single Page Header End -->


    <!-- Single Product Start -->
    <div class="container-fluid py-5 mt-5">
        <div class="container py-5">
            <div class="row g-4 mb-5">
                <div>
                    <a href="{{ route('home') }}#productslist">Home</a> > Details
                </div>
                <div class="">
                    <div class="row g-4">
                        <div class="col-lg-6">
                            <div class="border rounded">
                                <a href="#">
                                    <img src="{{ asset('product/' . $details->photo) }}" class="img-fluid rounded w-100"
                                        alt="Image">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="d-flex align-items-center">
                                <h4 class="fw-bold me-3">{{ $details->product_name }}</h4>
                                <div class="text-muted"><i class="fa-solid fa-eye"></i> {{$log}}</div>
                            </div>
                            <p class="mb-3 fw-bold text-danger">Instock: {{ $details->stock }}</p>
                            <p class="mb-3">Category: {{ $details->category_name }}</p>
                            <h5 class="fw-bold mb-3">{{ $details->price }} MMK</h5>
                            <div class="d-flex mb-4">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $ratingAvg)
                                        <i class="fa fa-star text-secondary"></i>
                                    @else
                                        <i class="fa fa-star"></i>
                                    @endif
                                @endfor
                            </div>
                            <p class="mb-4">{{ $details->description }}</p>
                            <div class="">
                                <form method="POST" action="{{ route('addToCart', $details->id) }}">
                                    @csrf
                                    <div class="input-group quantity mb-5" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button type="button"
                                                class="btn btn-sm btn-minus rounded-circle bg-light border">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text" class="form-control form-control-sm text-center border-0"
                                            value="1" name="qty">
                                        <div class="input-group-btn">
                                            <button type="button"
                                                class="btn btn-sm btn-plus rounded-circle bg-light border">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <button type="submit"
                                        class="btn border border-secondary rounded-pill px-4 py-2 mb-4 text-primary"><i
                                            class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</button>
                                    <!-- Button trigger modal -->
                                    <button type="button"
                                        class="btn border border-secondary rounded-pill px-4 py-2 mb-4 text-primary"
                                        data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                        <i class="fa-solid fa-star me-2 text-primary"></i>Rate this product
                                    </button>
                                </form>
                                <form action="{{route('rating')}}" method="post">
                                    @csrf
                                    <!-- Modal -->
                                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static"
                                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                                <input type="hidden" name="product_id" value="{{$details->id}}">
                                                <div class="modal-body">
                                                    <div class="rating-css">
                                                        <div class="star-icon">
                                                            @if($rating == null)
                                                                <input type="radio" name="productRating" id="rating1"  value="1" checked>
                                                                <label for="rating1" class="fa-solid fa-star me-2"></label>
                                                                @for ($i = 2; $i <= 5; $i++)
                                                                <input type="radio" name="productRating" id="rating{{$i}}" value="{{$i}}">
                                                                <label for="rating{{$i}}" class="fa-solid fa-star me-2"></label>
                                                                @endfor
                                                            @else
                                                                @for ($i = 1; $i <= 5; $i++)
                                                                @if ($i <= $rating->rating)
                                                                <input type="radio" name="productRating" id="rating{{$i}}" value="{{$i}}" checked>
                                                                <label for="rating{{$i}}" class="fa-solid fa-star me-2"></label>
                                                                @else
                                                                <input type="radio" name="productRating" id="rating{{$i}}" value="{{$i}}">
                                                                <label for="rating{{$i}}" class="fa-solid fa-star me-2"></label>
                                                                @endif
                                                                @endfor
                                                            @endif


                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Rate</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>



                        </div>
                        <div class="col-lg-12">
                            <nav>
                                <div class="nav nav-tabs mb-3">
                                    <button class="nav-link active border-white border-bottom-0" type="button"
                                        role="tab" id="nav-mission-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-mission" aria-controls="nav-mission"
                                        aria-selected="true">Comments <span class="btn btn-secondary">{{count($comment)}} </span></button>
                                </div>
                            </nav>
                            <div class="tab-pane" id="nav-mission" role="tabpanel" aria-labelledby="nav-mission-tab">
                                @if (count($comment) == 0 )
                                    <h2 class="text-center text-muted">There is no comment yet.</h2>
                                @endif
                                @foreach ($comment as $item)
                                    <div class="d-flex mb-2 cmtdiv">
                                    <input type="hidden" class="id" value="{{$item->id}}">
                                        <img src="{{ $item->profile == null ? asset('admin/img/undraw_profile_2.svg') : asset('user/img/' . $item->profile) }}"
                                            class="img-fluid rounded-circle p-3" style="width: 100px; height: 100px;"
                                            alt="">
                                        <div class="">
                                            <div class="d-flex align-items-center">
                                                <p class="mb-2 me-2" style="font-size: 14px;">
                                                    {{ $item->created_at->format('F j, Y g:i A') }}
                                                </p>
                                                @if ($item->user_id == Auth::user()->id)
                                                <div class="nav-item dropdown">
                                                    <button class="btn dots"  data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-dark">
                                                        <div><a class="dropdown-item cmtedit">Edit</a></div>
                                                      <div><a class="dropdown-item" href="{{route('user#commentDelete', $item->id)}}">Delete</a></div>
                                                    </div>
                                                </div>
                                                @endif
                                            </div>

                                            <div class="d-flex justify-content-between">
                                                <h5>{{ $item->name ?? $item->nickname }}</h5>
                                            </div>
                                            <p class="cmtp">{{ $item->message }}</p>
                                            <div class=" mb-3 cmttxt justify-content-end" style="display:none;">
                                                <textarea name="comment" id="" class="w-100 form-control border-0 shadow-sm" cols="50" rows="2" aria-label="Recipient's username" aria-describedby="button-addon2">{{$item->message}}</textarea>
                                                <div class="w-100 d-flex justify-content-end">
                                                    <button class="btn btn-dark save mt-2" type="button" id="button-addon2">Save</button>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                    <hr>
                                @endforeach

                            </div>
                        </div>
                        <form action="{{ route('comment') }}" method="post">
                            @csrf
                            <h4 class="mb-5 fw-bold">Leave a Comment</h4>
                            <div class="row g-4">
                                <div class="col-lg-12">
                                    <div class="border-bottom rounded my-4">
                                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                        <input type="hidden" name="product_id" value="{{ $details->id }}">
                                        <textarea name="comment" id="" class="form-control border-0 shadow-sm" cols="30" rows="8"
                                            placeholder="Your Review *" spellcheck="false"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="d-flex justify-content-between py-3 mb-5">
                                        <div class="d-flex align-items-center">
                                            <p class="mb-0 me-3">Please rate:</p>
                                            <div class="d-flex align-items-center" style="font-size: 12px;">
                                                <i class="fa fa-star text-muted"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                        </div>
                                        <button type="submit"
                                            class="btn border border-secondary text-primary rounded-pill px-4 py-3"> Post
                                            Comment</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <h1 class="fw-bold mb-0">Related products</h1>
            <div class="vesitable">
                @if (count($relatedlist) == 0)
                    <h2 class="text-muted text-center">
                        There is no related product.
                    </h2>
                @elseif (count($relatedlist) <= 4)
                    <div class="d-md-flex justify-content-start align-items-center">
                        @foreach ($relatedlist as $item)
                            <div class="border border-primary rounded position-relative vesitable-item me-3">
                                <div class="vesitable-img">
                                    <a href="{{ route('details', $item->id) }}">
                                        <img src="{{ asset('product/' . $item->photo) }}"
                                            class="img-fluid w-100 rounded-top" alt="" style="height:250px;">
                                    </a>

                                </div>
                                <div class="text-white bg-primary px-3 py-1 rounded position-absolute"
                                    style="top: 10px; right: 10px;">{{ $item->category_name }}</div>
                                <div class="p-4 pb-0 rounded-bottom">
                                    <h4>{{ $item->product_name }}</h4>
                                    <p>{{ Str::limit($item->description, 50) }}</p>
                                    <div class="d-flex justify-content-between flex-lg-wrap">
                                        <p class="text-dark fs-5 fw-bold">{{ $item->price }} MMK</p>
                                        <a href="#"
                                            class="btn border border-secondary rounded-pill px-3 py-1 mb-4 text-primary"><i
                                                class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="owl-carousel vegetable-carousel justify-content-center">
                        @foreach ($relatedlist as $item)
                            <div class="border border-primary rounded position-relative vesitable-item">
                                <div class="vesitable-img">
                                    <a href="{{ route('details', $item->id) }}">
                                        <img src="{{ asset('product/' . $item->photo) }}"
                                            class="img-fluid w-100 rounded-top" alt="" style="height:250px;">
                                    </a>

                                </div>
                                <div class="text-white bg-primary px-3 py-1 rounded position-absolute"
                                    style="top: 10px; right: 10px;">{{ $item->category_name }}</div>
                                <div class="p-4 pb-0 rounded-bottom">
                                    <h4>{{ $item->product_name }}</h4>
                                    <p>{{ Str::limit($item->description, 50) }}</p>
                                    <div class="d-flex justify-content-between flex-lg-wrap">
                                        <p class="text-dark fs-5 fw-bold">{{ $item->price }} MMK</p>
                                        <a href="#"
                                            class="btn border border-secondary rounded-pill px-3 py-1 mb-4 text-primary"><i
                                                class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

            </div>
        </div>
    </div>
    <!-- Single Product End -->
@endsection

@section('js-section')

    <script>
        $(document).ready(function(){
            $('.cmtedit').click(function(){
                $(this).parents('.cmtdiv').find('.cmtp').css('display', 'none');
                $(this).parents('.cmtdiv').find('.cmttxt').css('display', 'block').find('textarea').focus();
                $('.dots').css('display', 'none');
            });

            $('.save').click(function(){
                $id = $(this).parents('.cmtdiv').find('.id').val();
                $comment = $(this).parents('.cmtdiv').find('.cmttxt').find('textarea').val();
                $(this).parents('.cmtdiv').find('.cmttxt').css('display', 'none')
                $(this).parents('.cmtdiv').find('.cmtp').css('display', 'block');
                $.ajax({
                    type: 'get',
                    url: '/user/comment/edit/',
                    data: {
                        'id' : $id,
                        'comment': $comment
                    },
                    dataType: 'json',
                    success : function(res){
                        res.status == 'success'? location.reload() : ''
                    }
                })
            })
        })
    </script>

@endsection
