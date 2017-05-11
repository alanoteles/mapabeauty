@extends('admin.layouts.master')

@section('title','Nível')

@section('content')

    {!! Html::ul($errors->all()) !!}

    {{ Form::open(
       array(
           'url'   => App::getLocale() . '/admin/tabelas-de-apoio/nivel/' .  (isset($id) ? $id : '' ),
           'name'  => 'frm',
           'id'    => 'frm',
           'class' => 'form-horizontal',
           'role'  => 'form',
           'files' => true,
           'method'    =>  'PUT' )
           )
       }}

    {{ Form::hidden('locale', App::getLocale()) }}
    {{ Form::hidden('id',  (isset($id) ? $id : ''),array('id' => 'id')) }}
    {{ Form::hidden('novos_niveis',     '',array('id' => 'novos_niveis')) }}
    {{ Form::hidden('niveis_apagados',  '',array('id' => 'niveis_apagados')) }}
    {{ Form::hidden('model', (isset($model) ? $model : ''), array('id' => 'model')) }}

        <div class="col-xs-12 botoes-pj-pf">
            <a href="" data-route="/admin/tabelas-de-apoio/nivel"  class="btn cancelar btn-sm font-size-15 margin-right-2" style="padding: 3px 10px 4px 10px;">Cancelar</a>
            <button type="submit" class="btn btn-success salvar no-margin">Salvar</button>
        </div>

        <br clear="all">
        <div class="tabbable">
            <ul class="nav nav-tabs" id="myTab">
                <li class="active"><a data-toggle="tab" href="#acesso">Dados gerais</a></li>
                {{--<li class=""><a data-toggle="tab" href="#traducao">Tradução</a></li>--}}
            </ul>

            <div class="tab-content">


                <!-- dados gerais -->
                <div id="acesso" class="tab-pane  margin-top-45  margin-bottom-45 active">



                    @if($id == 'L')

                        <h3 class="header smaller lighter blue font-size-18 margin-bottom-25 margin-top-45" style="font-weight: 400;">
                            {{ $tipo }}
                        </h3>

                        <div class="form-group fotm-tab">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Incluir linha </label>
                            <div class="col-sm-6 div-tags">
                                 <input type="text" id="novalinha" placeholder="" class="col-sm-12 novonivel">

                            </div>
                            <div class="col-sm-1  no-padding-left">
                                <button class="btn btn-sm btn-primary col-sm-12 bnt-add" id="addLinha"
                                        style="padding: 3px 9px;margin-top: -1px;">+
                                </button>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-7 no-padding margin-bottom-10">
                                <hr class="no-margin margin-bottom-15 no-padding" style="width:100.5%">
                            </div>
                        </div>

                        <div class="form-group fotm-tab">
                            <div class="col-sm-3">
                                &nbsp;
                            </div>
                            <div class="col-sm-7">
                                <div class="tags col-sm-11 tagsnew" style="width: 100% !important; min-height: 100px !important;">
                                    @if($linhas != '')
                                        @foreach($linhas as $o)

                                            <span class="tag item" data-id="{{ $o->id }}">{{ $o->title }}
                                                <button type="button" class="close" onClick="removeNivel(this)">×</button>
                                            </span>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif

                    @if($id == 'T')

                        <h3 class="header smaller lighter blue font-size-18 margin-bottom-25 margin-top-45" style="font-weight: 400;">
                            Linha
                        </h3>

                        <div class="form-group fotm-tab">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Linhas </label>
                            <div class="col-sm-6 div-tags">
                                {{-- <input type="text" id="tagsnew" placeholder="" class="col-sm-12"> --}}
                                {{--{{ Form::select(--}}
                                           {{--'tagsnew',--}}
                                           {{--array_pluck($linhas, 'title', 'id'),--}}
                                           {{--0,--}}
                                           {{--[--}}
                                               {{--'class'         => 'form-control col-sm-11',--}}
                                               {{--'placeholder'   => 'Selecione uma linha',--}}
                                               {{--'id'            => 'select_linhas'--}}
                                           {{--]--}}
                                   {{--) }}--}}
                                <select name="linha" id="linha_nivel" class="form-control select_nivel" placeholder="Linha">
                                    <option value="0">Todos os tipos</option>
                                    @foreach($linhas as $linha)

                                        <option value="{{ $linha->id }}">{{ $linha->title }}</option>

                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <h3 class="header smaller lighter blue font-size-18 margin-bottom-25 margin-top-45" style="font-weight: 400;">
                            {{ $tipo }}
                        </h3>

                        <div class="form-group fotm-tab">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Incluir tema </label>
                            <div class="col-sm-6 div-tags">
                                <input type="text" id="novotema" placeholder="" class="col-sm-12 novonivel">

                            </div>
                            <div class="col-sm-1  no-padding-left">
                                <button class="btn btn-sm btn-primary col-sm-12 bnt-add" id="addTema"
                                        style="padding: 3px 9px;margin-top: -1px;">+
                                </button>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-7 no-padding margin-bottom-10">
                                <hr class="no-margin margin-bottom-15 no-padding" style="width:100.5%">
                            </div>
                        </div>

                        <div class="form-group fotm-tab">
                            <div class="col-sm-3">
                                &nbsp;
                            </div>
                            <div class="col-sm-7">
                                <div class="tags col-sm-11 temasnew" style="width: 100% !important; min-height: 100px !important;">
                                    @if($temas != '')
                                        @foreach($temas as $o)
                                            <span class="tag item" data-id="{{ $o->id }}">{{ $o->title }}
                                                <button type="button" class="close" onClick="removeNivel(this)">×</button>
                                            </span>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif

                    @if($id == 'S')

                        <h3 class="header smaller lighter blue font-size-18 margin-bottom-25 margin-top-45" style="font-weight: 400;">
                            Tema
                        </h3>

                        <div class="form-group fotm-tab">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Temas </label>
                            <div class="col-sm-6 div-tags">

                                <select name="tema" id="tema_nivel" class="form-control select_nivel" placeholder="Tema">
                                    <option value="0">Selecione um tema</option>
                                    @foreach($temas as $tema)

                                        <option value="{{ $tema->id }}">{{ $tema->title }}</option>

                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <h3 class="header smaller lighter blue font-size-18 margin-bottom-25 margin-top-45" style="font-weight: 400;">
                            {{ $tipo }}
                        </h3>

                        <div class="form-group fotm-tab">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Incluir subtema </label>
                            <div class="col-sm-6 div-tags">
                                <input type="text" id="novotema" placeholder="" class="col-sm-12 novonivel">

                            </div>
                            <div class="col-sm-1  no-padding-left">
                                <button class="btn btn-sm btn-primary col-sm-12 bnt-add" id="addSubtema"
                                        style="padding: 3px 9px;margin-top: -1px;">+
                                </button>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-7 no-padding margin-bottom-10">
                                <hr class="no-margin margin-bottom-15 no-padding" style="width:100.5%">
                            </div>
                        </div>

                        <div class="form-group fotm-tab">
                            <div class="col-sm-3">
                                &nbsp;
                            </div>
                            <div class="col-sm-7">
                                <div class="tags col-sm-11 tagsnew"
                                     style="width: 100% !important; min-height: 100px !important;">
                                    @if($subtemas != '')
                                        @foreach($subtemas as $o)
                                            <span class="tag item" data-id="{{ $o->id }}">{{ $o->title }}
                                                <button type="button" class="close" onClick="removeNivel(this)">×</button></span>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif

                </div>
                <!-- / dados gerais -->


                <div id="traducao" class="tab-pane margin-top-45 margin-bottom-45">

                    <h3 class="header smaller lighter blue font-size-18 margin-bottom-25 margin-top-45" style="font-weight: 400;">
                        Seleção do idioma
                    </h3>

                    <div class="form-group fotm-tab">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Traduções desse objeto </label>
                        <div class="col-sm-9 font-size-16 font-weight-700" >
                            <span id="label_en">EN</span> |
                            <span id="label_es" class="inactive">ES</span>
                        </div>
                    </div>

                    <div class="form-group fotm-tab">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Idioma </label>
                        <div class="col-sm-3">
                            <select class="form-control col-sm-12 idioma_trad" id="locale_translation" name="locale_translation" >
                                <option value="">Selecione</option>
                                <option value="en">Inlgês</option>
                                <option value="es">Espanhol</option>
                            </select>
                        </div>
                    </div>

                    <h3 class="header smaller lighter blue font-size-18 margin-bottom-25 margin-top-45" style="font-weight: 400;">
                        Dados gerais
                    </h3>

                    <div class="form-group fotm-tab margin-top-35">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Nível</label>
                        <div class="col-sm-8">
                            {{ Form::text('name_translation', '', array('class' => 'col-sm-12', 'id' => 'name_translation', 'maxlength' =>'100')) }}
                        </div>

                        <div class="col-sm-1 align-right padding-top-3">
                            <a href="javascript:void(0)" id="id-btn-dialog1" ><img src="{{ asset('admin/assets/images/icon_dialog.png') }}" alt=""></a>
                        </div>
                    </div>

                </div>

            </div>

            <br clear="all"><br clear="all">
        </div>

    {{ Form::close() }}


@include('admin.includes.paginacao')

<!-- scripts exclusivos desta area -->
<script src="{{asset('admin/js/nivel.js')}}"></script>

@endsection('content')