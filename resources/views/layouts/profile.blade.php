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
    <div class="container">
        <div class="row" id="primary">
            <div id="content" class="col-sm-12">
                <form class="form-horizontal" id="form" action="profile" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="uploads[{'a':'3', 'b':'5'}, {'d':'9', 'e':'66'}]" id="uploads" value="">

    {{--@if($page == '1')--}}
	    @include('layouts.includes.register_page1')
    {{--@elseif($page == '2')--}}
        @include('layouts.includes.register_page2')
    {{--@else--}}
        {{--@include('layouts.includes.register_login')--}}
    {{--@endif--}}

                {!! csrf_field() !!}
                </form>
            </div><!-- content -->
        </div><!-- primary -->
    </div><!-- container -->
@endsection