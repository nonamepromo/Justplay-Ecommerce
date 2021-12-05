@extends('layouts.frontLayout.front_design')
@section('content')
    <!-- LOADER-->
    <div id="loader">
        <div class="position-center-center">
            <div class="ldr"></div>
        </div>
    </div>
    <!-- Content -->
    <div id="content">
    <!-- PRODOTTI FEATURES -->
        <section class="padding-top-100 padding-bottom-100">
            <div class="container">

                @if(Session::has('flash_message_success'))
                    <div class="alert alert-success alert-block" style="background-color: green">
                        <button type="button" class="close" data-dismiss="alert">x</button>
                        <strong style="color: white">{!! session('flash_message_success') !!}</strong>
                    </div>
                @endif
                <!-- Main Heading -->
                <div class="heading text-center">
                    &nbsp;
                    <h4>Contattaci</h4>
                    <!--======= CONATACT  =========-->
                    <section class="contact padding-top-100 padding-bottom-100">
                        <div class="container">
                            <div class="contact-form">
                                <div class="row">
                                    <div class="col-md-8">
                                        <!--======= FORM  =========-->
                                        <form action="{{url('/page/contact')}}" id="contact_form" class="contact-form" method="post">
                                            {{csrf_field()}}
                                            <ul class="row">
                                                <li class="col-sm-6">
                                                    <label>Nome Completo
                                                        <input type="text" class="form-control" name="name" id="name" placeholder="" required minlength="4">
                                                    </label>
                                                </li>
                                                <li class="col-sm-6">
                                                    <label>Email
                                                        <input type="text" class="form-control" name="email" id="email" placeholder="" required>
                                                    </label>
                                                </li>
                                                <li class="col-sm-6">
                                                    <label>Soggetto
                                                        <input type="text" class="form-control" name="subject" id="subject" required
                                                               placeholder="">
                                                    </label>
                                                </li>
                                                <li class="col-sm-12">
                                                    <label>Messaggio
                                                        <textarea class="form-control" name="message" id="message" rows="5" required
                                                                  placeholder=""></textarea>
                                                    </label>
                                                </li>
                                                <li class="col-sm-12">
                                                    <button type="submit" name="submit" class="btn" style="border-radius: 20px; outline: transparent" value="submit"
                                                    >Invia Email</button>
                                                </li>
                                            </ul>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </section>
    </div>
@endsection

