<!DOCTYPE html>
<?php
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
?>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>Mapa Beauty - @yield('title')</title>

    <meta name="description" content="overview &amp; stats"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- basic styles -->

    <link href="{{asset('admin/assets/css/bootstrap.min.css')}}" rel="stylesheet"/>
    <link rel="stylesheet" href="{{asset('admin/assets/css/font-awesome.min.css')}}"/>

    <!-- Custom CSS -->
{{--    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">--}}

    <!--[if IE 7]>
    <link rel="stylesheet" href="{{asset('admin/assets/css/font-awesome-ie7.min.css')}}"/>
    <![endif]-->

    <!-- page specific plugin styles -->
    {{--<link rel="stylesheet" href="{{asset('admin/assets/css/jquery-ui-1.10.3.full.min.css')}}"/>--}}
    <link rel="stylesheet" href="{{ asset('admin/assets/css/jquery-ui-1.10.3.custom.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/css/chosen.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/css/datepicker.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/css/bootstrap-timepicker.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/css/daterangepicker.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/css/colorpicker.css') }}" />

    <!-- fonts -->

    <link rel="stylesheet" href="{{asset('admin/assets/css/ace-fonts.css')}}"/>

    <!-- ace styles -->

    <link rel="stylesheet" href="{{asset('admin/assets/css/ace.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('admin/assets/css/ace-rtl.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('admin/assets/css/ace-skins.min.css')}}"/>


    <link rel="stylesheet" href="{{ asset('admin/assets/css/style-crop.css') }}" type="text/css" />

    <link rel="stylesheet" href="{{asset('admin/assets/css/style-admin.css')}}"/>

    <link href="{{ asset('assets/css/jquery.bxslider.min.css') }}" rel="stylesheet">

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
    <input type="hidden" id="app_locale" value="{{ App::getLocale() }}">

    @include('admin.includes.barra_topo')

    <div class="main-container" id="main-container">

        <div class="main-container-inner">

            <!-- Ativa o menu mobile -->
            <a class="menu-toggler" id="menu-toggler" href="#"><span class="menu-text"></span></a>

            <!-- Menu lateral esquerdo -->
            @include('admin.includes.menu')

                    <!-- LATERAL DIREITA -->
            <div class="main-content">


                <!-- MIGALHA -->
                @include('admin.includes.breadcrumbs')



                <!-- WRAP DOS DADOS -->
                <div class="wrap-content">

                    <!-- *** CONTEÚDO *** -->
                    @yield('content')

                    </div>
                </div>
                <!-- / WRAP DOS DADOS -->

            </div>
            <!-- / LATERAL DIREITA -->



        </div><!-- /.main-container-inner -->
    </div><!-- /.main-container -->

    <!-- #dialog-message -->
    <div id="dialog-message" class="hide"></div>
    <!-- / #dialog-message -->

    <!-- basic scripts -->
    <script type="text/javascript">
        if ("ontouchend" in document) document.write("<script src='{{asset('admin/assets/js/jquery.mobile.custom.min.js')}}'>" + "<" + "/script>");
    </script>
    <script src="{{asset('admin/assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/typeahead-bs2.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/bootbox.min.js')}}"></script>
    <!-- page specific plugin scripts -->

    <!--[if lte IE 8]>
    <script src="{{asset('admin/assets/js/excanvas.min.js')}}"></script>
    <![endif]-->

    <script src="{{asset('admin/assets/js/jquery-ui-1.10.3.custom.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/jquery.ui.touch-punch.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/jquery.slimscroll.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/jquery.easy-pie-chart.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/jquery.sparkline.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/flot/jquery.flot.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/flot/jquery.flot.pie.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/flot/jquery.flot.resize.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/jquery-ui-1.10.3.full.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/jquery.ui.touch-punch.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/chosen.jquery.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/fuelux/fuelux.spinner.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/date-time/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/date-time/locales/bootstrap-datepicker.pt-BR.js')}}"></script>
    <script src="{{asset('admin/assets/js/date-time/bootstrap-timepicker.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/date-time/moment.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/date-time/daterangepicker.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/bootstrap-colorpicker.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/jquery.knob.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/jquery.autosize.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/jquery.inputlimiter.1.3.1.min.js')}}"></script>
    {{--<script src="{{asset('admin/assets/js/jquery.maskedinput.min.js')}}"></script>--}}
    <script src="{{asset('admin/assets/js/bootstrap-tag.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/jquery.mask.min.js')}}"></script>
    <script src="{{ asset('assets/js/jquery.bxslider/jquery.bxslider.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/js/valida_cpf_cnpj.js') }}"></script>

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

    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <img id="modal_image" src="" alt="">


            </div>
        </div>
    </div>
</body>
</html>