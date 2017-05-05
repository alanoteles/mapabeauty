
@extends('admin.layouts.master')



@section('title','Profissionais')

@section('content')

    <!-- WRAP DOS DADOS -->
    <div class="wrap-content">

        {{ Form::open(
        array(
            'url'   => '/admin/profiles/' .  (isset($user->id) ? $user->id : '' ),
            'name'  => 'frm',
            'id'    => 'form',
            'class' => 'form-horizontal',
            'role'  => 'form',
            'enctype' => 'multipart/form-data',
            'method'    => (isset($user->id) ? 'PUT' : 'POST' ))
            )
        }}


        {{--{{ Form::hidden('locale', App::getLocale()) }}--}}
        {{--{{ Form::hidden('status', (isset($user->status) ? $user->status : '1'), array('id' => 'status')) }}--}}
        {{--{{ Form::hidden('array_proponentes',(isset($array_proponentes) ? $array_proponentes : ''),  array('id' => 'array_proponentes')) }}--}}
        {{--{{ Form::hidden('array_executores', (isset($array_executores) ? $array_executores : ''),    array('id' => 'array_executores')) }}--}}
        {{--{{ Form::hidden('array_anexos',     (isset($array_anexos) ? $array_anexos : ''),            array('id' => 'array_anexos')) }}--}}
        {{--{{ Form::hidden('city_id', (isset($user->user_detail->city_id) ? $user->user_detail->city_id : '1724'), array('id' => 'city_id')) }}--}}
        {{--{{ Form::hidden('user_id', (isset($user->id) ? $user->id : ''), array('id' => 'user_id')) }}--}}
        {{--{{ Form::hidden('base64_image', '',array('id' => 'base64_image')) }}--}}
        {{--{{ Form::hidden('model', (isset($model) ? $model : ''), array('id' => 'model')) }}--}}


        {{--<form name="frm" id="frm" class="form-horizontal" role="form">--}}

            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="uploads" id="uploads" value="{{ !empty($gallery_profile) ? $gallery_profile : '' }}">
            <input type="hidden" name="services" id="services" value="{{ !empty($profile_service) ? $profile_service : '' }}">
            <input type="hidden" name="city" id="city" value="{{ !empty($city) ? $city : '' }}">
            <input type="hidden" name="state" id="state" value="{{ !empty($state) ? $state : '' }}">
            <input type="hidden" name="detached_selected" id="detached_selected" value="">
            <input type="hidden" name="transactionCode" id="transactionCode" value="">

            <div class="col-xs-12 botoes-pj-pf">
                <button type="button" class="btn gerar-nova-senha">Gerar nova senha</button>
                @if(isset($user))
                    <a class="btn btn-sm font-size-14 margin-right-20 margin-left-2 remover-item" style="padding: 3px 10px 4px 10px;">Excluir usuário</a>
                @endif

                <a href="" data-route="/admin/usuarios"  class="btn cancelar btn-sm font-size-14 margin-right-2" style="padding: 3px 10px 4px 10px;">Cancelar</a>
                <button type="submit" class="btn btn-success salvar no-margin">Salvar</button>
            </div>

            <br clear="all"><br clear="all">

            <div class="tabbable">
                <ul class="nav nav-tabs" id="myTab">
                    <li class="active"><a>Dados do profissional</a></li>
                    {{--<li class=""><a data-toggle="tab" href="#dadospj">Dados pessoa física</a></li>--}}
                    {{--<li class=""><a data-toggle="tab" href="#rodape">Privacidade e conteúdo</a></li>--}}
                </ul>

                <div class="tab-content">


                    <!-- dados gerais -->
                    <div id="acesso" class="tab-pane  margin-top-15  margin-bottom-45 active">


                        <div class="exibir-sim-nao margin-bottom-45">
                            <span>Exibir</span>
                            <div class="checkbox_sim_nao pull-right margin-left-30">
                                <div class="tipo {{ isset($projeto->status) ? ($projeto->status == '1' ? 'sim' : 'nao') : '1' }}">
                                    <div class="icon">✓</div>
                                    <div class="texto"></div>
                                </div>
                            </div>
                        </div>

                        <h3 class="header smaller lighter blue font-size-18 margin-bottom-25 margin-top-50" style="font-weight: 400;">
                            Dados empresariais/profissionais
                        </h3>

                        <div class="form-group fotm-tab">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tipo de pessoa *</label>
                            <div class="col-sm-3">

                                {{--{{ Form::select(--}}
                                                {{--'user_group_id',--}}
                                                {{--array_pluck($grupos, 'name', 'id'),--}}
                                                {{--(isset($user->user_group_id) ? $user->user_group_id : ''),--}}
                                                {{--[--}}
                                                    {{--'class'         =>'form-control col-sm-12',--}}
                                                    {{--'placeholder'   =>'Selecione',--}}
                                                    {{--'id'            => 'user_group_id'--}}
                                                {{--]--}}
                                {{--) }}--}}

                                <select class="form-control" name="professional_type" id="professional_type">
                                    <option value="">Pessoa Física ou Jurídica ? *</option>
                                    <option value="F"
                                    @if(!empty($user->profiles->professional_type))
                                        {{ ($user->profiles->professional_type == 'F' ? 'selected' : '') }}
                                    @endif

                                    >Pessoa Física</option>
                                    <option value="J"
                                    @if(!empty($user->profiles->professional_type))
                                        {{ ($user->profiles->professional_type == 'J' ? 'selected' : '') }}
                                    @endif
                                    >Pessoa Jurídica</option>
                                </select>

                            </div>
                        </div>

                        <div class="form-group fotm-tab">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Nome da empresa/profissional *</label>
                            <div class="col-sm-6">

                                {{--{{ Form::text('email', (isset($user->email) ? $user->email : ''), array('class' => 'col-sm-12', 'id' => 'email')) }}--}}
                                <input type="text" class="form-control" name="professional_name" id="professional_name" placeholder="Nome da empresa/profissional *" value="{{ !empty($user->profiles->professional_name) ? $user->profiles->professional_name : '' }}">

                            </div>
                        </div>

                        <div class="form-group fotm-tab">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">CPF/CNPJ *</label>
                            <div class="col-sm-3">

                                {{--{{ Form::text('email_confirm', '', array('class' => 'col-sm-12', 'id' => 'email_confirm')) }}--}}

                                <input type="text" class="form-control
                                @if(!empty($user->profiles->document) && strlen($user->profiles->document) == 11)
                                        cpf
                                @elseif(!empty($user->profiles->document) && strlen($user->profiles->document) == 14)
                                        cnpj
                                @endif" name="document" id="document" placeholder="CPF/CNPJ da empresa/profissional *" maxlength="14" value="{{ !empty($user->profiles->document) ? $user->profiles->document : '' }}">

                            </div>
                        </div>


                        <div class="form-group fotm-tab">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">E-mail do responsável *</label>
                            <div class="col-sm-6">

                                {{--{{ Form::password('password', '', array('class' => 'col-sm-12', 'id' => 'password')) }}--}}
                                <input type="text" class="form-control" name="responsible_email" id="responsible_email" placeholder="E-mail do responsável *"
                                       @if(!empty($user->email))
                                       value="{{ !empty($user->email) ? $user->email : $user->profiles->responsible_email }}"
                                        @endif
                                >
                            </div>
                        </div>


                    {{--</div>--}}
                    {{--<!-- / dados gerais -->--}}


                    {{--<!-- Dados pessoa física -->--}}
                    {{--<div id="dadospj" class="tab-pane">--}}

                        {{--<h3 class="header smaller lighter blue font-size-18 margin-bottom-25 margin-top-20" style="font-weight: 400;">--}}
                            {{--Dados pessoais--}}
                        {{--</h3>--}}


                        {{--<div class="form-group fotm-tab margin-top-40">--}}
                            {{--<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Arquivo de imagem</label>--}}
                            {{--<div class="col-sm-9">--}}

                                {{--<div>--}}
                                    {{--<button type="button" class="btn btn-sm abrir-boxfile" style="padding-top: 2px; padding-bottom: 2px; font-size: 12px; outline: none !important;">Selecionar arquivo</button>--}}
                                    {{--<input type="file" id="file" style="width:0px;height:0;">--}}
                                {{--</div>--}}

                                {{--<p class="dados-arquivo margin-top-20">Arquivo selecionado: <span style="font-weight: 700;color: #000;">nenhum arquivo selecionado</span></p>--}}

                                {{--<!-- crop -->--}}
                                {{--<div class="col-sm-6 no-padding-left">--}}
                                    {{--<div class="container-crop-usuarios">--}}
                                        {{--<div class="imageBox" style='background-image: url("/uploads/usuarios/{{ isset($user) ? $user->user_detail->avatar : '' }}")'>--}}
                                            {{--<div class="thumbBox"></div>--}}
                                            {{--<div class="spinner" style="display: none">Loading...</div>--}}
                                        {{--</div>--}}
                                        {{--<div class="action">--}}
                                            {{--<input type="button" id="btnZoomOut" value="-">--}}
                                            {{--<input type="button" id="btnZoomIn" value="+">--}}
                                        {{--</div>--}}
                                        {{--<!-- <div class="cropped"></div> -->--}}
                                    {{--</div>--}}
                                {{--</div>--}}

                                {{--<div class="col-sm-6 align-right">--}}
                                    {{--<input type="button" id="btnCrop" value="Incluir" class="btn btn-sm btn-success salvar pull-right" style="padding: 1px 10px; margin-top: -35px;">--}}
                                    {{--<input type="button" id="btnCropCancelar" value="Cancelar" class="btn btn-sm salvar pull-right" style="padding: 1px 10px; margin: -35px 75px 0 0px;">--}}
                                {{--</div>--}}
                                {{--<!-- / crop -->--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        <div class="form-group fotm-tab margin-top-35">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Celular do responsável *</label>
                            <div class="col-sm-3">

{{--                                {{ Form::text('name', (isset($user->name) ? $user->name : ''), array('class' => 'col-sm-12', 'id' => 'name')) }}--}}
                                <input type="text" class="form-control col-sm-8 telefone" name="responsible_cellphone" id="responsible_cellphone" placeholder="Celular do responsável *" value="{{ !empty($user->profiles->responsible_cellphone) ? $user->profiles->responsible_cellphone : '' }}">

                            </div>
                        </div>

                        <div class="form-group fotm-tab">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Sobre</label>
                            <div class="col-sm-9">

                                <textarea name="about" id="about" class="form-control descricao-grupo" placeholder="" requery="true">{{ (isset($user->user_detail->about) ? $user->user_detail->about : '') }}</textarea>

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Facebook</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="facebook" id="facebook" placeholder="Facebook ( opcional )"
                                       @if(!empty($user->profiles->facebook))
                                       value="{{ $user->profiles->facebook }}"
                                        @endif
                                >
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Twitter</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="twitter" id="twitter" placeholder="Twitter ( opcional )"
                                       @if(!empty($user->profiles->twitter))
                                       value="{{ $user->profiles->twitter }}"
                                        @endif
                                >
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Youtube</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="youtube" id="youtube" placeholder="Youtube ( opcional )"
                                       @if(!empty($user->profiles->youtube))
                                       value="{{ $user->profiles->youtube }}"
                                        @endif
                                >
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> WhatsApp</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control telefone" name="whatsapp" id="whatsapp" placeholder="WhatsApp ( opcional )"
                                       @if(!empty($user->profiles->whatsapp))
                                       value="{{ $user->profiles->whatsapp }}"
                                        @endif
                                >
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Instagram</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="instagram" id="instagram" placeholder="Instagram ( opcional )"
                                       @if(!empty($user->profiles->instagram))
                                       value="{{ $user->profiles->instagram }}"
                                        @endif
                                >
                            </div>
                        </div>



                        <!---------------------------------------------------- Contratações ------------------------------------------------>

                        <h3 class="header smaller lighter blue font-size-18 margin-bottom-25 margin-top-50" style="font-weight: 400;">
                            Dados da contratação
                        </h3>

                        <div class="form-group fotm-tab">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Dias restantes </label>
                            <div class="col-sm-3">

{{--                                {{ Form::text('document', (isset($user->user_detail->document) ? $user->user_detail->document : ''), array('class' => 'col-sm-12 cpf', 'id' => 'document')) }}--}}
                                {{-- @if(!empty($remaining_days)) --}}
                                @if(empty($remaining_days))
                                    <h4>0</h4>
                                @else
                                    <h4>{{ $remaining_days }}</h4>
                                @endif
                                {{-- @endif --}}
                            </div>
                        </div>

                        <div class="form-group fotm-tab" id="periodo">
                            <label for="periodo_contratacao" class="col-sm-3 form-control-static control-label small text-left">Período de contratação :</label>
                            <div class="col-sm-3">
                                <select class="form-control" name="product_id" id="product_id">
                                    <option value="0">Selecione o período desejado</option>

                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}#{{ $product->value }}"
                                        <?php if(!empty($purchase->product_id)){ ?>
                                                {{ ($product->id == $purchase->product_id) ? 'selected' : '' }}
                                        <?php } ?>
                                        >{{ $product->description }} - R$ {{ number_format($product->value,2,',','.')  }}
                                        </option>
                                    @endforeach

                                </select>
                            </div>
                        </div>

                        <div class="form-group" id="deseja_topo">
                            <label for="periodo_contratacao" class="col-sm-3 control-label small text-left">Deseja adquirir destaque ?</label>
                            <div class="col-sm-3">
                                <select class="form-control" name="detach" id="detach">
                                    <option value="">Selecione uma opção</option>

                                    @if(!empty($purchase->detach))
                                        <option value="S#{{ $detached_value }}" {{ $purchase->detach == '1' ? 'selected' : '' }}>Sim - R$ {{ $detached_value }}</option>
                                        <option value="N#0" {{ $purchase->detach != '1' ? 'selected' : '' }}>Não</option>
                                    @else
                                        <option value="S#{{ $detached_value }}">Sim - R$ {{ $detached_value }}</option>
                                        <option value="N#0">Não</option>
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="form-group" id="deseja_topo">
                            <!-- <div class="col-sm-6"> -->
                            <label for="valor" class="col-sm-3 control-label small">
                                {{-- @if(!empty($remaining_days))  --}}
                                @if($remaining_days < 0 || $remaining_days == '')
                                    Valor da compra :
                                @else
                                    Valor pago :
                                @endif
                                {{-- @endif --}}
                            </label>
                            <!-- </div> -->
                            <div class="col-sm-6">
                                <strong>R$ <span id="total">{{ !empty($purchase) ? number_format($purchase->value,2,',','.')  : '0,00' }}</span></strong>
                            </div>
                        </div>



                        <!----------------------------------- Endereço e Localização ------------------->

                        <h3 class="header smaller lighter blue font-size-18 margin-bottom-25 margin-top-50" style="font-weight: 400;">
                            Endereço e localização
                        </h3>

                        <div class="form-group fotm-tab">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> CEP * </label>
                            <div class="col-sm-3">

                                {{ Form::text('zip_code', (isset($user->profiles->zip_code) ? $user->profiles->zip_code : ''), array('class' => 'col-sm-12 cep', 'id' => 'zip_code')) }}

                            </div>
                        </div>


                        <div class="form-group fotm-tab">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Estado * </label>
                            <div class="col-sm-3">

                                {{--<input type="text" id="state" name="state" placeholder="" class="col-sm-12" value="{{ $state->name }}" disabled>--}}
                                <input type="text" class="form-control" name="state_name" id="state_name" placeholder="Estado" readonly
                                       @if(!empty($state))
                                       value="{{ $state->name }}"
                                        @endif
                                >
                            </div>
                        </div>


                        <div class="form-group fotm-tab">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Cidade * </label>
                            <div class="col-sm-6">

                                {{--<input type="text" id="city" name="city" placeholder="" class="col-sm-12" disabled value="{{ $city->name }}">--}}
                                <input type="text" class="form-control" name="city_name" id="city_name" placeholder="Cidade" readonly
                                       @if(!empty($city))
                                       value="{{ $city->name }}"
                                        @endif

                                >

                            </div>
                        </div>


                        <div class="form-group fotm-tab">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Bairro * </label>
                            <div class="col-sm-6">

                                {{ Form::text('neighborhood', (isset($user->profiles->neighborhood) ? $user->profiles->neighborhood : ''), array('class' => 'col-sm-12', 'id' => 'neighborhood')) }}

                            </div>
                        </div>

                        <div class="form-group fotm-tab">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Endereço *  </label>
                            <div class="col-sm-6">

                                {{ Form::text('address', (isset($user->profiles->address) ? $user->profiles->address : ''), array('class' => 'col-sm-12', 'id' => 'address')) }}

                            </div>
                        </div>

                        <div class="form-group fotm-tab">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Complemento </label>
                            <div class="col-sm-6">

                                {{ Form::text('complement', (isset($user->profiles->complement) ? $user->profiles->complement : ''), array('class' => 'col-sm-12', 'id' => 'complement')) }}

                            </div>
                        </div>

                        <div class="form-group fotm-tab">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1" requery="true"> Número * </label>
                            <div class="col-sm-2">

                                {{ Form::text('number', (isset($user->profiles->number) ? $user->profiles->number : ''), array('class' => 'col-sm-12', 'id' => 'number')) }}

                            </div>
                        </div>


                        <div class="form-group fotm-tab">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Latitude </label>
                            <div class="col-sm-6">

                                {{ Form::text('latitude', (isset($user->profiles->latitude) ? $user->profiles->latitude : ''), array('class' => 'col-sm-12', 'id' => 'latitude')) }}

                            </div>
                        </div>

                        <div class="form-group fotm-tab">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Longitude </label>
                            <div class="col-sm-6">

                                {{ Form::text('longitude', (isset($user->profiles->longitude) ? $user->profiles->longitude : ''), array('class' => 'col-sm-12', 'id' => 'longitude')) }}

                            </div>
                        </div>


                        <!-------------------------------------------  Serviços ------------------------------------>

                        <h3 class="header smaller lighter blue font-size-18 margin-bottom-25 margin-top-50" style="font-weight: 400;">
                            Serviços oferecidos
                        </h3>

                        <div class="form-group no-padding margin-left-10 margin-right-10" id="servicos_oferecidos">
                            <div class="form-group">
                                <div class="col-sm-7">
                                    <select class="form-control" name="services-select" id="services-select">
                                        <option value="">Selecione um serviço</option>

                                        @foreach($services as $service)
                                            <option value="{{ $service->id }}">{{ $service->description }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <div class="input-group">
                                        <div class="input-group-addon">R$</div>
                                        <input type="text" class="form-control money2" name="price" id="price" placeholder="Valor (opcional)">
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <a href="#" class="btn btn-success btn-sm insert-service">Incluir</a>
                                </div>
                            </div>
                            {{--<div class="form-group">--}}
                                {{--<div class="col-sm-12">--}}
                                    <span class="help-block small">Caso não informe um valor, será exibido <strong>"Sob consulta"</strong> no lugar.</span>
                                {{--</div>--}}
                            {{--</div>--}}
                        </div>

                        <div class="col-sm-12 no-padding margin-top-10 margin-bottom-40">
                            <div class="widget-body" style="border: 0;">
                                <div class="widget-main no-padding">
                                    <table class="table table-bordered table-striped" id="table-services">
                                        <thead class="thin-border-bottom">
                                        <tr>
                                            <th style="text-align: center">Serviço</th>
                                            <th style="text-align: center">Valor</th>
                                            <th style="text-align: center">Ações</th>
                                        </tr>
                                        </thead>

                                        <tbody id="objetos_anexados">
                                        @if(!empty($user->profiles->services))
                                            @foreach($user->profiles->services as $service)
                                                <tr>
                                                    <td class="col-sm-8">{{ $service->description }}</td>
                                                    <td class="col-sm-2 text-right">{{ $service->pivot->price != '0' ? number_format($service->pivot->price,2,',','.') : 'Sob consulta' }}</td>
                                                    <td class="col-sm-2" style="text-align: center">
                                                        <a href="#" class="btn btn-danger btn-xs remove-service">Remover</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div><!-- /widget-main -->
                            </div><!-- /widget-body -->
                        </div>


                        <!-------------------------------------------  Galeria de imagens ------------------------------------>

                        <h3 class="header smaller lighter blue font-size-18 margin-bottom-25 margin-top-50" style="font-weight: 400;">
                            Galeria de imagens
                        </h3>

                        <div class="form-group">
                            <div class="col-sm-9">
                                <input type="file" class="form-control"   name="file" id="file" placeholder="Selecione">
                            </div>
                            <div class="col-sm-3">
                                <div class="checkbox">
                                    <label>
                                        <input class="" type="checkbox" value="1" name="logo" id="logo"> Logomarca
                                    </label>
                                </div>
                            </div>
                            <!-- <div class="col-sm-2">
                                <a href="#" class="btn btn-success pull-right">Incluir</a>
                            </div> -->
                        </div>

                        <!-- </div> -->

                        {{--<div class="progress" id="progress" style="display: none">--}}
                        {{--<div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">--}}
                        {{--60%--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        <div class="form-group margin-10">
                            <span class="help-block small">
                                Dica: Formato PNG com fundo transparente ou JPG.<br>
                                Tamanho da foto : 350 x 200 px<br>
                                Tamanho da logomarca : 80 x 80 px
                            </span>
                        </div>

                        <div class="form-group legenda">
                            <div class="col-sm-9">
                                <input type="text" class="form-control " name="file_subtitle" id="file_subtitle" placeholder="Informe uma legenda para a foto (opcional)">
                            </div>
                            <div class="col-sm-3">
                                <a href="#" class="btn btn-success btn-sm insert-image">Incluir imagem</a>
                            </div>
                        </div>
                        <!-- <hr> -->
                        <div class="form-group">
                            <div class="col-sm-12">
                                <table class="table table-striped fotos-cadastro">
                                    <tbody>
                                    @if(!empty($user->profiles->galleries))
                                        @foreach($user->profiles->galleries as $gallery)
                                            <tr>
                                                <td  class="col-sm-2" style="vertical-align:middle">
                                                    <a class="myModal" data-toggle="modal" data-target="#myModal" data-file="{{ $gallery->filename }}">
                                                        <img src="/uploads/fotos/{{ $gallery->filename }}" alt="">
                                                    </a>
                                                    @if(!empty($gallery->logo))
                                                        Logo
                                                    @endif
                                                </td>
                                                <td class="col-sm-8">
                                                    <span class="small">{{ $gallery->subtitle }}</span>
                                                </td>
                                                <td class="col-sm-2" style="vertical-align:middle">
                                                    <a href="#" class="btn btn-danger btn-xs remove-item">Remover</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>

                </div>


                    <br clear="all"><br clear="all">
                </div>
            </div>
        {{--</form>--}}
        {{ Form::close() }}
    </div>
    <!-- / WRAP DOS DADOS -->



    <!-- #dialog-message -->
    <div id="dialog-message" class="hide"></div>
    <!-- / #dialog-message -->


    <!-- scripts exclusivos desta area -->
    {{--<script src="{{asset('admin/js/usuarios.js')}}"></script>--}}
    <script src="{{ asset('admin/js/cropbox.js') }}"></script>
    {{--<script src="{{ asset('admin/js/objetos-crop.js') }}"></script>--}}


@endsection('content')