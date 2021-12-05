<?php
use App\Http\Controllers\Controller;
$mainCategories = Controller::mainCategories();
?>

@extends('layouts.frontLayout.front_design')
@section('content')

    <!-- LOADER-->
    <div id="loader">
        <div class="position-center-center">
            <div class="ldr"></div>
        </div>
    </div>
    <!-- Content -->
    <div id="content">

    <!-- PRODOTTI FEATURES -->
        <section class="padding-top-100 padding-bottom-100">
            <div class="container">
                <!-- Main Heading -->
                <div class="heading text-center">
                    <h4>{{$cmsPageDetails->title}}</h4>
                    <span>{{$cmsPageDetails->description}}</span> </div>
            </div>
        </section>
    </div>
@endsection

