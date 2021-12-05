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
            <div id="breadcrumb"> <a href="{{url ('admin/dashboard')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="">Brands and Platforms</a> <a href="" class="current">Add Brands and Platforms</a> </div>
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
                            <h5>Add Brands and Platforms</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{{ url('/admin/add-category') }}" name="add_category" id="add_category" novalidate="novalidate"> {{csrf_field()}}
                                <div class="control-group">
                                    <label class="control-label">Brand or Platform Name</label>
                                    <div class="controls">
                                        <input type="text" name="category_name" id="category_name">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Brand or Platform Level</label>
                                    <div class="controls">
                                        <select name="parent_id" style="width: 220px;">
                                            <option value="0">Brand</option>
                                            @foreach($levels as $val)
                                                <option value="{{ $val->id }}">{{$val->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Description</label>
                                    <div class="controls">
                                        <textarea name="description" id="description"></textarea>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">URL</label>
                                    <div class="controls">
                                        <input type="text" name="url" id="url">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Meta Title</label>
                                    <div class="controls">
                                        <input type="text" name="meta_title" id="meta_title" >
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Meta Description</label>
                                    <div class="controls">
                                        <input type="text" name="meta_description" id="meta_description" >
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Meta Keywords</label>
                                    <div class="controls">
                                        <input type="text" name="meta_keywords" id="meta_keywords" >
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <input type="submit" value="Add Category" class="btn btn-success">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
