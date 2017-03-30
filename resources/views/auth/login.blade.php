@extends('layouts.master')

<section class="feature-image feature-image-default" data-type="background" data-speed="2">
    <h1>Cadastro de Parceiros</h1>
</section>

@section('content')

    {{--{!! Html::ul($errors->all()) !!}--}}



    {{--{{ Form::hidden('id',  (isset($id) ? $id : ''),array('id' => 'id')) }}--}}
    <div class="container">
        <div class="row" id="primary">
            <div id="content" class="col-sm-12">
                <form class="form-horizontal" id="form" action="{{ url('/login') }}" method="post">
                    <input type="hidden" name="uploads" id="uploads" value="">
                    <input type="hidden" name="services" id="services" value="">

    {{--@if($page == '1')--}}
	    {{--@include('layouts.includes.register_page1')--}}
    {{--@elseif($page == '2')--}}
        {{--@include('layouts.includes.register_page2')--}}
    {{--@else--}}
        @include('layouts.includes.register_login')
    {{--@endif--}}

                {!! csrf_field() !!}
                </form>
            </div><!-- content -->
        </div><!-- primary -->
    </div><!-- container -->
@endsection