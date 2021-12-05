@extends('layouts.adminLayout.admin_design')
@section('content')

<!--main-container-part-->
<div id="content">
    <!--breadcrumbs-->
    <div id="content-header">
        <div id="user-nav" class="navbar navbar-inverse">
            <ul class="nav">
                <li class=""><a title="" href="javascript:void(0)"><span class="text">Benvenuto
                {{Session::get('adminDetails')['username']}} ({{Session::get('adminDetails')['type']}})</span></a></li>
                <li class=""><a title="" href="{{ url('/admin/settings') }}"><i class="icon icon-cog"></i> <span class="text">Impostazioni</span></a></li>
                <li class=""><a title="" href="{{ url('/logout') }}"><i class="icon icon-share-alt"></i> <span class="text">Logout</span></a></li>
            </ul>
        </div>
        <div id="breadcrumb"> <a class="tip-bottom"> Ti trovi nell'admin panel di Justplay, un progetto per il Master universitario MWT!</a></div>
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
    <!--End-breadcrumbs-->

    <!--Action boxes-->
    <div class="container-fluid">
        <div class="quick-actions_homepage">
            <ul class="quick-actions">
                @if(Session::get('adminDetails')['categories_view_access']==1 || Session::get('adminDetails')['categories_edit_access']==1 || Session::get('adminDetails')['categories_full_access']==1)
                <li class="bg_ly"> <a href="{{url ('admin/view-categories')}}"> <i class="icon-inbox"></i>Marchi e Piattaforme </a></li>
                @endif
                @if(Session::get('adminDetails')['products_access']==1)
                <li class="bg_lo"> <a href="{{url ('admin/view-products')}}"> <i class="icon-inbox"></i>Videogiochi </a> </li>
                @endif
                @if(Session::get('adminDetails')['type']=="Admin")
                <li class="bg_ls"> <a href="{{url ('admin/view-coupons')}}"> <i class="icon-inbox"></i>Coupon </a> </li>
                @endif
                @if(Session::get('adminDetails')['orders_access']==1)
                <li class="bg_lb"> <a href="{{url ('admin/view-orders')}}"> <i class="icon-inbox"></i>Ordini </a> </li>
                @endif
                @if(Session::get('adminDetails')['users_access']==1)
                <li class="bg_lr"> <a href="{{url ('admin/view-users')}}"> <i class="icon-inbox"></i>Utenti </a> </li>
                @endif
                @if(Session::get('adminDetails')['type']=="Admin")
                    <li class="bg_lg"> <a href="{{url ('admin/view-admins')}}"> <i class="icon-inbox"></i>Admin/Sub-Admin </a> </li>
                @endif
                @if(Session::get('adminDetails')['type']=="Admin")
                    <li class="bg_lh"> <a href="{{url ('admin/view-cms-pages')}}"> <i class="icon-inbox"></i>CMS </a> </li>
                @endif
                    @if(Session::get('adminDetails')['type']=="Admin")
                        <li class="bg_lv"> <a href="{{url ('admin/view-currencies')}}"> <i class="icon-inbox"></i>Valute </a> </li>
                    @endif
                    @if(Session::get('adminDetails')['type']=="Admin")
                        <li class="bg_lp"> <a href="{{url ('admin/view-shipping')}}"> <i class="icon-inbox"></i>Tasse Spedizioni </a> </li>
                    @endif
                    @if(Session::get('adminDetails')['type']=="Admin")
                        <li class="bg_lk"> <a href="{{url ('admin/view-newsletter-subscribers')}}"> <i class="icon-inbox"></i>Iscritti a Newsletter </a> </li>
                    @endif
            </ul>
        </div>
        <!--End-Action boxes-->

    </div>
</div>

<!--end-main-container-part-->



@endsection
