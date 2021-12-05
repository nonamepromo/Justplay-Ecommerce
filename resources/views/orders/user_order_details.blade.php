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
                            <th>Product Code</th>
                            <th>Product Name</th>
                            <th>Product Price</th>
                            <th>Product Qty</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orderDetails->orders as $pro)
                            <tr>
                                <td>{{$pro->product_code}}</td>
                                <td>{{$pro->product_name}}</td>
                                <td>{{$pro->product_price}}</td>
                                <td>{{$pro->product_qty}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </li>
            </div>
        </section>



    </div>


@endsection

