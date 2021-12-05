@extends('layouts.adminLayout.admin_design')
@section('content')

    <div id="content">
        <div id="content-header">
            <div id="user-nav" class="navbar navbar-inverse">
                <ul class="nav">
                    <li class=""><a title="" href="javascript:void(0)"><span class="text">Benvenuto
                {{Session::get('adminDetails')['username']}} ({{Session::get('adminDetails')['type']}})</span></a></li>
                    <li class=""><a title="" href="{{ url('/admin/settings') }}"><i class="icon icon-cog"></i> <span class="text">Impostazioni</span></a></li>
                    <li class=""><a title="" href="{{ url('/logout') }}"><i class="icon icon-share-alt"></i> <span class="text">Logout</span></a></li>
                </ul>
            </div>
            <div id="breadcrumb"> <a href="{{url ('admin/dashboard')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="">Orders</a> <a href="" class="current">View Orders</a> </div>
        </div>
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget-box">
                        @if(Session::has('flash_message_error'))
                            <div class="alert alert-error alert-block">
                                <button type="button" class="close" data-dismiss="alert">x</button>
                                <strong>{!! session('flash_message_error') !!}</strong>
                            </div>
                        @endif
                        @if(Session::has('flash_message_success'))
                            <div class="alert alert-success alert-block">
                                <button type="button" class="close" data-dismiss="alert">x</button>
                                <strong>{!! session('flash_message_success') !!}</strong>
                            </div>
                        @endif
                        <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                            <h5>View Orders</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <table class="table table-bordered data-table">
                                <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Order Date</th>
                                    <th>Customer Name</th>
                                    <th>Customer Email</th>
                                    <th>Ordered Products</th>
                                    <th>Order Amount</th>
                                    <th>Order Status</th>
                                    <th>Paymeny Method</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $order)
                                    <tr class="gradeX">
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->created_at }}</td>
                                        <td>{{ $order->name }}</td>
                                        <td>{{ $order->user_email }}</td>
                                        <td>
                                            @foreach($order->orders as $pro)
                                                {{$pro->product_code}}
                                                ({{$pro->product_qty}})
                                                <br>
                                            @endforeach
                                        </td>
                                        <td>{{ $order->grand_total }}</td>
                                        <td>{{ $order->order_status }}</td>
                                        <td>{{ $order->payment_method }}</td>
                                        <td class="center">
                                            <a target="_blank" href="{{url('admin/view-order/'.$order->id)}}"
                                               class="btn btn-success btn-mini">View Order Details</a><br><br>
                                            @if($order->order_status == "Shipped" || $order->order_status == "Delivered" || $order->order_status == "Paid")
                                            <a target="_blank" href="{{url('admin/view-order-invoice/'.$order->id)}}"
                                               class="btn btn-warning btn-mini">View Order Invoice</a><br><br>
                                            <a target="_blank" href="{{url('admin/view-pdf-invoice/'.$order->id)}}"
                                               class="btn btn-primary btn-mini">View PDF Invoice</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
