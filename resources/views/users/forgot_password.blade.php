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
                                <h6>Password dimenticata?</h6>
                                <form name="forgotPasswordForm" id="forgotPasswordForm" action="{{ url('/forgot-password') }}" method="POST">
                                    {{csrf_field()}}
                                    <ul class="row">
                                        <!-- EMAIL ADDRESS -->
                                        <li class="col-md-6">
                                            <label>
                                                <input id="email" type="email" name="email" placeholder="EMAIL" required/>
                                            </label>
                                        </li>
                                        <!-- LOGIN -->
                                        <li class="col-md-8">
                                            <button type="submit" class="btn">INVIA</button>
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
