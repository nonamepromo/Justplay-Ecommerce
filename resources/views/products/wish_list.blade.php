@extends('layouts.frontLayout.front_design')
@section('content')
    <?php use App\Product;?>

    <!-- LOADER-->
    <div id="loader">
        <div class="position-center-center">
            <div class="ldr"></div>
        </div>
    </div>


    <!-- Content -->
    <div id="content">
        <!--======= PAGES INNER =========-->
        <section class="padding-top-100 padding-bottom-100 pages-in chart-page">
            <div class="container">

                @if(Session::has('flash_message_success'))
                    <div class="alert alert-success alert-block" style="background-color: green">
                        <button type="button" class="close" data-dismiss="alert">x</button>
                        <strong style="color: white">{!! session('flash_message_success') !!}</strong>
                    </div>
                @endif
                @if(Session::has('flash_message_error'))
                    <div class="alert alert-error alert-block" style="background-color: red">
                        <button type="button" class="close" data-dismiss="alert">x</button>
                            <strong style="color: white">{!! session('flash_message_error') !!}</strong>
                    </div>
                @endif
                &nbsp;
                <!-- Payments Steps -->
                <div class="shopping-cart text-center">
                    <div class="cart-head">
                        <ul class="row">
                            <!-- PRODUCTS -->
                            <li class="col-sm-2 text-left">
                                <h6>PRODUCTS</h6>
                            </li>
                            <!-- NAME -->
                            <li class="col-sm-3 ">
                                <h6>NAME</h6>
                            </li>
                            <!-- PRICE -->
                            <li class="col-sm-2">
                                <h6>PRICE</h6>
                            </li>
                            <!-- QTY -->
                            <li class="col-sm-1">
                                <h6>QNTY</h6>
                            </li>

                            <!-- TOTAL PRICE -->
                            <li class="col-sm-2">
                                <h6>TOTAL</h6>
                            </li>
                            <li class="col-sm-1"> </li>
                        </ul>
                    </div>

                    <?php $total_amount = 0; ?>
                @foreach($userWishlist as $wishlist)
                    <!-- Cart Details -->
                    <ul class="row cart-details">

                        <li class="col-sm-5">
                            <div class="media">
                                <!-- Media Image -->
                                <div class="media-left media-middle">
                                    <a class="item-img">
                                        <img class="img-responsive" src="{{asset('images/backend_images/products/large/'.$wishlist->image)}}" alt="">
                                    </a>
                                </div>

                                <!-- Item Name -->
                                <div class="media-body">
                                    <div class="position-center-center">
                                        <h5>{{$wishlist->product_name}}</h5>
                                        <p>{{$wishlist->product_code}}</p>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <!-- PRICE -->
                        <li class="col-sm-2">
                            <div class="position-center-center"> <span class="price"><small>€</small>{{$wishlist->price}}</span> </div>
                        </li>

                        <li class="col-sm-1">
                            <div class="position-center-center">
                                <div class="quinty">
                                    <a>{{$wishlist->quantity}}</a>
                                </div>
                            </div>
                        </li>

                        <!-- TOTAL PRICE -->
                        <li class="col-sm-2">
                            <div class="position-center-center"> <span class="price"><small>€</small>{{$wishlist->price*$wishlist->quantity}}</span> </div>
                        </li>
                        <!-- ADD TO CART -->
                        <form name="addtocartForm" id="addtocartForm" action="{{ url('add-cart') }}" method="post">{{csrf_field()}}
                            <input type="hidden" name="product_id" value="{{ $wishlist->product_id }}">
                            <input type="hidden" name="product_name" value="{{ $wishlist->product_name }}">
                            <input type="hidden" name="product_code" value="{{ $wishlist->product_code }}">
                            <input type="hidden" name="product_qty" value="{{ $wishlist->quantity }}">
                            <input type="hidden" name="price" value="{{ $wishlist->price }}">

                            <li class="col-xs-1">
                                <div class="position-center-center">
                                    <a>
                                <button type="submit" class="btn" id="cartButton" name="cartButton" value="Add to Cart"
                                        style="background-color: transparent; outline: none">
                                    <i class="icon-basket-loaded" style="color: #0e0e0e; width: 10px">
                                    </i>
                                </button>
                                    </a>
                                </div>
                            </li>
                        </form>

                        <li class="col-sm-1">
                            <div class="position-center-center">
                                <a href="{{ url('/wish-list/delete-product/'.$wishlist->id) }}"><i class="icon-close"></i>
                                </a>
                            </div>
                        </li>
                    </ul>
                    <?php $total_amount = $total_amount + ($wishlist->price*$wishlist->quantity); ?>
                    @endforeach
                </div>
            </div>
        </section>
    </div>


@endsection
