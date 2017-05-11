@extends('admin.layouts.master')

@section('title','Idioma')

@section('content')

        <!-- WRAP DOS DADOS -->
<div class="wrap-content">

    {!! Html::ul($errors->all()) !!}

    {{ Form::open(
       array(
           'url'   => App::getLocale() . '/admin/tabelas-de-apoio/idioma/' .  (isset($idiomas->id) ? $idiomas->id : '' ),
           'name'  => 'frm',
           'id'    => 'frm',
           'class' => 'form-horizontal',
           'role'  => 'form',
           'files' => true,
           'method'    => (isset($idiomas->id) ? 'PUT' : 'POST' ))
           )
       }}

    {{ Form::hidden('locale', App::getLocale()) }}
    {{ Form::hidden('status', (isset($idiomas->status) ? $idiomas->status : '1'), array('id' => 'status')) }}
    {{ Form::hidden('id',  (isset($idiomas->id) ? $idiomas->id : '')) }}
    {{ Form::hidden('model', (isset($model) ? $model : ''), array('id' => 'model')) }}

    <div class="col-xs-12 botoes-pj-pf">
            <button type="button" class="btn remover-item margin-right-20 margin-left-2">Excluir idioma</button>
            <a href="" data-route="/admin/tabelas-de-apoio/idioma/"  class="btn cancelar btn-sm font-size-15 margin-right-2" style="padding: 3px 10px 4px 10px;">Cancelar</a>
            <button type="submit" class="btn btn-success salvar no-margin">Salvar</button>
        </div>
        <br clear="all">
        <div class="tabbable">
            <ul class="nav nav-tabs" id="myTab">
                <li class="active"><a data-toggle="tab" href="#acesso">Dados gerais</a></li>
            </ul>
            <div class="tab-content">


                <!-- dados gerais -->
                <div id="acesso" class="tab-pane  margin-top-45  margin-bottom-45 active">

                    <div class="form-group fotm-tab">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Título *</label>
                        <div class="col-sm-6">
                            {{ Form::text('title', (isset($idiomas->title) ? $idiomas->title : ''), array('class' => 'col-sm-12', 'id' => 'title', 'maxlength' =>'100')) }}
                        </div>
                    </div>

                    <div class="form-group fotm-tab">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Nome *</label>
                        <div class="col-sm-2">
                            {{ Form::text('name', (isset($idiomas->name) ? $idiomas->name : ''), array('class' => 'col-sm-12', 'id' => 'name', 'maxlength' =>'100')) }}
                        </div>
                    </div>

                    <div class="form-group fotm-tab">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Sigla *</label>
                        <div class="col-sm-2">                            
                            {{ Form::text('short', (isset($idiomas->short) ? $idiomas->short : ''), array('class' => 'col-sm-12', 'id' => 'short', 'maxlength' =>'2')) }}
                        </div>
                    </div>

                    <div class="form-group fotm-tab">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> ISO *</label>
                        <div class="col-sm-2">                            
                            {{ Form::text('iso', (isset($idiomas->iso) ? $idiomas->iso : ''), array('class' => 'col-sm-12', 'id' => 'iso', 'maxlength' =>'100')) }}
                        </div>
                    </div>


                </div>
                <!-- / dados gerais -->



            </div>

            <br clear="all"><br clear="all">
        </div>

    {{ Form::close() }}
</div>
<!-- / WRAP DOS DADOS -->

@include('admin.includes.paginacao')

<!-- scripts exclusivos desta area -->
{{--<script src="{{asset('admin/js/noticias.js')}}"></script>--}}

@endsection('content')