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
            <div id="breadcrumb"> <a href="{{url ('admin/dashboard')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="">Newsletter Subscribers</a> <a href="" class="current">View Newsletter</a> </div>
        <div style="margin-left: 170px">
            <a href="{{url('/admin/export-newsletter-emails')}}" class="btn btn-primary btn-mini">Esporta</a>
        </div>
        </div>
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                            <h5>View Newsletter</h5>
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
                                    <th>User ID</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Created on</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($newsletters as $newsletter)
                                    <tr class="gradeX">
                                        <td class="center" >{{ $newsletter->id }}</td>
                                        <td class="center" >{{ $newsletter->email }}</td>
                                        <td class="center">
                                            @if($newsletter->status==1)
                                                <a href="{{url('admin/update-newsletter-status/'.$newsletter->id.'/0')}}"><span style="color: green">Active</span></a>
                                            @else
                                                <a href="{{url('admin/update-newsletter-status/'.$newsletter->id.'/1')}}"><span style="color: red">Inactive</span></a>
                                            @endif
                                        </td>
                                        <td class="center" >{{ $newsletter->created_at }}</td>
                                        <td>
                                            <a href="{{ url('/admin/delete-newsletter-email/'.$newsletter->id.'') }}"
                                           class="btn btn-danger btn-mini">Delete</a>
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
