@extends('layouts.frontLayout.front_design')
@section('content')
    <?php use App\Product;?>

    <!-- Content -->
    <div id="content">

        <!--======= PAGES INNER =========-->
        <section class="chart-page padding-top-100 padding-bottom-100">
            <div class="container">
                <!-- Payments Steps -->
                    <div class="shopping-cart">

                        <!-- SHOPPING INFORMATION -->
                        <div class="cart-ship-info">
                            <div class="row">
                                @if(Session::has('flash_message_error'))
                                    <div class="alert alert-error alert-block" style="background-color: red">
                                        <button type="button" class="close" data-dismiss="alert">x</button>
                                        <strong style="color: white">{!! session('flash_message_error') !!}</strong>
                                    </div>
                                @endif
                                <!-- ESTIMATE SHIPPING & TAX -->
                                <div class="col-sm-7">
                                    <h6>DETTAGLI FATTURAZIONE</h6>
                                    <ul class="row">
                                        <!-- Name -->
                                        <li class="col-md-6">
                                            <label>
                                                {{ $userDetails->name }}
                                            </label>
                                        </li>
                                        <li class="col-md-6">
                                            <label>
                                                {{$userDetails->country}}
                                            </label>
                                        </li>

                                        <li class="col-md-6">
                                            <label>
                                                {{ $userDetails->address }}
                                            </label>
                                        </li>
                                        <li class="col-md-6">
                                            <label>
                                               {{ $userDetails->city }}
                                            </label>
                                        </li>
                                        <li class="col-md-6">
                                            <label>
                                               {{ $userDetails->state }}
                                            </label>
                                        </li>
                                        <li class="col-md-6">
                                            <label>
                                               {{ $userDetails->pincode }}
                                            </label>
                                        </li>
                                        <li class="col-md-6">
                                            <label>
                                               {{ $userDetails->mobile }}
                                            </label>
                                        </li>
                                    </ul>


                                    <!-- SHIPPING info -->
                                    <h6 class="margin-top-50">DETTAGLI SPEDIZIONE</h6>
                                    <ul class="row">
                                        <li class="col-md-6">
                                            <label>
                                                {{$shippingDetails->name}}
                                            </label>
                                        </li>
                                        <li class="col-md-6">
                                            <label>
                                               {{ $shippingDetails->country}}
                                            </label>
                                        </li>

                                        <li class="col-md-6">
                                            <label>
                                                {{$shippingDetails->address}}
                                            </label>
                                        </li>
                                        <li class="col-md-6">
                                            <label>
                                                {{$shippingDetails->city}}
                                            </label>
                                        </li>
                                        <li class="col-md-6">
                                            <label>
                                               {{$shippingDetails->state}}
                                            </label>
                                        </li>
                                        <li class="col-md-6">
                                            <label>
                                               {{$shippingDetails->pincode}}
                                            </label>
                                        </li>
                                        <li class="col-md-6">
                                            <label>
                                                {{$shippingDetails->mobile}}
                                            </label>
                                        </li>
                                    </ul>
                                </div>

                                <!-- SUB TOTAL -->
                                <div class="col-sm-5">
                                    <h6>IL TUO ORDINE</h6>
                                    <div class="order-place">
                                        <?php $total_amount = 0; ?>
                                        @foreach($userCart as $cart)
                                        <div class="order-detail">
                                            <p>{{$cart->product_name}}
                                                <span>€{{$cart->price*$cart->quantity}}</span>
                                            </p>
                                        <?php $total_amount = $total_amount + ($cart->price*$cart->quantity); ?>
                                        @endforeach
                                        <!-- SUB TOTAL -->
                                            @if(!empty(Session::get('CouponAmount')))
                                                <p class="all-total">COUPON<span><?php echo Session::get('CouponAmount'); ?> €</span></p>
                                            @else
                                                <p class="all-total">TOTALE PARZIALE<span><?php echo $total_amount; ?> €</span></p>
                                            @endif
                                                <p class="all-total">SPEDIZIONE<span> {{ $shippingCharges }}€</span></p>
                                                <p class="all-total">TOTALE FINALE
                                                    <?php
                                                    $grand_total = $total_amount - Session::get('CouponAmount') + $shippingCharges;
                                                    $getCurrencyRates = Product::getCurrencyRates($total_amount);?>
                                                    <span data-toggle="tooltip" data-html="true" title="
                                                    {{$getCurrencyRates['USD_Rate']}} $<br>
                                                    {{$getCurrencyRates['GBP_Rate']}} £<br>">
                                                    <?php echo $grand_total; ?> €
                                                    </span></p>
                                        </div>
                                        <form name="paymentForm" id="paymentForm" action="{{url('/place-order')}}" method="post">{{csrf_field()}}
                                            <input type="hidden" name="grand_total" value="{{ $grand_total }}">
                                            <div class="pay-meth">
                                            <ul>
                                                <li>
                                                    <label><strong>SELEZIONA METODO DI PAGAMENTO:</strong></label>
                                                    <li>
                                                </li>
                                                @if($codpincodeCount>0)
                                                <li>
                                                    <div class="radio">
                                                        <input type="radio" name="payment_method" id="COD" value="COD" checked>
                                                        <label for="COD"> CARTA DI CREDITO </label>
                                                    </div>
                                                </li>
                                                @endif
                                                @if($prepaidpincodeCount>0)
                                                <li>
                                                    <div class="radio">
                                                        <input type="radio" name="payment_method" id="Paypal" value="Paypal">
                                                        <label for="Paypal"> PAYPAL </label>
                                                    </div>
                                                </li>
                                                @endif
                                            </ul>
                                            <button class="btn  btn-dark pull-right margin-top-30" type="submit"
                                               onclick=" return selectPaymentMethod(); " >ACQUISTA</button> </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
            </div>
    </div>
        </section>

@endsection
