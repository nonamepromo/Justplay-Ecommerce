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
            <div id="breadcrumb"> <a href="{{url ('admin/dashboard')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="">Shipping</a> <a href="" class="current">Edit Shipping</a> </div>
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
                        <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
                            <h5>Edit Shipping Charges</h5>
                        </div>
                        <div class="widget-content nopediting">
                            <form enctype="multipart/form-data" class="form-horizontal" method="post"
                                  action="{{ url('/admin/edit-shipping/'.$shippingDetails->id) }}"
                                  name="edit_shipping" id="edit_shipping" novalidate="novalidate">
                                {{csrf_field()}}
                                <input type="hidden" name="id" value="{{$shippingDetails->id}}">
                                <div class="control-group">
                                    <label class="control-label">Country</label>
                                    <div class="controls">
                                        <input type="text" readonly value="{{$shippingDetails->country}}">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Shipping Charges</label>
                                    <div class="controls">
                                        <input type="text" name="shipping_charges" id="shipping_charges" value="{{$shippingDetails->shipping_charges}}">
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <input type="submit" value="Edit Currency" class="btn btn-success">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
