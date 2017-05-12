@extends('admin.layouts.master')

@section('title','Produtos')

@section('content')

    {{--{!! Html::ul($errors->all()) !!}--}}

    {{ Form::open(
       array(
           'url'   => '/admin/tabelas-de-apoio/products' .  (isset($resultado->id) ? '/' . $resultado->id : '' ),
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

            @if(isset($resultado->id) && $resultado->status != 'D')
                <button type="button" class="btn remover-item margin-right-20 margin-left-2 excluir" data-id="{{$resultado->id}}">
                    Excluir produto
                </button>
            @endif

            <a href="/admin/tabelas-de-apoio/products" class="btn cancelar btn-sm font-size-15 margin-right-2" style="padding: 3px 10px 4px 10px;">Cancelar</a>
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

                    @if(!empty($resultado))
                        @if($resultado->status != 'D')
                            <div class="exibir-sim-nao margin-bottom-15">
                                <span>Exibir</span>
                                <div class="checkbox_sim_nao pull-right margin-left-30">
                                    <div class="tipo {{ isset($resultado->status) ? ($resultado->status == '1' ? 'sim' : 'nao') : '1' }}">
                                        <div class="icon">✓</div>
                                        <div class="texto"></div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif

                    <div class="form-group fotm-tab">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Produto *</label>
                        <div class="col-sm-6">
                            {{ Form::text('description', (isset($resultado->description) ? $resultado->description : ''), array('class' => 'col-sm-12', 'id' => 'description', 'maxlength' =>'100')) }}
                        </div>
                    </div>

                    <div class="form-group fotm-tab">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Valor </label>
                        <div class="col-sm-3">
                            {{ Form::text('value', !empty($resultado->value) ? number_format($resultado->value, 2, ',', '.') : '', array('class' => 'col-sm-12 money2', 'id' => 'value')) }}
                        </div>
                    </div>

                    @if(!empty($resultado))
                        @if($resultado->status != 'D')
                            <div class="form-group fotm-tab">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Quant. de dias</label>
                                <div class="col-sm-2">
                                    {{ Form::text('days', (isset($resultado->days) ? $resultado->days : ''), array('class' => 'col-sm-12', 'id' => 'days', 'maxlength' =>'2')) }}
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
                <!-- / dados gerais -->

            </div>

            <br clear="all"><br clear="all">
        </div>

    {{ Form::close() }}


@include('admin.includes.paginacao')

<!-- scripts exclusivos desta area -->
<script src="{{asset('admin/js/products.js')}}"></script>

@endsection('content')