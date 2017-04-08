
    <article id="page1" style="display: block;">
        <div class="col-sm-6 col-esquerda">
            <div class="form-group">
                <h4>Informe seus dados empresariais/profissionais</h4>
            </div>
            <div class="form-group">

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
            <div class="form-group">
                <input type="text" class="form-control" name="professional_name" id="professional_name" placeholder="Nome da empresa/profissional *" value="{{ !empty($user->profiles->professional_name) ? $user->profiles->professional_name : '' }}">
            </div>

            <div class="form-group">
                <input type="text" class="form-control 
                    @if(!empty($user->profiles->document)) 
                        cpf 
                    @else 
                        cnpj 
                    @endif" name="document" id="document" placeholder="CPF/CNPJ da empresa/profissional *" maxlength="14" value="{{ !empty($user->profiles->document) ? $user->profiles->document : '' }}">
            </div>

            <div class="form-group">
                <input type="text" class="form-control" name="responsible_name" id="responsible_name" placeholder="Nome do responsável *" 
                    @if(!empty($user->name))
                        value="{{ !empty($user->name) ? $user->name : $user->profiles->responsible_name }}"
                    @endif
                >
            </div>

            <div class="form-group">
                <input type="text" class="form-control" name="responsible_email" id="responsible_email" placeholder="E-mail do responsável *" 
                    @if(!empty($user->email))
                        value="{{ !empty($user->email) ? $user->email : $user->profiles->responsible_email }}"
                    @endif
                >
            </div>

            <div class="form-group">
                <input type="text" class="form-control telefone" name="responsible_cellphone" id="responsible_cellphone" placeholder="Celular do responsável *" value="{{ !empty($user->profiles->responsible_cellphone) ? $user->profiles->responsible_cellphone : '' }}">
            </div>
            <div class="form-group text-center">
                {{-- @if(!empty($remaining_days)) --}}
                    @if(empty($remaining_days))
                        <h4>Como deseja participar ?</h4>
                    @else
                        <h4>Plano atual</h4>
                    @endif
                {{-- @endif --}}
            </div>


            <div class="form-group" id="periodo">
                <label for="periodo_contratacao" class="col-sm-6 form-control-static control-label small text-left">Período de contratação :</label>
                <div class="col-sm-6">
                    <select class="form-control" name="product_id" id="product_id">
                        <option value="">Selecione o período desejado</option>

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
                <label for="periodo_contratacao" class="col-sm-6 control-label small text-left">Deseja aparecer no topo da listagem ?</label>
                <div class="col-sm-6">
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
                <label for="valor" class="col-sm-6 control-label small">
                    {{-- @if(!empty($remaining_days))  --}}
                        @if($remaining_days < 0 || $remaining_days == '')
                            Valor da sua compra :
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

            <div class="form-group" id="forma_pagto">
                <label for="forma_pagto" class="col-sm-6 control-label small">
                    @if($remaining_days < 0)
                        Escolha uma forma de pagamento :
                    @else
                        Forma de pagamento :
                    @endif

                </label>
                <div class="col-sm-6">
                    @foreach($payers as $payer)
                        <div class="radio-inline">
                            <label>
                                <input type="radio" name="payer" id="{{ strtolower($payer->name) }}" value="{{ $payer->id }}"
                                    <?php if(!empty($purchase)){ ?>
                                        {{ ($payer->id == $purchase->payer_id) ? 'checked' : '' }}
                                    <?php } ?>
                                >
                                {{ $payer->name }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>

            @if($remaining_days != '')
                <div class="form-group" id="dias_restantes">
                    <div class="col-sm-6 control-label small">
                        <h5>Quantidade de dias restantes :</h5>
                    </div>
                    <div class="col-sm-6">
                        <h3 {{ $remaining_days < 5 ? 'style=color:red;' : '' }}>{{ $remaining_days }} dias</h3>
                    </div>
                </div>
            @endif
        </div><!-- col esquerda -->


        <!-----------------------------------    SEPARADOR DE COLUNAS -------------------------->

        <div class="col-sm-6 col-direita">
            <div class="form-group">
                <div class="col-sm-12">
                    <h4>Informe seu endereço e localização</h4>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-4">
                    <input type="text" class="form-control cep" name="zip_code" id="zip_code" placeholder="C.E.P." 
                        @if(!empty($user->profiles->zip_code)) 
                            value="{{ $user->profiles->zip_code }}"
                        @endif
                    >
                </div>
                <div class="col-sm-8">
                    {{--<select class="form-control" name="state" id="state">--}}
                        {{--<option value="">Selecione o estado</option>--}}
                        {{--<option value="PF">Acre</option>--}}
                        {{--<option value="129">Aazonas</option>--}}
                        {{--<option value="89">Goiás</option>--}}
                        {{--<option value="69">Distrito Federal</option>--}}
                    {{--</select>--}}
                    <input type="text" class="form-control" name="state_name" id="state_name" placeholder="Estado" readonly
                        @if(!empty($state)) 
                            value="{{ $state->name }}" 
                        @endif
                    >
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-6">
                    {{--<select class="form-control" name="cidade" id="cidade">--}}
                        {{--<option value="">Selecione a cidade</option>--}}
                        {{--<option value="PF">Goiania</option>--}}
                        {{--<option value="129">Brasília</option>--}}
                        {{--<option value="89">São Paulo</option>--}}
                        {{--<option value="69">Rio de Janeiro</option>--}}
                    {{--</select>--}}
                    <input type="text" class="form-control" name="city_name" id="city_name" placeholder="Cidade" readonly 
                        @if(!empty($city)) 
                            value="{{ $city->name }}" 
                        @endif

                    >
                </div>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="neighborhood" id="neighborhood" placeholder="Bairro" readonly 
                        @if(!empty($user->profiles->neighborhood)) 
                            value="{{ $user->profiles->neighborhood }}" 
                        @endif
                    >
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="address" id="address" placeholder="Seu endereço" readonly 
                        @if(!empty($user->profiles->address))
                            value="{{ $user->profiles->address }}" 
                        @endif
                    >
                </div>
                <div class="col-sm-2">
                    <input type="text" class="form-control" name="number" id="number" placeholder="Nr." 
                        @if(!empty($user->profiles->number))
                            value="{{ $user->profiles->number }}"
                        @endif
                    >
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-12">
                    <input type="text" class="form-control" name="complement" id="complement" placeholder="Complemento" 
                        @if(!empty($user->profiles->complement))
                            value="{{ $user->profiles->complement }}"
                        @endif
                    >
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-12">
                    {{--<button class="btn btn-success btn-block" onclick="javascript:showlocation()">--}}
                        {{--Clique para capturarmos a sua localização no mapa--}}
                    {{--</button>--}}
                    <input type="button" class="btn btn-success btn-block" value="Clique para capturarmos a sua localização no mapa" id="load_map_buttom"
                           onclick="javascript:showlocation()" /> 	<br/>
                </div>
            </div>

            <div class="form-group">
                <label for="" class="col-sm-12  small">* É importante que você esteja no local que deseja cadastrar.</label>
            </div>

            <div class="form-group ">
                <div class="col-sm-12"  id="map-container" style="margin-left: 15px;">
                    {{-- <img src="{{ asset('assets/img/loader.gif') }}"> --}}
                    <!-- <script src="http://maps.google.com/maps/api/js?key=AIzaSyBw0V-30gQX2eKvIEtRm5HjSPff6wXgzcA&sensor=false"></script> -->
                    {{--<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>--}}
                    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBw0V-30gQX2eKvIEtRm5HjSPff6wXgzcA" type="text/javascript"></script>

                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="latitude" id="latitude" placeholder="Latitude" 
                        @if(!empty($user->profiles->latitude))
                            value="{{ $user->profiles->latitude }}"
                        @endif
                    >
                </div>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="longitude" id="longitude" placeholder="Longitude" 
                        @if(!empty($user->profiles->longitude))
                            value="{{ $user->profiles->longitude }}"
                        @endif
                    >
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-6 col-sm-offset-6">
                    <a href="" class="btn btn-info pull-right" id="proximapg">Próxima página</a>
                </div>
            </div>
        </div><!-- col direita -->
    </article>

