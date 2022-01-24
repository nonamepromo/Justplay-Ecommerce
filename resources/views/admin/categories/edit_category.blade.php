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
            <div id="breadcrumb"> <a href="{{url ('admin/dashboard')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="">Brands and Platforms</a> <a href="" class="current">Edit Brands and Platforms</a> </div>
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
        </div>
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
                            <h5>Edit Brands and Platforms</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <form class="form-horizontal" method="post"
                                  action="{{ url('/admin/edit-category/'.$categoryDetails->id) }}" name="edit_category"
                                  id="edit_category" novalidate="novalidate"> {{csrf_field()}}
                                <div class="control-group">
                                    <label class="control-label">Brand or Platform Name</label>
                                    <div class="controls">
                                        <input type="text" name="category_name" id="category_name" value="{{ $categoryDetails->name }}">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Brand or Platform Level</label>
                                    <div class="controls">
                                        <select name="parent_id" style="width: 220px;">
                                            <option value="0">Brand</option>
                                            @foreach($levels as $val)
                                                <option value="{{ $val->id }}" @if($val->id == $categoryDetails->parent_id) selected @endif>{{$val->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Description</label>
                                    <div class="controls">
                                        <textarea style="height: 100%" class="textarea_editor span8 " name="description" id="description">
                                            {{ $categoryDetails->name }}
                                        </textarea>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Meta Title</label>
                                    <div class="controls">
                                        <textarea name="meta_title" id="meta_title">{{$categoryDetails->meta_title}}</textarea>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Meta Description</label>
                                    <div class="controls">
                                        <textarea name="meta_description" id="meta_description">{{$categoryDetails->meta_description}}</textarea>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Meta Keywords</label>
                                    <div class="controls">
                                        <textarea name="meta_keywords" id="meta_keywords">{{$categoryDetails->meta_keywords}}</textarea>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">URL</label>
                                    <div class="controls">
                                        <input type="text" name="url" id="url" value="{{ $categoryDetails->url }}">
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <input type="submit" value="Edit Category" class="btn btn-success">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
