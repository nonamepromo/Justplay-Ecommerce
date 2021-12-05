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
                    <div class="cart-ship-info">
                        <div class="row">
                            <!-- ESTIMATE SHIPPING & TAX -->
                            <div class="col-sm-5">
                                <h6>LOGIN</h6>
                                <form name="loginForm" action="{{ url('/user-login') }}" method="POST">
                                    {{csrf_field()}}
                                    <ul class="row">
                                        <!-- EMAIL ADDRESS -->
                                        <li class="col-md-6">
                                            <label>
                                                <input id="email" type="email" name="email" placeholder="EMAIL" required/>
                                            </label>
                                        </li>
                                        <!-- Name -->
                                        <li class="col-md-6">
                                            <label>
                                                <input id="password" type="password"
                                                       name="password" placeholder="PASSWORD" required minlength="6"/>
                                            </label>
                                        </li>


                                        <!-- LOGIN -->
                                        <li class="col-md-4">
                                            <button type="submit" class="btn">LOGIN</button>
                                        </li>


                                        <!-- FORGET PASS -->
                                        <li class="col-md-8">
                                            <div class="checkbox margin-0 margin-top-20 text-right">
                                                <a href="{{url('forgot-password')}}" style="color: red; font-size: 15px">Password dimenticata?</a>
                                            </div>
                                        </li>
                                    </ul>
                                </form>
                            </div>


                            <!-- SUB TOTAL -->
                            <div class="col-sm-6" style="margin-left: 90px">
                                <h6>REGISTRAZIONE</h6>
                                <form name="registerForm" action="{{ url('/user-register') }}" method="POST">
                                    {{csrf_field()}}
                                    <ul class="row">

                                        <!-- EMAIL ADDRESS -->
                                        <li class="col-md-6">
                                            <label>
                                                <input id="email" type="email" name="email" placeholder="EMAIL" required/>
                                            </label>
                                        </li>

                                        <!-- LAST NAME -->
                                        <li class="col-md-6">
                                            <label>
                                                <input id="myPassword" type="password" name="password" placeholder="PASSWORD" required minlength="6"/>
                                            </label>
                                        </li>

                                        <!-- Name -->
                                        <li class="col-md-6">
                                            <label>
                                                <input id="name" type="text" name="name" style="text-transform: capitalize" placeholder="NAME" required minlength="2" onkeypress="return /[a-z]/i.test(event.key)"/>
                                            </label>
                                        </li>
                                        <!-- PHONE -->
                                        <li class="col-md-6" style="margin-top: 9.5px">
                                            <button type="submit" class="btn">REGISTRATI</button>
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
