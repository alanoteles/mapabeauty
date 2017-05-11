@extends('admin.layouts.master')

@section('title','Tipo de Mídia')

@section('content')

    {!! Html::ul($errors->all()) !!}

    {{ Form::open(
       array(
           'url'   => App::getLocale() . '/admin/tabelas-de-apoio/tipo-de-midia/' .  (isset($resultado->id) ? $resultado->id : '' ),
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
                    Excluir tipo de mídia
                </button>
            @endif

            <a href="" data-route="/admin/tabelas-de-apoio/tipo-de-midia"  class="btn cancelar btn-sm font-size-15 margin-right-2" style="padding: 3px 10px 4px 10px;">Cancelar</a>
            <button type="submit" class="btn btn-success salvar no-margin">Salvar</button>
        </div>
        <br clear="all">
        <div class="tabbable">
            <ul class="nav nav-tabs" id="myTab">
                <li class="active"><a data-toggle="tab" href="#acesso">Dados gerais</a></li>
                <li class=""><a data-toggle="tab" href="#aba-imagens">Imagens</a></li>

                @if(isset($resultado))
                    <li class=""><a data-toggle="tab" href="#aba-traducoes">Tradução</a></li>
                @endif

            </ul>

            <div class="tab-content">


                <!-- dados gerais -->
                <div id="acesso" class="tab-pane  margin-top-45  margin-bottom-45 active">

                    <div class="form-group fotm-tab">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tipo de mídia *</label>
                        <div class="col-sm-6">
                            {{ Form::text('type', (isset($resultado->type) ? $resultado->type : ''), array('class' => 'col-sm-12', 'id' => 'type', 'maxlength' =>'100')) }}
                        </div>
                    </div>

                </div>
                <!-- / dados gerais -->


                <!-- dados complementares -->
                <div id="aba-imagens" class="tab-pane">

                    <h3 class="header smaller lighter blue font-size-18 margin-bottom-25 margin-top-20" style="font-weight: 400;">
                        Ícone
                    </h3>

                    <div class="form-group fotm-tab">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Texto alternativo da imagem * </label>
                        <div class="col-sm-6">
                            {{ Form::text('alt_image', (isset($resultado->alt_image) ? $resultado->alt_image : ''), array('class' => 'col-sm-12', 'id' => 'alt_image')) }}
                        </div>
                    </div>

                    <div class="form-group fotm-tab">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Imagem * </label>
                        <div class="col-sm-6">
                            <div class="ace-file-input no-margin">
                                <input type="file" name="imagem-icon" id="imagem-icon" class="input-file" style="position: absolute;z-index: 1;opacity: 0;width: 100%; height: 29px;cursor: pointer;">
                                <label class="file-label" data-title="Localizar">
                                    <span class="file-name" data-title="Sem imagem"><i class="icon-upload-alt"></i></span>
                                </label>
                                <a class="remove" href="#"><i class="icon-remove"></i></a>
                            </div>
                            <p>Dica: formato PNG &nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp; Tamanho 46px X 46px</p>
                        </div>
                    </div>

                    <div class="form-group fotm-tab margin-top-40">
                        <label class="col-sm-3 control-label no-padding-right">Visualização :</label>
                        <div class="col-sm-9">
                            <div class="margin-top-10">
                                @if(!empty($resultado->icon_image))
                                    <img src="{{ asset('uploads/tipo-de-midia/' . $resultado->icon_image) }}"  alt="">

                                @else
                                    Nenhum arquivo
                                @endif


                            </div>
                        </div>
                    </div>


                    <!-- ========== -->


                    <h3 class="header smaller lighter blue font-size-18 margin-bottom-25 margin-top-50" style="font-weight: 400;">
                        Imagem de capa padrão
                    </h3>

                    <div class="form-group fotm-tab">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Texto alternativo da imagem * </label>
                        <div class="col-sm-6">
                            {{ Form::text('alt_cover', (isset($resultado->alt_cover) ? $resultado->alt_cover : ''), array('class' => 'col-sm-12', 'id' => 'alt_cover')) }}
                        </div>
                    </div>

                    <div class="form-group fotm-tab">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Imagem * </label>
                        <div class="col-sm-6">
                            <div class="ace-file-input no-margin">
                                <input type="file" name="imagem-capa" id="imagem-capa" class="input-file" style="position: absolute;z-index: 1;opacity: 0;width: 100%; height: 29px;cursor: pointer;">
                                <label class="file-label" data-title="Localizar">
                                    <span class="file-name" data-title="Sem imagem"><i class="icon-upload-alt"></i></span>
                                </label>
                                <a class="remove" href="#"><i class="icon-remove"></i></a>
                            </div>
                            <p>Dica: formato PNG &nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp; Tamanho 306px X 194px</p>
                        </div>
                    </div>
                    <div class="form-group fotm-tab margin-top-40">
                        <label class="col-sm-3 control-label no-padding-right">Visualização :</label>
                        <div class="col-sm-9">
                            <div class="margin-top-10">
                                @if(!empty($resultado->cover_image))
                                    <img src="{{ asset('uploads/tipo-de-midia/' . $resultado->cover_image) }}"  alt="">

                                @else
                                    Nenhum arquivo
                                @endif


                            </div>
                        </div>
                    </div>

                </div>
                <!-- / dados complementares -->


                @if(isset($resultado))
                    <div id="aba-traducoes" class="tab-pane margin-top-45 margin-bottom-45">

                        <h3 class="header smaller lighter blue font-size-18 margin-bottom-25 margin-top-45" style="font-weight: 400;">
                            Seleção do idioma
                        </h3>

                        <div class="form-group fotm-tab">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Traduções desse tipo de mídia </label>
                            <div class="col-sm-9 font-size-16 font-weight-700" >

                                @foreach($idiomas as $key => $i)
                                    @if($i->name != 'pt_br')

                                        <span {{ ($resultado->translation->contains('locale', strtolower($i->name))) ? '' : ' class=inactive' }}>{{ strtoupper($i->name) }}</span>

                                        @if($key < ($idiomas->count()-1))
                                            {{  ' | ' }}
                                        @endif

                                    @endif
                                @endforeach

                            </div>
                        </div>

                        <div class="form-group fotm-tab">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Idioma </label>
                            <div class="col-sm-3">

                                <select class="form-control col-sm-12 idioma_trad" id="language" name="language" data-id="{{ isset($resultado->id) ? $resultado->id : '' }}">
                                    <option value="">Selecione</option>

                                    @foreach($idiomas as $key => $i)
                                        @if($i->name != 'pt_br')
                                            <option value="{{ $i->name }}">{{ $i->title }}</option>
                                        @endif
                                    @endforeach

                                </select>

                            </div>
                        </div>

                        <h3 class="header smaller lighter blue font-size-18 margin-bottom-25 margin-top-45" style="font-weight: 400;">
                            Dados gerais
                        </h3>

                        <div class="form-group fotm-tab margin-top-35">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tipo de mídia</label>
                            <div class="col-sm-8">
                                {{ Form::text('type_trad', '', array('class' => 'col-sm-12', 'id' => 'type_trad', 'maxlength' =>'100')) }}
                            </div>

                            <div class="col-sm-1 align-right padding-top-3 dialog-traducao">
                                <a href=""><img src="{{ asset('admin/assets/images/icon_dialog.png') }}" alt=""></a>
                            </div>
                        </div>

                        <h3 class="header smaller lighter blue font-size-18 margin-bottom-25 margin-top-20" style="font-weight: 400;">
                            Ícone
                        </h3>

                        <div class="form-group fotm-tab">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Texto alternativo da imagem * </label>
                            <div class="col-sm-6">
                                {{ Form::text('alt_image_trad', '', array('class' => 'col-sm-12', 'id' => 'alt_image_trad')) }}
                            </div>

                            <div class="col-sm-1 align-right padding-top-3 dialog-traducao">
                                <a href=""><img src="{{ asset('admin/assets/images/icon_dialog.png') }}" alt=""></a>
                            </div>
                        </div>


                        <h3 class="header smaller lighter blue font-size-18 margin-bottom-25 margin-top-50" style="font-weight: 400;">
                            Imagem de capa padrão
                        </h3>

                        <div class="form-group fotm-tab">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Texto alternativo da imagem * </label>
                            <div class="col-sm-6">
                                {{ Form::text('alt_cover_trad', '', array('class' => 'col-sm-12', 'id' => 'alt_cover_trad')) }}
                            </div>

                            <div class="col-sm-1 align-right padding-top-3 dialog-traducao">
                                <a href=""><img src="{{ asset('admin/assets/images/icon_dialog.png') }}" alt=""></a>
                            </div>
                        </div>
                    </div>
                @endif

            </div>

            <br clear="all"><br clear="all">
        </div>

    {{ Form::close() }}


@include('admin.includes.paginacao')

<!-- scripts exclusivos desta area -->
<script src="{{asset('admin/js/modalidade.js')}}"></script>

@endsection('content')