@extends('layouts.master')

<section class="feature-image feature-image-default" data-type="background" data-speed="2">
    <h1>Cadastro de Parceiros</h1>
</section>

@section('content')

    <div class="container">

        <div class="row" id="primary">
            <div id="content" class="col-sm-12">

                @if(!empty($message))
                    <div class="alert alert-{{ $message['type'] }} fade in">
                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                        {{ $message['msg'] }}
                    </div>
                @endif

                <form class="form-horizontal" id="form" action="profile" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="uploads" id="uploads" value="{{ !empty($gallery_profile) ? $gallery_profile : '' }}">
                    <input type="hidden" name="services" id="services" value="{{ !empty($profile_service) ? $profile_service : '' }}">
                    <input type="hidden" name="city" id="city" value="{{ !empty($city) ? $city : '' }}">
                    <input type="hidden" name="state" id="state" value="{{ !empty($state) ? $state : '' }}">
                    <input type="hidden" name="detached_selected" id="detached_selected" value="">

                    @include('layouts.includes.register_page1')
                    @include('layouts.includes.register_page2')
                  
                </form>
            </div><!-- content -->
        </div><!-- primary -->
    </div><!-- container -->
@endsection

<!-- <script type="text/javascript" src="https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.lightbox.js"></script> -->
<script type="text/javascript" src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.lightbox.js"></script>