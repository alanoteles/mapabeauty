@extends('admin.layouts.master-login')

@section('title','Página Inicial')


@section('content')

          <div class="text-center"> <img src="{{ asset('admin/assets/images/') }}/logo_telescope.jpg"></div>

          @if(isset($mensagem))
          <div class="text-center margin-top-10 red"> <h5>{{ $mensagem }}</h5></div>
          @endif

        {{--<form name="frm" id="frm" class="form-horizontal" role="form">--}}

{{--        {{ Form::open(array('url' => App::getLocale() . '/admin/login')) }}--}}
      {{ Form::open(
        array(
            'url'   => '/admin/login',
            'name'  => 'frm',
            'id'    => 'frm',
            'class' => 'form-horizontal',
            'role'  => 'form',
            'method'    => 'POST' )
            )
        }}


            <br clear="all"/>
            <div class="tabbable">
                <ul class="nav nav-tabs" id="myTab">
                    <li class="active"><a data-toggle="tab" href="#aba-gerais">Login</a></li>
                </ul>

                <div class="tab-content">


                    <!-- dados gerais -->
                    <div id="aba-gerais" class="tab-pane margin-bottom-45 active">


                        {{--{{ $errors->first('email') }}--}}
                        {{--{{ $errors->first('password') }}--}}

                        <h3 class="header smaller lighter blue font-size-18 margin-bottom-25 margin-top-20" style="font-weight: 400;">
                            Entre com seus dados de acesso
                        </h3>

                        <div class="form-group fotm-tab margin-top-35">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> E-mail de acesso </label>
                            <div class="col-sm-9">
                                <input type="text" id="email" name="email" class="col-sm-12" required="true">
                            </div>
                        </div>

                        <div class="form-group fotm-tab">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Senha </label>
                            <div class="col-sm-9">
                                <input type="password" id="password" name="password" class="col-sm-12" required="true">
                                {{--{{ Form::password('password') }}--}}
                            </div>
                        </div>

                        <div class="col-xs-12 botoes-pj-pf padding-bottom-20">
                            <button type="submit" class="btn btn-success salvar">Entrar</button>
                        </div>
                        <br>
                    </div>
                    <!-- / dados gerais -->

                    <!--  -->


                </div>
            </div>
        {{ Form::close() }}
        {{--</form>--}}


@endsection('content')
{{--<html>--}}
{{--<head>--}}
    {{--<title>Look at me Login</title>--}}
{{--</head>--}}
{{--<body><--}}

{{--{{ Form::open(array('url' => App::getLocale() . '/admin/login')) }}--}}
{{--<h1>Login</h1>--}}

{{--<!-- if there are login errors, show them here -->--}}
{{--<p>--}}
    {{--{{ $errors->first('email') }}--}}
    {{--{{ $errors->first('password') }}--}}
{{--</p>--}}

{{--<p>--}}
    {{--{{ Form::label('email', 'Email Address') }}--}}
    {{--{{ Form::text('email', '', array('placeholder' => 'awesome@awesome.com')) }}--}}
{{--</p>--}}

{{--<p>--}}
    {{--{{ Form::label('password', 'Password') }}--}}
    {{--{{ Form::password('password') }}--}}
{{--</p>--}}

{{--<p>{{ Form::submit('Submit!') }}</p>--}}
{{--{{ Form::close() }}--}}

