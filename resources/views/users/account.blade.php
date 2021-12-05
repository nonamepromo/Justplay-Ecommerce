@extends('layouts.frontLayout.front_design')
@section('content')

    <!-- Content -->
    <div id="content">

        <!--======= LOGIN =========-->
        <section class="chart-page padding-top-100 padding-bottom-100">
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

            <!-- Payments Steps -->
                <div class="shopping-cart">
                    <!-- SHOPPING INFORMATION -->
                    <div class="cart-ship-info register">
                        <div class="row">
                            <!-- ESTIMATE SHIPPING & TAX -->
                            <div class="col-sm-12">
                                <h6>AGGIORNA ACCOUNT</h6>
                                <form name="accountForm" name="accountForm" action="{{ url('/account') }}" method="POST">
                                    {{csrf_field()}}
                                    <ul class="row">
                                                <!-- EMAIL ADDRESS -->
                                        <li class="col-md-6">
                                            <label>
                                                <input value="{{ $userDetails->name }}" id="name" type="text" name="name" style="text-transform: capitalize" placeholder="NOME" required minlength="2" onkeypress="return /[a-z]/i.test(event.key)"/>
                                            </label>
                                        </li>
                                        <li class="col-md-6">
                                            <label>
                                                <input value="{{ $userDetails->address }}" id="address" type="address" name="address" placeholder="INDIRIZZO" style="text-transform: capitalize" required/>
                                            </label>
                                        </li>
                                        <li class="col-md-6">
                                            <label>
                                                <input value="{{ $userDetails->city }}" id="city" type="city" name="city" placeholder="CITTA'" style="text-transform: capitalize" required minlength="2" onkeypress="return /[a-z]/i.test(event.key)"/>
                                            </label>
                                        </li>
                                        <li class="col-md-6">
                                            <label>
                                                <input value="{{ $userDetails->state }}" style="text-transform: uppercase" id="state" type="state" name="state" placeholder="PROVINCIA" required minlength="2" onkeypress="return /[a-z]/i.test(event.key)"/>
                                            </label>
                                        </li>
                                        <li class="col-md-6">
                                            <label>
                                                <select class="selectpicker" id="country" name="country" required data-size="4" title="STATO">
                                                    @foreach($countries as $country)
                                                        <option value="{{ $country->country_name }}" @if($country->country_name == $userDetails->country) selected @endif>{{$country->country_name}}</option>
                                                    @endforeach
                                                </select>
                                            </label>
                                        </li>
                                        <li class="col-md-6">
                                            <label>
                                                <input value="{{ $userDetails->pincode }}" id="pincode" type="pincode" name="pincode" placeholder="CAP" required/>
                                            </label>
                                        </li>
                                        <li class="col-md-6">
                                            <label>
                                                <input value="{{ $userDetails->mobile }}" id="mobile" type="mobile" name="mobile" placeholder="TELEFONO" required minlength="5" onkeypress="return /[0-9]/i.test(event.key)"/>
                                            </label>
                                        </li>
                                        <!-- LOGIN -->
                                        <li class="col-md-6" style="margin-top: 9.5px">
                                            <button type="submit" class="btn">AGGIORNA</button>
                                        </li>
                                    </ul>
                                </form>
                            </div>

                            <!-- SUB TOTAL -->
                            <div class="col-sm-12" style="margin-top: 50px">
                                <h6>AGGIORNA PASSWORD</h6>
                                <form id="passwordForm" name="passwordForm" action="{{ url('/update-user-pwd') }}" method="POST">
                                    {{csrf_field()}}
                                    <ul class="row">
                                        <li class="col-md-7">
                                            <label>
                                                <input id="current_pwd" type="password" name="current_pwd" placeholder="PASSWORD ATTUALE" required/>
                                                <span id="chkPwd"></span>
                                            </label>
                                        </li>
                                        <li class="col-md-7">
                                            <label>
                                                <input id="new_pwd" type="password" name="new_pwd" placeholder="NUOVA PASSWORD" required minlength="6"/>
                                            </label>
                                        </li>
                                        <li class="col-md-7">
                                            <label>
                                                <input id="confirm_pwd" type="password" name="confirm_pwd" placeholder="CONFERMA PASSWORD"
                                                       required minlength="6"/>
                                            </label>
                                        </li>
                                        <!-- PHONE -->
                                        <li class="col-md-6" style="margin-top: 9.5px">
                                            <button type="submit" class="btn">AGGIORNA PASSWORD</button>
                                        </li>
                                    </ul>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
