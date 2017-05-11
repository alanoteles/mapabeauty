@extends('admin.layouts.master')

@section('title','Serviços')

@section('content')

    {{--{!! Html::ul($errors->all()) !!}--}}

    {{ Form::open(
       array(
           'url'   => '/admin/tabelas-de-apoio/services' .  (isset($resultado->id) ? '/' . $resultado->id : '' ),
           'name'  => 'frm',
           'id'    => 'frm',
           'class' => 'form-horizontal',
           'role'  => 'form',
           'files' => true,
           'method'    => (isset($resultado->id) ? 'PUT' : 'POST' ))
           )
       }}

    {{ Form::hidden('locale', App::getLocale()) }}
    {{ Form::hidden('status', (isset($resultado->status) ? $resultado->status : '1'), array('id' => 'status')) }}
    {{ Form::hidden('id',  (isset($resultado->id) ? $resultado->id : '')) }}
    {{ Form::hidden('model', (isset($model) ? $model : ''), array('id' => 'model')) }}

        <div class="col-xs-12 botoes-pj-pf">

            @if(isset($resultado->id))
                <button type="button" class="btn remover-item margin-right-20 margin-left-2 excluir" data-id="{{$resultado->id}}">
                    Excluir serviço
                </button>
            @endif

            <a href="/admin/tabelas-de-apoio/services" class="btn cancelar btn-sm font-size-15 margin-right-2" style="padding: 3px 10px 4px 10px;">Cancelar</a>
            <button type="submit" class="btn btn-success salvar no-margin">Salvar</button>
        </div>
        <br clear="all">
        <div class="tabbable">
            <ul class="nav nav-tabs" id="myTab">
                <li class="active"><a data-toggle="tab" href="#acesso">Dados gerais</a></li>
            </ul>

            <div class="tab-content">


                <!-- dados gerais -->
                <div id="acesso" class="tab-pane  margin-top-10  margin-bottom-25 active">

                    <div class="exibir-sim-nao margin-bottom-45">
                        <span>Exibir</span>
                        <div class="checkbox_sim_nao pull-right margin-left-30">
                            <div class="tipo {{ isset($resultado->status) ? ($resultado->status == '1' ? 'sim' : 'nao') : '1' }}">
                                <div class="icon">✓</div>
                                <div class="texto"></div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group fotm-tab">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Serviço *</label>
                        <div class="col-sm-6">
                            {{ Form::text('description', (isset($resultado->description) ? $resultado->description : ''), array('class' => 'col-sm-12', 'id' => 'description', 'maxlength' =>'100')) }}
                        </div>
                    </div>

                </div>
                <!-- / dados gerais -->

            </div>

            <br clear="all"><br clear="all">
        </div>

    {{ Form::close() }}


@include('admin.includes.paginacao')

<!-- scripts exclusivos desta area -->
<script src="{{asset('admin/js/services.js')}}"></script>

@endsection('content')