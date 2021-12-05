@extends('layouts.frontLayout.front_design')
@section('content')
<?php use App\Product; ?>

    <!-- LOADER-->
    <div id="loader">
        <div class="position-center-center">
            <div class="ldr"></div>
        </div>
    </div>
    <!-- Content -->
    <div id="content">
        <!-- Popular Products -->
        <section class="padding-top-100 padding-bottom-100">
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
                        <strong style="color: #0e0e0e">{!! session('flash_message_error') !!}</strong>
                    </div>
                @endif

                <!-- SHOP DETAIL -->
                <div class="shop-detail">
                    <div class="row">

                        <!-- Popular Images Slider -->
                        <div class="col-md-7">

                            <!-- Place somewhere in the <body> of your page -->
                            <div id="slider-shop" class="flexslider">
                                    <li>
                                        <img class="img-responsive" src="{{ asset ('images/backend_images/products/large/'.$productDetails->image) }}" alt="">
                                    </li>
                            </div>
                        </div>

                        <!-- COntent -->
                        <div class="col-md-5">
                            <form name="addtocartForm" id="addtocartForm" action="{{ url('add-cart') }}" method="post">{{csrf_field()}}
                                <input type="hidden" name="product_id" value="{{ $productDetails->id }}">
                                <input type="hidden" name="product_name" value="{{ $productDetails->product_name }}">
                                <input type="hidden" name="product_code" value="{{ $productDetails->product_code }}">
                                <input type="hidden" name="price" value="{{ $productDetails->price }}">

                                <h4>{{ $productDetails->product_name }}</h4>
                                <br>
                                <span><i>Codice Prodotto:</i> <b>{{$productDetails->product_code}}</b></span>
                                <span class="price">
                                    <?php $getCurrencyRates = Product::getCurrencyRates($productDetails->price);?>
                                    <h3>{{ $productDetails->price }} €</h3>

                                        {{$getCurrencyRates['USD_Rate']}} $<br>
                                        {{$getCurrencyRates['GBP_Rate']}} £<br>

                                </span>

                            &nbsp;
                                <!-- Item Detail -->
                                <p><?php echo nl2br($productDetails->description);?></p>
                                <!-- Short By -->

                            <div class="some-info">
                                <ul class="row margin-top-30">
                                    <li class="col-xs-6">
                                        <div class="quinty" >
                                            <input name="quantity" type="text"  style="border-color: #0f3e68; border-radius: 10px; margin-top: 10px; max-width: 50px; text-align: center; outline: none; font-size: 18px" value="1" required>
                                        </div>
                                    </li>

                                    @if($total_stock>0)
                                        <!-- ADD TO CART -->
                                            <li class="col-xs-6">
                                                <button type="submit" class="btn" id="cartButton" name="cartButton" value="Shopping Cart"
                                                        style="border-radius: 20px; outline: transparent" >
                                                    Acquista
                                                </button>
                                            </li>
                                    @endif
                                    <br>
                                    <br>
                                    <br>

                                    <!-- STOCK -->
                                    <li class="col-xs-6"> <b> Disponibilità:</b>
                                        @if($total_stock>0) <b style="color: green"> In Stock </b> @else <b style="color: red">Sould Out</b> @endif
                                    </li>
                                    <br>
                                    <br>
                                    <br>
                                    <li class="col-xs-2">
                                        <!-- wishlist -->
                                        <button type="submit" class="btn-1" id="wishListButton" name="wishListButton" style="border-radius: 20px;
                                         outline: transparent" value="Wish List" ><i class="fa fa-heart" style="color: red"></i>
                                        </button>
                                    </li>
                                </ul>
<br>
                                <b>Controlla se spediamo nella tua città</b>
                                <br>
                                <input style="border-radius: 5px" type="text" name="pincode" id="chkPincode" placeholder=" Inserisci il tuo CAP">
                                <button type="button" onclick="return checkPincode();"
                                        style="border-radius: 20px;background:#2d3a4b;color: white;border:none;font-size: 18px;width: 28px
                                        ;outline: none">✓</button>
                                <p></p>
                                <b id="pincodeResponse"></b>
                                <p></p>
<br>
<br>
<br>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Popular Products -->
        <section class="light-gray-bg padding-top-80 padding-bottom-80">
            <div class="container">

                <!-- Main Heading -->
                <div class="heading text-center">
                        <h4>PRODOTTI CORRELATI</h4>
                    <span>Qui puoi trovare dei prodotti simili!</span> </div>

                <!-- Popular Item Slide -->
                <div class="papular-block block-slide">
                @foreach($relatedProducts as $chunk)
                    <!-- Item -->
                    <div class="item">
                        <!-- Item img -->
                        <div class="item-img">
                            <img class="img-1" src="{{ asset ('images/backend_images/products/large/'.$chunk->image) }}" alt="" >
                            <!-- Overlay -->
                            <div class="overlay">
                                <div class="position-center-center">
                                    <div class="inn"><a href="{{ asset ('images/backend_images/products/large/'.$chunk->image) }}" data-lighter><i class="icon-eye"></i></a>
                                        <a href="{{ url('product/'.$chunk->id) }}"><i class="icon-magnifier"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Item Name -->
                        <div class="item-name"> <a href="{{ url('product/'.$chunk->id) }}">{{ $chunk->product_name }}</a>
                           <!-- <p>Lorem ipsum dolor sit amet</p> -->
                        </div>
                        <!-- Price -->
                    <!-- <span class="price"><small>€</small>{{ $chunk->price }}</span> -->
                    </div>
                @endforeach
                </div>
            </div>
        </section>

    </div>

@endsection
