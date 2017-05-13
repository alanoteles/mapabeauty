@extends('admin.layouts.master')

@section('title','Serviços')

@section('content')

    {{--{!! Html::ul($errors->all()) !!}--}}

    {{ Form::open(
       array(
           'url'   => '/admin/banners' .  (isset($resultado->id) ? '/' . $resultado->id : '' ),
           'name'  => 'frm',
           'id'    => 'frm',
           'class' => 'form-horizontal',
           'role'  => 'form',
           'enctype' => 'multipart/form-data',
           'method'    => (isset($resultado->id) ? 'PUT' : 'POST' ))
           )
       }}

    {{ Form::hidden('locale', App::getLocale()) }}
    {{ Form::hidden('status', (isset($resultado->status) ? $resultado->status : '1'), array('id' => 'status')) }}
    {{ Form::hidden('id',  (isset($resultado->id) ? $resultado->id : '')) }}
    {{ Form::hidden('model', (isset($model) ? $model : ''), array('id' => 'model')) }}
    {{ Form::hidden('filename', (isset($resultado->filename) ? $resultado->filename : ''), array('id' => 'filename')) }}

        <div class="col-xs-12 botoes-pj-pf">

            @if(isset($resultado->id))
                <button type="button" class="btn remover-item margin-right-20 margin-left-2 excluir" data-id="{{$resultado->id}}">
                    Excluir serviço
                </button>
            @endif

            <a href="/admin/banners" class="btn cancelar btn-sm font-size-15 margin-right-2" style="padding: 3px 10px 4px 10px;">Cancelar</a>
            <button type="submit" class="btn btn-success salvar no-margin">Salvar</button>
        </div>
        <br clear="all">
        <div class="tabbable">
            <ul class="nav nav-tabs" id="myTab">
                <li class="active"><a data-toggle="tab" href="#acesso">Dados gerais</a></li>
            </ul>

            <div class="tab-content">


                <!-- dados gerais -->
                <div id="acesso" class="tab-pane  margin-top-10  margin-bottom-15 active">

                    <div class="exibir-sim-nao margin-bottom-15">
                        <span>Exibir</span>
                        <div class="checkbox_sim_nao pull-right margin-left-30">
                            <div class="tipo {{ isset($resultado->status) ? ($resultado->status == '1' ? 'sim' : 'nao') : '1' }}">
                                <div class="icon">✓</div>
                                <div class="texto"></div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group fotm-tab">
                        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Nome *</label>
                        <div class="col-sm-9">
                            {{ Form::text('description', (isset($resultado->description) ? $resultado->description : ''), array('class' => 'col-sm-12', 'id' => 'description', 'maxlength' =>'100')) }}
                        </div>
                    </div>

                    <div class="form-group fotm-tab">
                        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Texto</label>
                        <div class="col-sm-9">

                            <textarea name="message" id="message" class="form-control descricao-grupo" placeholder="">{{ (isset($resultado->message) ? $resultado->message : '') }}</textarea>

                        </div>
                    </div>

                    <div class="form-group fotm-tab">
                        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Texto do botão *</label>
                        <div class="col-sm-9">
                            {{ Form::text('button_label', (isset($resultado->button_label) ? $resultado->button_label : ''), array('class' => 'col-sm-12', 'id' => 'button_label', 'maxlength' =>'250')) }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Banner</label>
                        <div class="col-sm-9">
                            <input type="file" class="form-control"   name="file" id="file" placeholder="Selecione">
                        </div>

                        <!-- <div class="col-sm-2">
                            <a href="#" class="btn btn-success pull-right">Incluir</a>
                        </div> -->
                    </div>
                    <div class="form-group margin-1">
                        {{--<label class="col-sm-2 control-label no-padding-right" for="form-field-1"></label>--}}
                        <span class="col-sm-9 col-sm-offset-2 help-block small">
                            Dica: Formato PNG com fundo transparente ou JPG.<br>
                            Tamanho da foto : 1263 x 300 px
                        </span>
                    </div>

                    @if(!empty($resultado->filename))
                        <div class="form-group margin-1">
                            <label class="col-sm-2 control-label no-padding-right" for="form-field-1">Imagem </label>
                            <span class="col-sm-9 help-block small">
                                <img src="/uploads/topos/{{ $resultado->filename }}" style="max-width: 100%;vertical-align: middle;">
                            </span>
                        </div>
                    @endif

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