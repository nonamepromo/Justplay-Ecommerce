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
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th style="text-align: center">ID Ordine</th>
                            <th style="text-align: center">Codice Prodotto</th>
                            <th style="text-align: center">Metodo Di Pagamento</th>
                            <th style="text-align: center">Totale</th>
                            <th style="text-align: center">Creazione</th>
                            <th style="text-align: center">Stato Ordine</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td>{{$order->id}}</td>
                            <td>
                            @foreach($order->orders as $pro)
                                    <a style="color: #0e90d2" href="{{url('/orders/'.$order->id)}}">{{$pro->product_code}}</a><br>
                            @endforeach
                            </td>
                            <td>{{$order->payment_method}}</td>
                            <td>{{$order->grand_total}} €</td>
                            <td>{{$order->created_at}}</td>
                            <td>{{$order->order_status}}</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </li>
            </div>
        </section>



    </div>


@endsection

