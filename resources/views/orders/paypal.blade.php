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
                        <b>{{Session::get('grand_total')}}€</b></p>
                    <p>Per confermare il tuo pagamento clicca sul bottone sottostante</p>
                    <!-- Video 84 e 85 -->
                    <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
                        <input type="hidden" name="cmd" value="_xclick">
                        <input type="hidden" name="business" value="sb-2lmdk4085740@business.example.com">
                        <input type="hidden" name="item_name" value="{{Session::get('order_id')}}">
                        <input type="hidden" name="currency_code" value="€">
                        <input type="hidden" name="amount" value="{{Session::get('grand_total')}}">
                        <input type="image" src="https://www.paypalobjects.com/webstatic/en_US/i/btn/png/btn_paynow_107x26.png" alt="Pay Now">
                              <img alt="" src="https://paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                    </form>
                </li>
            </div>
        </section>



    </div>


@endsection

<?php
    Session::forget('grand_total');
    Session::forget('order_id');
    ?>
