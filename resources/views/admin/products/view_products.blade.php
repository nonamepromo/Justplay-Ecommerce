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
            <div id="breadcrumb"> <a href="{{url ('admin/dashboard')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="">Videogames</a> <a href="" class="current">View Videogames</a> </div>
        </div>
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                            <h5>View Videogames</h5>
                            <a style="padding: 3px; margin: 5px; float: right" href="{{url('/admin/export-products')}}" class="btn btn-primary btn-mini">Esporta Excel</a>
                        </div>
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
                        <div class="widget-content nopadding">
                            <table class="table table-bordered data-table">
                                <thead>
                                <tr>
                                    <th>Videogame ID</th>
                                    <th>Platform ID</th>
                                    <th>Platform Name</th>
                                    <th>Videogame Name</th>
                                    <th>Videogame Code</th>
                                    <th>Videogame Brand</th>
                                    <th>Videogame Genre</th>
                                    <th>Videogame Pegi</th>
                                    <th>Price</th>
                                    <th>Image</th>
                                    <th>Stock</th>
                                    <th>Feature Item</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $product)
                                    <tr class="gradeX">
                                        <td>{{ $product->id }}</td>
                                        <td>{{ $product->category_id }}</td>
                                        <td>{{ $product->category_name }}</td>
                                        <td>{{ $product->product_name }}</td>
                                        <td>{{ $product->product_code }}
                                        <td>{{ $product->product_brand }}
                                        <td>{{ $product->product_genre }}
                                        <td>{{ $product->product_pegi }}
                                        <td>{{ $product->price }}</td>
                                        <td>
                                          @if(!empty($product->image))
                                            <img src="{{ asset('/images/backend_images/products/small/'.$product->image) }}"   style="width:70px;">
                                              @endif
                                        </td>
                                        <td>{{ $product->stock }}</td>
                                        <td>@if($product->feature_item == 1) <span style="color: green"> Yes @else <span style="color: red"> No @endif</td>
                                        <td class="center">
                                            <a href="#myModal{{ $product->id }}" data-toggle="modal" class="btn btn-success btn-mini">View</a>
                                            <a href="{{ url('/admin/edit-product/'.$product->id) }}" class="btn btn-primary btn-mini">Edit</a>
                                            <a rel="{{ $product->id }}" rel1=delete-product <?php /* href="{{url('admin/delete-product/'.$product->id) }}" */?> href="javascript:" class="btn btn-danger btn-mini deleteRecord">Delete</a></td>
                                    </tr>
                                    <div id="myModal{{ $product->id }}" class="modal hide">
                                        <div class="modal-header">
                                            <button data-dismiss="modal" class="close" type="button">x</button>
                                            <h3>{{ $product->product_name }} Full Details</h3>
                                        </div>

                                        <div class="modal-body">
                                            <p>Videogame ID: {{ $product->id }}</p>
                                            <p>Platform ID: {{ $product->category_id }}</p>
                                            <p>Videogame Code: {{ $product->product_code }}</p>
                                            <p>Price: {{ $product->price }} €</p>
                                            <p>Description: {{ $product->description }}</p>
                                            <p>Stock: {{ $product->stock }}</p>
                                            <p>Feature: @if($product->feature_item == 1) Yes @else  No @endif</p>
                                        </div>
                                    </div>
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
