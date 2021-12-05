@extends('layouts.frontLayout.front_design')
@section('content')

    <!-- Content -->
    <div id="content">

        <!--======= PAGES INNER =========-->
        <section class="chart-page padding-top-100 padding-bottom-100">
            <div class="container">
                @if(Session::has('flash_message_error'))
                    <div class="alert alert-error alert-block" style="background-color: red">
                        <button type="button" class="close" data-dismiss="alert">x</button>
                        <strong style="color: white">{!! session('flash_message_error') !!}</strong>
                    </div>
                @endif
                <form action="{{ url('/checkout') }}" method="post">{{csrf_field()}}

                <!-- Payments Steps -->
                <div class="shopping-cart">

                    <!-- SHOPPING INFORMATION -->
                    <div class="cart-ship-info register">
                        <div class="row">

                            <!-- ESTIMATE SHIPPING & TAX -->
                            <div class="col-sm-12">
                                <h6>FATTURAZIONE</h6>
                                    <ul class="row">
                                        <!-- Name -->
                                        <li class="col-md-6">
                                            <label>
                                                <input @if(!empty($userDetails->name)) value="{{ $userDetails->name }}" @endif id="billing_name" type="text" name="billing_name" style="text-transform: capitalize" placeholder="NAME" required minlength="2" onkeypress="return /[a-z]/i.test(event.key)"/>
                                            </label>
                                        </li>
                                        <li class="col-md-6">
                                            <label>
                                                <select class="selectpicker" id="billing_country" name="billing_country" required data-size="4" >
                                                    @foreach($countries as $country)
                                                        <option value="{{ $country->country_name }}" @if(!empty($userDetails->country) && $country->country_name == $userDetails->country) selected @endif>{{$country->country_name}}</option>
                                                    @endforeach
                                                </select>
                                            </label>
                                        </li>

                                        <li class="col-md-6">
                                            <label>
                                                <input @if(!empty($userDetails->address))  value="{{ $userDetails->address }}" @endif id="billing_address" type="text" name="billing_address" placeholder="INDIRIZZO" style="text-transform: capitalize" required/>
                                            </label>
                                        </li>
                                        <li class="col-md-6">
                                            <label>
                                                <input @if(!empty($userDetails->city))  value="{{ $userDetails->city }}" @endif id="billing_city"  type="text" name="billing_city" placeholder="CITTA'" style="text-transform: capitalize" required minlength="2" onkeypress="return /[a-z]/i.test(event.key)"/>
                                            </label>
                                        </li>
                                        <li class="col-md-6">
                                            <label>
                                                <input @if(!empty($userDetails->state))  value="{{ $userDetails->state }}" @endif style="text-transform: uppercase" id="billing_state" type="text" name="billing_state" placeholder="STATO" required minlength="2" onkeypress="return /[a-z]/i.test(event.key)"/>
                                            </label>
                                        </li>
                                        <li class="col-md-6">
                                            <label>
                                                <input @if(!empty($userDetails->pincode))  value="{{ $userDetails->pincode }}" @endif id="billing_pincode" type="text" name="billing_pincode" placeholder="CAP" required/>
                                            </label>
                                        </li>
                                        <li class="col-md-6">
                                            <label>
                                                <input @if(!empty($userDetails->mobile)) value="{{ $userDetails->mobile }}" @endif id="billing_mobile" type="text" name="billing_mobile" placeholder="TELEFONO" required minlength="2" onkeypress="return /[0-9]/i.test(event.key)"/>
                                            </label>
                                        </li>


                                        <!-- CREATE AN ACCOUNT -->
                                        <li class="col-md-6">
                                            <div class="checkbox margin-0 margin-top-20">
                                                <input @if(!empty($userDetails->address)) value="{{$userDetails->name}}" @endif id="copyAddress" class="styled" type="checkbox">
                                                <label for="copyAddress"> L'indirizzo di spedizione è lo stesso</label>
                                            </div>
                                        </li>
                                    </ul>


                                <!-- SHIPPING info -->
                                <h6 class="margin-top-50">SPEDIZIONE</h6>

                                    <ul class="row">

                                        <li class="col-md-6">
                                            <label>
                                                <input  id="shipping_name" type="text" name="shipping_name" @if(!empty($shippingDetails->name))  value="{{ $shippingDetails->name }}" @endif style="text-transform: capitalize" placeholder="NAME" minlength="2" onkeypress="return /[a-z]/i.test(event.key)"/>
                                            </label>
                                        </li>
                                        <li class="col-md-6">
                                            <label>
                                                <select class="selectpicker" id="shipping_country"
                                                        name="shipping_country" required data-size="4">
                                                    @foreach($countries as $country)
                                                        <option value="{{ $country->country_name }}"
                                                                @if(!empty($shippingDetails->$country) && $country->country_name == $shippingDetails->country)
                                                        selected @endif>
                                                        {{$country->country_name}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </label>
                                        </li>

                                        <li class="col-md-6">
                                            <label>
                                                <input  id="shipping_address" type="text" name="shipping_address"
                                                        @if(!empty($shippingDetails->address))  value="{{ $shippingDetails->address }}" @endif
                                                        placeholder="INDIRIZZO" style="text-transform: capitalize" required/>
                                            </label>
                                        </li>
                                        <li class="col-md-6">
                                            <label>
                                                <input  id="shipping_city" type="text" name="shipping_city" @if(!empty($shippingDetails->city))  value="{{ $shippingDetails->city }}" @endif  placeholder="CITTA'" style="text-transform: capitalize" required minlength="2" onkeypress="return /[a-z]/i.test(event.key)"/>
                                            </label>
                                        </li>
                                        <li class="col-md-6">
                                            <label>
                                                <input  style="text-transform: uppercase" id="shipping_state" type="text" @if(!empty($shippingDetails->state))  value="{{ $shippingDetails->state }}" @endif  name="shipping_state" placeholder="STATO" required minlength="2" onkeypress="return /[a-z]/i.test(event.key)"/>
                                            </label>
                                        </li>
                                        <li class="col-md-6">
                                            <label>
                                                <input  id="shipping_pincode" type="text" name="shipping_pincode" @if(!empty($shippingDetails->pincode))  value="{{ $shippingDetails->pincode }}" @endif  placeholder="CAP" required/>
                                            </label>
                                        </li>
                                        <li class="col-md-6">
                                            <label>
                                                <input  id="shipping_mobile" type="text" name="shipping_mobile" @if(!empty($shippingDetails->mobile))  value="{{ $shippingDetails->mobile }}" @endif  placeholder="TELEFONO" required minlength="2" onkeypress="return /[0-9]/i.test(event.key)"/>
                                            </label>
                                        </li>
                                        <!-- PHONE -->
                                        <li class="col-md-7">
                                            <button type="submit" class="btn">CONFERMA</button>
                                        </li>
                                    </ul>
                            </div>

                        </div>
                    </div>
                </div>
                </form>
            </div>
        </section>
    </div>

@endsection
