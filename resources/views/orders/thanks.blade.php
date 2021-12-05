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
        <!--======= PAGES INNER =========-->
        <section class="padding-top-100 padding-bottom-100 pages-in chart-page">
            <div class="container">
                <li style="text-align: center; margin-top: 100px">
                    <h3>Grazie</h3>
                    <h3>Il tuo ordine è andato a buon fine</h3>
                    <p style="margin-top: 20px">Ti confermiamo l'ordine con <b>ID:{{Session::get('order_id')}}</b> per un prezzo totale di
                        <b>{{Session::get('grand_total')}}€ </b></p>
                </li>
            </div>
        </section>



    </div>


@endsection

<?php
    Session::forget('grand_total');
    Session::forget('order_id');
    ?>
