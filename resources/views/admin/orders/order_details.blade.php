@extends('layouts.adminLayout.admin_design')
@section('content')

    <!--main-container-part-->
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
            <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Orders</a> </div>
        </div>
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span6">
                    <div class="widget-box">
                        @if(Session::has('flash_message_success'))
                            <div class="alert alert-success alert-block">
                                <button type="button" class="close" data-dismiss="alert">x</button>
                                <strong>{!! session('flash_message_success') !!}</strong>
                            </div>
                        @endif
                        <div class="widget-title">
                            <h5>Order Details</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <table class="table table-striped table-bordered">
                                <tbody>
                                <tr>
                                    <td class="taskDesc">Order Date</td>
                                    <td class="taskStatus">{{ $orderDetails->created_at }}</td>

                                </tr>
                                <tr>
                                    <td class="taskDesc">Order Status</td>
                                    <td class="taskStatus">{{$orderDetails->order_status}}</td>
                                </tr>
                                <tr>
                                    <td class="taskDesc">Order Total</td>
                                    <td class="taskStatus">{{$orderDetails->grand_total}} €</td>
                                </tr>
                                <tr>
                                    <td class="taskDesc">Shipping Charges</td>
                                    <td class="taskStatus">{{$orderDetails->shipping_charges}} €</td>
                                </tr>
                                <tr>
                                    <td class="taskDesc">Coupon Code</td>
                                    <td class="taskStatus">{{$orderDetails->coupon_code}}</td>
                                </tr>
                                <tr>
                                    <td class="taskDesc">Coupon Amount</td>
                                    <td class="taskStatus">{{$orderDetails->coupon_amount}} €</td>
                                </tr>
                                <tr>
                                    <td class="taskDesc">Payment Method</td>
                                    <td class="taskStatus">{{$orderDetails->payment_method}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="accordion" id="collapse-group">
                        <div class="accordion-group widget-box">
                            <div class="accordion-heading">
                                <div class="widget-title">
                                    <h5>Billing Address</h5>
                                </div>
                            </div>
                            <div class="collapse in accordion-body" id="collapseGOne">
                                <div class="widget-content">
                                    {{$userDetails->name}} <br>
                                    {{$userDetails->address}} <br>
                                    {{$userDetails->city}} <br>
                                    {{$userDetails->state}} <br>
                                    {{$userDetails->country}} <br>
                                    {{$userDetails->pincode}} <br>
                                    {{$userDetails->mobile}} <br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="span6">
                    <div class="widget-box">
                        <div class="widget-title">
                            <h5>Customer Details</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <table class="table table-striped table-bordered">
                                <tbody>
                                <tr>
                                    <td class="taskDesc">Customer Name</td>
                                    <td class="taskStatus">{{ $orderDetails->name }}</td>

                                </tr>
                                <tr>
                                    <td class="taskDesc">Customer Status</td>
                                    <td class="taskStatus">{{$orderDetails->user_email}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="accordion" id="collapse-group">
                        <div class="accordion-group widget-box">
                            <div class="accordion-heading">
                                <div class="widget-title">
                                    <h5>Update Order Status</h5>
                                </div>
                            </div>
                            <div class="collapse in accordion-body" id="collapseGOne">
                                <div class="widget-content">
                                    <form action="{{url ('/admin/update-order-status')}}" method="post">{{csrf_field()}}
                                        <input type="hidden" name="order_id" value="{{$orderDetails->id}}">
                                        <table width="100%">
                                        <tr>
                                            <td>
                                                <select name="order_status" id="order_status" class="control-label" required="">
                                                    <option value="New"
                                                            @if($orderDetails->order_status == "New") selected @endif>New</option>
                                                    <option value="Pending"
                                                            @if($orderDetails->order_status == "Pending") selected @endif>Pending</option>
                                                    <option value="Cancelled"
                                                            @if($orderDetails->order_status == "Cancelled") selected @endif>Cancelled</option>
                                                    <option value="In Process"
                                                            @if($orderDetails->order_status == "In Process") selected @endif>In Process</option>
                                                    <option value="Shipped"
                                                            @if($orderDetails->order_status == "Shipped") selected @endif>Shipped</option>
                                                    <option value="Delivered"
                                                            @if($orderDetails->order_status == "Delivered") selected @endif>Delivered</option>
                                                    <option value="Delivered"
                                                            @if($orderDetails->order_status == "Paid") selected @endif>Paid</option>
                                         </select>
                                            </td>
                                        <td>
                                            <input type="submit" value="Update Status">
                                        </td>
                                        </tr>
                                    </table>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion" id="collapse-group">
                        <div class="accordion-group widget-box">
                            <div class="accordion-heading">
                                <div class="widget-title">
                                    <h5>Shipping Address</h5>
                                </div>
                            </div>
                            <div class="collapse in accordion-body" id="collapseGOne">
                                <div class="widget-content">
                                    {{$orderDetails->name}} <br>
                                    {{$orderDetails->address}} <br>
                                    {{$orderDetails->city}} <br>
                                    {{$orderDetails->state}} <br>
                                    {{$orderDetails->country}} <br>
                                    {{$orderDetails->pincode}} <br>
                                    {{$orderDetails->mobile}} <br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row-fluid">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                    <tr>
                        <th>Product Code</th>
                        <th>Product Name</th>
                        <th>Product Price</th>
                        <th>Product Qty</th>
                    </tr>
                    </thead>
                    @foreach($orderDetails->orders as $pro)
                        <tbody>
                            <tr>
                                <td>{{$pro->product_code}}</td>
                                <td>{{$pro->product_name}}</td>
                                <td>{{$pro->product_price}}</td>
                                <td>{{$pro->product_qty}}</td>
                            </tr>
                    </tbody>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    <!--main-container-part-->

@endsection
