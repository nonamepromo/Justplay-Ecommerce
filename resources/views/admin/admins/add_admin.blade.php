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
            <div id="breadcrumb"> <a href="{{url ('admin/dashboard')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="">Admins / Sub-Admin</a> <a href="" class="current">Add Admin / Sub-Admins</a> </div>
        </div>
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
                            <h5>Add Admins / Sub-Admins</h5>
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
                            <form enctype="multipart/form-data" class="form-horizontal" method="post"
                                  action="{{ url('/admin/add-admin') }}" name="add_admin" id="add_admin" novalidate="novalidate"> {{csrf_field()}}
                                <div class="control-group">
                                    <label class="control-label">Type</label>
                                    <div class="controls">
                                        <select name="type" id="type" style="width: 220px;">
                                            <option value="Admin">Admin</option>
                                            <option value="Sub Admin">Sub Admin</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Username</label>
                                    <div class="controls">
                                        <input type="text" name="username" id="username" required>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Password</label>
                                    <div class="controls">
                                        <input type="password" name="password" id="password" required>
                                    </div>
                                </div>
                                <div class="control-group" id="access">
                                    <label class="control-label">Access</label>
                                    <div class="controls">
                                        <input type="checkbox" name="categories_view_access" id="categories_view_access" value="1">
                                        &nbsp;View Categories&nbsp;Only&nbsp;&nbsp;
                                        <input type="checkbox" name="categories_edit_access" id="categories_edit_access" value="1">
                                        &nbsp;View and Edit Categories&nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" name="categories_full_access" id="categories_full_access" value="1">
                                        &nbsp;View, Delete and Edit Categories&nbsp;&nbsp;&nbsp;<br>
                                        <input type="checkbox" name="products_access" id="products_access" value="1">&nbsp;Products&nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" name="orders_access" id="orders_access" value="1">&nbsp;Orders&nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" name="users_access" id="users_access" value="1">&nbsp;Users
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Enable</label>
                                    <div class="controls">
                                        <input type="checkbox" name="status" id="status" value="1">
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <input type="submit" value="Add Admin" class="btn btn-success">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
