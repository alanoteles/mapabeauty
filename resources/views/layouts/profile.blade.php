@extends('layouts.master')

<section class="feature-image feature-image-default" data-type="background" data-speed="2">
    <h1>Cadastro de Parceiros</h1>
</section>

@section('content')

    {{--{!! Html::ul($errors->all()) !!}--}}

    {{--{{ Form::open(--}}
       {{--array(--}}
           {{--'url'   => 'profile/' .  (isset($id) ? $id : '' ),--}}
           {{--'name'  => 'frm',--}}
           {{--'id'    => 'frm',--}}
           {{--'class' => 'form-horizontal',--}}
           {{--'role'  => 'form',--}}
           {{--'files' => true,--}}
           {{--'method'    =>  'PUT' )--}}
           {{--)--}}
       {{--}}--}}

    {{--{{ Form::hidden('id',  (isset($id) ? $id : ''),array('id' => 'id')) }}--}}

    @if($page == '1')
	    @include('layouts.includes.register_page1')
    @elseif($page == '2')
        @include('layouts.includes.register_page2')
    @else
        @include('layouts.includes.register_login')
    @endif

@endsection