<?php
use App\Http\Controllers\Controller;
$mainCategories = Controller::mainCategories();
?>

@extends('layouts.frontLayout.front_design')
@section('content')

<br>
<br>
        <!-- Content -->
        <div id="content">
            <!-- Popular Products -->
            <section class="padding-top-80">
                <div class="container">

                    <!-- Main Heading -->
                    <div class="heading text-center">
                        <h4>VIDEOGIOCHI SPONSORIZZATI</h4>
                        <span>Qui trovi i migliori videogiochi sul mercato!</span> </div>

                    <!-- Popular Item Slide -->
                    <div class="papular-block block-slide">
                    @foreach($productsFeature as $product)
                        <!-- Item -->
                            <div class="item">
                                <!-- Item img -->
                                <div class="item-img">
                                    <img class="img-1" src="{{ asset ('images/backend_images/products/large/'.$product->image) }}" alt="" >
                                    <!-- Overlay -->
                                    <div class="overlay">
                                        <span class="price"><small>€</small>{{ $product->price }}</span>
                                        <div class="position-center-center">
                                            <div class="inn">
                                                <a href="{{ url('product/'.$product->id) }}"><i class="icon-magnifier"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Item Name -->
                                <div class="item-name"> <a href="{{ url('product/'.$product->id) }}">{{ $product->product_name }}</a>
                                </div>
                                <!-- Price -->
                            {{-- <span class="price"><small>€</small>{{ $products->price }}</span> --}}
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>

            <!-- PRODOTTI FEATURES -->
            <section class="padding-top-100 padding-bottom-100">
                <div class="container">
                    <!-- Main Heading -->
                    <div class="heading text-center">
                        <h4>Tutti i Videogiochi</h4>
                        <span>Qui trovi i videogiochi disponibili sul nostro ecommerce!</span> </div>
                </div>
                <!-- New Arrival -->
                <div class="arrival-block">
                @foreach($productsAll as $product)
                    <!-- Item -->
                    <div class="item">
                        <!-- Images -->
                        <img class="img-1" src="{{ asset ('images/backend_images/products/large/'.$product->image) }}" alt="">
                        <img class="img-2" src="{{ asset ('images/backend_images/products/large/'.$product->image) }}" alt="">
                            <!-- Overlay  -->
                        <div class="overlay">
                            <!-- Price -->
                            <span class="price"><small>€</small>{{ $product->price }}</span>
                        {{--<div class="position-center-center">
                                <a href="{{ asset ('images/backend_images/products/large/'.$product->image) }}" data-lighter>
                                    <i class="icon-eye"></i></a>
                                <a href="{{ url('product/'.$product->id) }}" data-lighter>
                                    <i class="icon-magnifier"></i></a>
                            </div>--}}
                            <div class="position-center-center">
                                <div class="inn">
                                    <a href="{{ url('product/'.$product->id) }}"><i class="icon-magnifier"></i></a>
                                </div>
                            </div>
                        </div>
                        <!-- Item Name -->
                        <div class="item-name"> <a href="{{ url('product/'.$product->id) }}">{{ $product->product_name }}</a>
                            <p></p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>
            <!-- PRIMA DI CATEGORIE -->
            {{--<section class="padding-bottom-150">
                <div class="container">
                    <div class="heading text-center">
                        <h4>Brands</h4>
                        <span>Qui puoi vedere i brand delle varie piattaforme!</span>
                    </div>
                    <!-- Popular Item Slide -->
                    <div class="papular-block block-slide">
                        <!-- CATEGORIE -->
                        @foreach($mainCategories as $cat)
                            <div class="item">
                                <!-- Item img -->
                                <div class="item-img">
                                    <img class="img-1" src="{{ asset ('images/backend_images/categories/large/'.$cat->image) }}" alt="" >
                                    <!-- Overlay -->
                                    <div class="overlay">
                                        <div class="position-center-center">
                                            <a href="{{ asset('products/'.$cat->url) }}" class="btn btn-small btn-round">MOSTRA</a> </div>
                                    </div>
                                </div>
                                <!-- Item Name -->
                                <div class="item-name">
                                    <a href="{{ asset('products/'.$cat->url) }}">{{$cat->name}}</a> </div>
                                <!-- Price -->
                            </div>
                        @endforeach
                        {{--
                    <!--SOTTOCLASSE DA ELIMINARE-->
                         @foreach($cat->categories as $subcat)
                        <div class="item">
                        <!-- Item img -->
                        <div class="item-img">
                        <img class="img-1" src="{{ asset ('images/backend_images/categories/large/'.$subcat->image) }}" alt="" >
                        <img class="img-2" src="" alt="" >
                        <!-- Overlay -->
                        <div class="overlay">
                        <div class="position-center-center">
                        <a href="#." class="btn btn-small btn-round">MOSTRA</a> </div>
                        </div>
                        </div>
                        <!-- Item Name -->
                        <div id="{{$cat->id}}" class="item-name"> <a href="#.">{{ $subcat->name }}</a> </div>
                        <!-- Price -->
                        </div>
                        @endforeach
                        </div>
                </div>
            </section> --}}
        </div>
@endsection
