<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@if(!empty($meta_title)){{$meta_title}} @else Justplay @endif</title>
    @if(!empty($meta_description))<meta name="description" content="{{$meta_description}}">@endif
    @if(!empty($meta_keywords))<meta name="keywords" content="{{$meta_keywords}}">@endif
    <!-- SLIDER REVOLUTION 4.x CSS SETTINGS -->
    <link rel="stylesheet" type="text/css" href="{{ asset ('rs-plugin/css/settings.css') }}" media="screen" />

    <!-- Bootstrap Core CSS -->
    <link href="{{ asset ('css/frontend_css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset ('css/frontend_css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset ('css/frontend_css/ionicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset ('css/frontend_css/main.css') }}" rel="stylesheet">
    <link href="{{ asset ('css/frontend_css/style.css') }}" rel="stylesheet">
    <link href="{{ asset ('css/frontend_css/responsive.css') }}" rel="stylesheet">
    <link href="{{ asset ('css/frontend_css/passtrength.css') }}" rel="stylesheet">


    <!-- JavaScripts -->
    <script src="{{ asset ('js/frontend_js/modernizr.js') }}" ></script>

    <!-- Online Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Playfair+Display:400,700,900' rel='stylesheet' type='text/css'>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>

    @include('layouts.frontLayout.front_header')

    @yield('content')

    @include('layouts.frontLayout.front_footer')

<script src="{{ asset ('js/frontend_js/jquery-1.11.3.min.js') }}" ></script>
<script src="{{ asset ('js/frontend_js/bootstrap.min.js') }}" ></script>
<script src="{{ asset ('js/frontend_js/own-menu.js') }}" ></script>
<script src="{{ asset ('js/frontend_js/jquery.lighter.js') }}" ></script>
<script src="{{ asset ('js/frontend_js/owl.carousel.min.js') }}" ></script>
<script src="{{ asset ('js/frontend_js/jquery.validate.js') }}" ></script>
<script src="{{ asset ('js/frontend_js/jquery.passtrength.js') }}" ></script>

<!-- SLIDER REVOLUTION 4.x SCRIPTS  -->
    <script type="text/javascript" src="{{ asset ('rs-plugin/js/jquery.tp.t.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset ('rs-plugin/js/jquery.tp.min.js')}}"></script>
    <script src="{{ asset ('js/frontend_js/main.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
</body>
</html>
