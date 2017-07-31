<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>MapaBeauty - @yield('title')</title>

    <meta name="description" content="overview &amp; stats"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- basic styles -->

    <link href="{{asset('admin/assets/css/bootstrap.min.css')}}" rel="stylesheet"/>
    <link rel="stylesheet" href="{{asset('admin/assets/css/font-awesome.min.css')}}"/>

    <!--[if IE 7]>
    <link rel="stylesheet" href="{{asset('admin/assets/css/font-awesome-ie7.min.css')}}"/>
    <![endif]-->

    <!-- fonts -->

    <link rel="stylesheet" href="{{asset('admin/assets/css/ace-fonts.css')}}"/>

    <!-- ace styles -->

    <link rel="stylesheet" href="{{asset('admin/assets/css/ace.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('admin/assets/css/ace-rtl.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('admin/assets/css/ace-skins.min.css')}}"/>


    {{--<link rel="stylesheet" href="{{ asset('admin/assets/css/style-crop.css') }}" type="text/css" />--}}

    <link rel="stylesheet" href="{{asset('admin/assets/css/style-admin.css')}}"/>


    <!--[if lte IE 8]>
    <link rel="stylesheet" href="{{ asset('admin/assets/css/ace-ie.min.css') }}"/>
    <![endif]-->

    <!-- inline styles related to this page -->

    <!-- ace settings handler -->

    <script src="{{asset('admin/assets/js/ace-extra.min.js')}}"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

    <!--[if lt IE 9]>
    <script src="{{ asset('admin/assets/js/html5shiv.js') }}"></script>
    <script src="{{ asset('admin/assets/js/respond.min.js') }}"></script>
    <![endif]-->

    <!-- =============================== SCRIPTS =============================== -->


    <!--[if !IE]> -->
    <script type="text/javascript">
        window.jQuery || document.write("<script src='{{asset('admin/assets/js/jquery-2.0.3.min.js')}}'>" + "<" + "/script>");
    </script>
    <!-- <![endif]-->

    <!--[if IE]>
    <script type="text/javascript">
        window.jQuery || document.write("<script src='{{asset('admin/assets/js/jquery-1.10.2.min.js')}}'>" + "<" + "/script>");
    </script>
    <![endif]-->



</head>

<body>
    {{--<input type="hidden" id="app_locale" value="{{ App::getLocale() }}">--}}

    {{--@include('admin.includes.barra_topo')--}}

    <div class="main-container" id="main-container" style="position: relative;">

        <div class="main-container-inner col-lg-5" style="position: absolute; top: 10%;left: 50%;transform: translate(-50%,15%);">


                <!-- MIGALHA -->
                {{--@include('admin.includes.breadcrumbs')--}}


    {{--<div class="container">--}}
        <!-- WRAP DOS DADOS -->
        <div class="wrap-content">

            <!-- *** CONTEÚDO *** -->
            @yield('content')

        </div>

        <!-- / WRAP DOS DADOS -->

    {{--</div>--}}





        </div><!-- /.main-container-inner -->
    </div><!-- /.main-container -->


    <!-- basic scripts -->
    <script type="text/javascript">
        if ("ontouchend" in document) document.write("<script src='{{asset('admin/assets/js/jquery.mobile.custom.min.js')}}'>" + "<" + "/script>");
    </script>
    <script src="{{asset('admin/assets/js/bootstrap.min.js')}}"></script>
    {{--<script src="{{asset('admin/assets/js/typeahead-bs2.min.js')}}"></script>--}}
    <script src="{{asset('admin/assets/js/bootbox.min.js')}}"></script>
    <!-- page specific plugin scripts -->

    <!--[if lte IE 8]>
    <script src="{{asset('admin/assets/js/excanvas.min.js')}}"></script>
    <![endif]-->


    <!-- ace scripts -->

    <script src="{{asset('admin/assets/js/ace-elements.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/ace.min.js')}}"></script>

    <!-- JS com funções gerais -->
    {{--<script src="{{asset('admin/js/geral.js')}}"></script>--}}

    <!-- CSRF Token para chamadas AJAX -->
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
</body>
</html>