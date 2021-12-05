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
            <div id="breadcrumb"> <a href="{{url ('admin/dashboard')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
                <a href="">CMS Pages</a><a href="" class="current">View CMS Pages</a> </div>
        </div>
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                            <h5>View CMS Pages</h5>
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
                                    <th>Page ID</th>
                                    <th>Title</th>
                                    <th>URL</th>
                                    <th>Status</th>
                                    <th>Created on</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($cmsPages as $page)
                                    <tr class="gradeX">
                                        <td>{{ $page->id }}</td>
                                        <td>{{ $page->title }}</td>
                                        <td>{{ $page->url }}</td>
                                        <td>@if($page->status==1)
                                                <span style="color: green"> Active
                                                @else <span style="color: red"> Inactive @endif</td>
                                        <td>{{ $page->created_at }}</td>
                                        <td class="center">
                                            <a href="#myModal{{ $page->id }}" data-toggle="modal" class="btn btn-success btn-mini">View</a>
                                            <a href="{{ url('/admin/edit-cms-page/'.$page->id) }}" class="btn btn-primary btn-mini">Edit</a>
                                            <a href="{{ url('/admin/delete-cms-page/'.$page->id) }}"
                                               class="btn btn-danger btn-mini">Delete</a></td>
                                    </tr>
                                    <div id="myModal{{ $page->id }}" class="modal hide">
                                        <div class="modal-header">
                                            <button data-dismiss="modal" class="close" type="button">x</button>
                                            <h3>{{ $page->page_name }} Full Details</h3>
                                        </div>

                                        <div class="modal-body">
                                            <p><strong>Title:</strong> {{ $page->title }}</p>
                                            <p><strong>URL:</strong> {{ $page->url }}</p>
                                            <p><strong>Status:</strong> @if($page->status==1)
                                                    <span style="color: green"> Active
                                                @else <span style="color: red"> Inactive @endif</p>
                                            <p><strong>Created on:</strong> {{ $page->created_at }}</p>
                                            <p><strong>Description:</strong> {{ $page->description }}</p>
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
