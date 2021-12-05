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
            <div id="breadcrumb"> <a href="i{{url ('admin/dashboard')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="">Brands and Platforms</a> <a href="" class="current">View Brands and Platforms</a> </div>
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
                            <h5>View Brands and Platforms</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <table class="table table-bordered data-table">
                                <thead>
                                <tr>
                                    <th>Brands or Platforms ID</th>
                                    <th>Brands or Platforms Name</th>
                                    <th>Brands or Platforms Level</th>
                                    <th>Category URL</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($categories as $category)
                                <tr class="gradeX">
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->parent_id }}</td>
                                    <td>{{ $category->url }}</td>
                                    <td class="center">
                                        @if(Session::get('adminDetails')['categories_edit_access']==1)
                                        <a href="{{ url('/admin/edit-category/'.$category->id) }}" class="btn btn-primary btn-mini">Edit</a>
                                        @endif
                                        @if(Session::get('adminDetails')['categories_full_access']==1)
                                        <a rel="{{ $category->id }}" rel1="delete-category" href="javascript:"
                                           class="btn btn-danger btn-mini deleteRecord">Delete</a></td>
                                        @endif
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
