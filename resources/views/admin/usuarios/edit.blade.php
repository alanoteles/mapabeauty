
@extends('admin.layouts.master')



@section('title','Usuários')

@section('content')

    <!-- WRAP DOS DADOS -->
    <div class="wrap-content">

        {{ Form::open(
        array(
            'url'   => App::getLocale() . '/admin/usuarios/' .  (isset($user->id) ? $user->id : '' ),
            'name'  => 'frm',
            'id'    => 'frm',
            'class' => 'form-horizontal',
            'role'  => 'form',
            'method'    => (isset($user->id) ? 'PUT' : 'POST' ))
            )
        }}


        {{--{{ Form::hidden('locale', App::getLocale()) }}--}}
        {{ Form::hidden('status', (isset($user->status) ? $user->status : '1'), array('id' => 'status')) }}
        {{--{{ Form::hidden('array_proponentes',(isset($array_proponentes) ? $array_proponentes : ''),  array('id' => 'array_proponentes')) }}--}}
        {{--{{ Form::hidden('array_executores', (isset($array_executores) ? $array_executores : ''),    array('id' => 'array_executores')) }}--}}
        {{--{{ Form::hidden('array_anexos',     (isset($array_anexos) ? $array_anexos : ''),            array('id' => 'array_anexos')) }}--}}
        {{ Form::hidden('city_id', (isset($user->user_detail->city_id) ? $user->user_detail->city_id : '1724'), array('id' => 'city_id')) }}
        {{ Form::hidden('user_id', (isset($user->id) ? $user->id : ''), array('id' => 'user_id')) }}
        {{ Form::hidden('base64_image', '',array('id' => 'base64_image')) }}
        {{ Form::hidden('model', (isset($model) ? $model : ''), array('id' => 'model')) }}


        <form name="frm" id="frm" class="form-horizontal" role="form">

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
                    <li class="active"><a data-toggle="tab" href="#acesso">Dados de acesso</a></li>
                    <li class=""><a data-toggle="tab" href="#dadospj">Dados pessoa física</a></li>
                    <li class=""><a data-toggle="tab" href="#rodape">Privacidade e conteúdo</a></li>
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

                        <div class="form-group fotm-tab">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Grupo *</label>
                            <div class="col-sm-3">

                                {{ Form::select(
                                                'user_group_id',
                                                array_pluck($grupos, 'name', 'id'),
                                                (isset($user->user_group_id) ? $user->user_group_id : ''),
                                                [
                                                    'class'         =>'form-control col-sm-12',
                                                    'placeholder'   =>'Selecione',
                                                    'id'            => 'user_group_id'
                                                ]
                                ) }}

                            </div>
                        </div>

                        <div class="form-group fotm-tab">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> E-mail *</label>
                            <div class="col-sm-6">

                                {{ Form::text('email', (isset($user->email) ? $user->email : ''), array('class' => 'col-sm-12', 'id' => 'email')) }}

                            </div>
                        </div>

                        <div class="form-group fotm-tab">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Confirmação do e-mail *</label>
                            <div class="col-sm-6">

                                {{ Form::text('email_confirm', '', array('class' => 'col-sm-12', 'id' => 'email_confirm')) }}

                            </div>
                        </div>


                        <div class="form-group fotm-tab">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Senha *</label>
                            <div class="col-sm-6">

                                {{ Form::password('password', '', array('class' => 'col-sm-12', 'id' => 'password')) }}

                            </div>
                        </div>


                    </div>
                    <!-- / dados gerais -->


                    <!-- Dados pessoa física -->
                    <div id="dadospj" class="tab-pane">

                        <h3 class="header smaller lighter blue font-size-18 margin-bottom-25 margin-top-20" style="font-weight: 400;">
                            Dados pessoais
                        </h3>


                        <div class="form-group fotm-tab margin-top-40">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Arquivo de imagem</label>
                            <div class="col-sm-9">

                                <div>
                                    <button type="button" class="btn btn-sm abrir-boxfile" style="padding-top: 2px; padding-bottom: 2px; font-size: 12px; outline: none !important;">Selecionar arquivo</button>
                                    <input type="file" id="file" style="width:0px;height:0;">
                                </div>

                                <p class="dados-arquivo margin-top-20">Arquivo selecionado: <span style="font-weight: 700;color: #000;">nenhum arquivo selecionado</span></p>

                                <!-- crop -->
                                <div class="col-sm-6 no-padding-left">
                                    <div class="container-crop-usuarios">
                                        <div class="imageBox" style='background-image: url("/uploads/usuarios/{{ isset($user) ? $user->user_detail->avatar : '' }}")'>
                                            <div class="thumbBox"></div>
                                            <div class="spinner" style="display: none">Loading...</div>
                                        </div>
                                        <div class="action">
                                            <input type="button" id="btnZoomOut" value="-">
                                            <input type="button" id="btnZoomIn" value="+">
                                        </div>
                                        <!-- <div class="cropped"></div> -->
                                    </div>
                                </div>

                                <div class="col-sm-6 align-right">
                                    <input type="button" id="btnCrop" value="Incluir" class="btn btn-sm btn-success salvar pull-right" style="padding: 1px 10px; margin-top: -35px;">
                                    <input type="button" id="btnCropCancelar" value="Cancelar" class="btn btn-sm salvar pull-right" style="padding: 1px 10px; margin: -35px 75px 0 0px;">
                                </div>
                                <!-- / crop -->
                            </div>
                        </div>

                        <div class="form-group fotm-tab margin-top-35">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Nome completo *</label>
                            <div class="col-sm-6">

                                {{ Form::text('name', (isset($user->name) ? $user->name : ''), array('class' => 'col-sm-12', 'id' => 'name')) }}

                            </div>
                        </div>

                        <div class="form-group fotm-tab">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> CPF *</label>
                            <div class="col-sm-3">

                                {{ Form::text('document', (isset($user->user_detail->document) ? $user->user_detail->document : ''), array('class' => 'col-sm-12 cpf', 'id' => 'document')) }}

                            </div>
                        </div>

                        <div class="form-group fotm-tab">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Data de nascimento </label>
                            <div class="col-sm-3">
                                <div class="input-group">

                                    {{ Form::text('birthday', (isset($user->user_detail->birthday) ? date("d/m/Y",strtotime($user->user_detail->birthday)) : ''), array('class' => 'form-control data', 'id' => 'birthday', 'placeholder' => '[dd / mm / aaaa]')) }}

                                    <span class="input-group-addon">
                                        <i class="icon-calendar bigger-110"></i>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group fotm-tab">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Idioma *</label>
                            <div class="col-sm-3">

                                {{ Form::select(
                                                'locale',
                                                array_pluck($idiomas, 'title', 'name'),
                                                (isset($user->user_detail->locale) ? $user->user_detail->locale : ''),
                                                [
                                                    'class'         =>'form-control col-sm-12',
                                                    'placeholder'   =>'Selecione',
                                                    'id'            => 'locale'
                                                ]
                                ) }}

                            </div>
                        </div>

                        <div class="form-group fotm-tab">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Sobre</label>
                            <div class="col-sm-9">

                                <textarea name="about" id="about" class="form-control descricao-grupo" placeholder="" requery="true">{{ (isset($user->user_detail->about) ? $user->user_detail->about : '') }}</textarea>

                            </div>
                        </div>




                        <h3 class="header smaller lighter blue font-size-18 margin-bottom-25 margin-top-50" style="font-weight: 400;">
                            Dados de contato
                        </h3>

                        <div class="form-group fotm-tab">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Telefone * </label>
                            <div class="col-sm-1">

                                {{ Form::text('ddd', (isset($user->user_detail->mobile_phone) ? substr($user->user_detail->mobile_phone,0,2) : ''), array('class' => 'col-sm-12 numero', 'id' => 'ddd', 'maxlength' => '2')) }}

                            </div>
                            <div class="col-sm-2">

                                {{ Form::text('mobile_phone', (isset($user->user_detail->mobile_phone) ? substr($user->user_detail->mobile_phone,2) : ''), array('class' => 'col-sm-12 telefone', 'id' => 'mobile_phone')) }}

                            </div>
                        </div>

                        <div class="form-group fotm-tab">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> CEP * </label>
                            <div class="col-sm-3">

                                {{ Form::text('zip', (isset($user->user_detail->zip) ? $user->user_detail->zip : ''), array('class' => 'col-sm-12 cep', 'id' => 'zip')) }}

                            </div>
                        </div>

                        <div class="form-group fotm-tab">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> País * </label>
                            <div class="col-sm-3">

                                <input type="text" id="country_id" name="country_id" placeholder="" class="col-sm-12" value="Brasil" disabled>

                            </div>
                        </div>

                        <div class="form-group fotm-tab">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Estado * </label>
                            <div class="col-sm-3">

                                <input type="text" id="state" name="state" placeholder="" class="col-sm-12" value="{{ $state }}" disabled>

                            </div>
                        </div>


                        <div class="form-group fotm-tab">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Cidade * </label>
                            <div class="col-sm-6">

                                <input type="text" id="city" name="city" placeholder="" class="col-sm-12" disabled value="{{ $city }}">

                            </div>
                        </div>


                        <div class="form-group fotm-tab">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Bairro * </label>
                            <div class="col-sm-6">

                                {{ Form::text('neighborhood', (isset($user->user_detail->neighborhood) ? $user->user_detail->neighborhood : ''), array('class' => 'col-sm-12', 'id' => 'neighborhood')) }}

                            </div>
                        </div>

                        <div class="form-group fotm-tab">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Endereço *  </label>
                            <div class="col-sm-6">

                                {{ Form::text('address', (isset($user->user_detail->address) ? $user->user_detail->address : ''), array('class' => 'col-sm-12', 'id' => 'address')) }}

                            </div>
                        </div>

                        <div class="form-group fotm-tab">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Complemento </label>
                            <div class="col-sm-6">

                                {{ Form::text('complement', (isset($user->user_detail->complement) ? $user->user_detail->complement : ''), array('class' => 'col-sm-12', 'id' => 'complement')) }}

                            </div>
                        </div>

                        <div class="form-group fotm-tab">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1" requery="true"> Número * </label>
                            <div class="col-sm-2">

                                {{ Form::text('number', (isset($user->user_detail->number) ? $user->user_detail->number : ''), array('class' => 'col-sm-12', 'id' => 'number')) }}

                            </div>
                        </div>



                        <h3 class="header smaller lighter blue font-size-18 margin-bottom-25 margin-top-50" style="font-weight: 400;">
                            Contatos na web
                        </h3>


                        <div class="form-group fotm-tab">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Facebook </label>
                            <div class="col-sm-6">

                                {{ Form::text('facebook', (isset($user->user_detail->facebook) ? $user->user_detail->facebook : ''), array('class' => 'col-sm-12', 'id' => 'facebook')) }}

                            </div>
                        </div>

                        <div class="form-group fotm-tab">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Twitter </label>
                            <div class="col-sm-6">

                                {{ Form::text('twitter', (isset($user->user_detail->twitter) ? $user->user_detail->twitter : ''), array('class' => 'col-sm-12', 'id' => 'twitter')) }}

                            </div>
                        </div>

                        <div class="form-group fotm-tab">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Youtube </label>
                            <div class="col-sm-6">

                                {{ Form::text('youtube', (isset($user->user_detail->youtube) ? $user->user_detail->youtube : ''), array('class' => 'col-sm-12', 'id' => 'youtube')) }}

                            </div>
                        </div>

                        <div class="form-group fotm-tab">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Site / Blog </label>
                            <div class="col-sm-6">

                                {{ Form::text('blog', (isset($user->user_detail->blog) ? $user->user_detail->blog : ''), array('class' => 'col-sm-12', 'id' => 'blog')) }}

                            </div>
                        </div>




                        <h3 class="header smaller lighter blue font-size-18 margin-bottom-25 margin-top-50" style="font-weight: 400;">
                            Formação
                        </h3>


                        <div class="form-group fotm-tab">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Nível de escolaridade * </label>
                            <div class="col-sm-3">

                                {{ Form::select(
                                                'schooling_id',
                                                array_pluck($escolaridade, 'name', 'id'),
                                                (isset($user->user_detail->schooling_id) ? $user->user_detail->schooling_id : ''),
                                                [
                                                    'class'         =>'form-control col-sm-12',
                                                    'placeholder'   =>'Selecione',
                                                    'id'            => 'schooling_id'
                                                ]
                                ) }}

                            </div>
                        </div>

                        <div class="form-group fotm-tab">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Profissão * </label>
                            <div class="col-sm-6">

                                {{ Form::text('occupation', (isset($user->user_detail->occupation) ? $user->user_detail->occupation : ''), array('class' => 'col-sm-12', 'id' => 'occupation')) }}

                            </div>
                        </div>

                        <div class="form-group fotm-tab">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Currículo Lattes </label>
                            <div class="col-sm-6">

                                {{ Form::text('lattes', (isset($user->user_detail->lattes) ? $user->user_detail->lattes : ''), array('class' => 'col-sm-12', 'id' => 'lattes')) }}

                            </div>
                        </div>

                        <div class="form-group fotm-tab">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Instituição empregadora * </label>
                            <div class="col-sm-6">

                                {{ Form::text('employer', (isset($user->user_detail->employer) ? $user->user_detail->employer : ''), array('class' => 'col-sm-12', 'id' => 'employer')) }}

                            </div>
                        </div>

                    </div>
                    <!-- / Dados pessoa física -->


                    <!-- Privacidade -->
                    <div id="rodape" class="tab-pane">

                        <h3 class="header smaller lighter blue font-size-18 margin-bottom-25 margin-top-50" style="font-weight: 400;">
                            Configurações do usuário
                        </h3>


                        <div class="form-group fotm-tab">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Privacidade </label>
                            <div class="col-sm-6">

                                {{ Form::select(
                                                'privacy',
                                                [
                                                    '1' => 'Exibir minhas informações pessoais',
                                                    '0' => 'Não exibir minhas informações pessoais'
                                                ],
                                                (isset($user->user_detail->privacy) ? $user->user_detail->privacy : ''),
                                                [
                                                    'class'         =>'form-control col-sm-12',
                                                    'placeholder'   =>'Selecione',
                                                    'id'            => 'privacy'
                                                ]
                                ) }}

                            </div>
                        </div>

                        <div class="form-group fotm-tab">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Notificações sobre seus objs. </label>
                            <div class="col-sm-6">

                                {{ Form::select(
                                                'notifications_my_objects',
                                                [
                                                    '1' => 'Receber notificações',
                                                    '0' => 'Não receber notificações'
                                                ],
                                                (isset($user->user_detail->notifications_my_objects) ? $user->user_detail->notifications_my_objects : ''),
                                                [
                                                    'class'         =>'form-control col-sm-12',
                                                    'placeholder'   =>'Selecione',
                                                    'id'            => 'notifications_my_objects'
                                                ]
                                ) }}

                            </div>
                        </div>

                        <div class="form-group fotm-tab">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Notificações sobre outros objs. </label>
                            <div class="col-sm-6">

                                {{ Form::select(
                                                'notifications_other_objects',
                                                [
                                                    '1' => 'Receber notificações',
                                                    '0' => 'Não receber notificações'
                                                ],
                                                (isset($user->user_detail->notifications_other_objects) ? $user->user_detail->notifications_other_objects : ''),
                                                [
                                                    'class'         =>'form-control col-sm-12',
                                                    'placeholder'   =>'Selecione',
                                                    'id'            => 'notifications_other_objects'
                                                ]
                                ) }}

                            </div>
                        </div>

                </div>


                <br clear="all"><br clear="all">
            </div>

        </form>
    </div>
    <!-- / WRAP DOS DADOS -->



    <!-- #dialog-message -->
    <div id="dialog-message" class="hide"></div>
    <!-- / #dialog-message -->


    <!-- scripts exclusivos desta area -->
    <script src="{{asset('admin/js/usuarios.js')}}"></script>
    <script src="{{ asset('admin/js/cropbox.js') }}"></script>
    <script src="{{ asset('admin/js/objetos-crop.js') }}"></script>


@endsection('content')