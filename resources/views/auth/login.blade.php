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
                   
                    @include('layouts.includes.register_login')
    
                {!! csrf_field() !!}
                </form>
            </div><!-- content -->
        </div><!-- primary -->
    </div><!-- container -->
@endsection