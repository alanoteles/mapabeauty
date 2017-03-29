
    <article id="page1" style="display: block;">
        <div class="col-sm-6 col-esquerda">
            <div class="form-group">
                <h4>Informe seus dados empresariais/profissionais</h4>
            </div>
            <div class="form-group">

                <select class="form-control" name="professional_type" id="professional_type">
                    <option value="">Pessoa Física ou Jurídica ? *</option>
                    <option value="F" {{ ($user->professional_type == 'F' ? 'selected' : '') }}>Pessoa Física</option>
                    <option value="J" {{ ($user->professional_type == 'J' ? 'selected' : '') }}>Pessoa Jurídica</option>
                </select>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="professional_name" id="professional_name" placeholder="Nome da empresa/profissional *" value="{{ !empty($user->professional_name) ? $user->professional_name : '' }}">
            </div>

            <div class="form-group">
                <input type="text" class="form-control" name="document" id="document" placeholder="CPF/CNPJ da empresa/profissional *" maxlength="14" value="{{ !empty($user->document) ? $user->document : '' }}">
            </div>

            <div class="form-group">
                <input type="text" class="form-control" name="responsible_name" id="responsible_name" placeholder="Nome do responsável *" value="{{ !empty($user->name) ? $user->name : $user->responsible_name }}">
            </div>

            <div class="form-group">
                <input type="text" class="form-control" name="responsible_email" id="responsible_email" placeholder="E-mail do responsável *" value="{{ !empty($user->email) ? $user->email : $user->responsible_email }}">
            </div>

            <div class="form-group">
                <input type="text" class="form-control telefone" name="responsible_cellphone" id="responsible_cellphone" placeholder="Celular do responsável *" value="{{ !empty($user->responsible_cellphone) ? $user->responsible_cellphone : '' }}">
            </div>
            <div class="form-group text-center">
                @if($remaining_days < 0)
                    <h4>Como deseja participar ?</h4>
                @else
                    <h4>Plano atual</h4>
                @endif
            </div>


            <div class="form-group" id="periodo">
                <label for="periodo_contratacao" class="col-sm-6 form-control-static control-label small text-left">Período de contratação :</label>
                <div class="col-sm-6">
                    <select class="form-control" name="product_id" id="product_id">
                        <option value="">Selecione o período desejado</option>

                        @foreach($products as $product)
                            <option value="{{ $product->id }}"
                                <?php if(!empty($purchase->product_id)){ ?>
                                    {{ ($product->id == $purchase->product_id) ? 'selected' : '' }}
                                <?php } ?>
                                >{{ $product->description }} - R$ {{ number_format($product->value,2,',','.')  }}</option>
                        @endforeach

                    </select>
                </div>
            </div>

            <div class="form-group" id="deseja_topo">
                <label for="periodo_contratacao" class="col-sm-6 control-label small text-left">Deseja aparecer no topo da listagem ?</label>
                <div class="col-sm-6">
                    <select class="form-control" name="topo_listagem" id="topo_listagem">
                        <option value="">Selecione uma opção</option>

                        <?php if(!empty($purchase->detach)){ ?>
                            <option value="S" {{ $purchase->detach == '1' ? 'selected' : '' }}>Sim - {{ $detached_value }}</option>
                            <option value="N" {{ $purchase->detach != '1' ? 'selected' : '' }}>Não</option>
                        <?php } else { ?>
                            <option value="S">Sim - {{ $detached_value }}</option>
                            <option value="N">Não</option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="form-group" id="deseja_topo">
                <!-- <div class="col-sm-6"> -->
                <label for="valor" class="col-sm-6 control-label small">
                    @if($remaining_days < 0)
                        Valor da sua compra :
                    @else
                        Valor pago :
                    @endif
                </label>
                <!-- </div> -->
                <div class="col-sm-6">
                    <strong>R$ {{ !empty($purchase) ? number_format($purchase->value,2,',','.')  : '' }}</strong>
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
                <div class="col-sm-6">{{ $payers }}
                    @foreach($payers as $payer)
                    <div class="radio-inline">
                        <label>
                            <input type="radio" name="forma_pagamento" id="{{ strtolower($payer->name) }}" value="{{ $payer->id }}"
                                <?php if(!empty($purchase)){ ?>
                                    {{ ($payer->id == $purchase->payer_id) ? 'checked' : '' }}>
                                <?php } ?>
                            {{ $payer->name }}
                        </label>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="form-group" id="dias_restantes">
                <div class="col-sm-6 control-label small">
                    <h5>Quantidade de dias restantes :</h5>
                </div>
                <div class="col-sm-6">
                    <h3 {{ $remaining_days < 5 ? 'style=color:red;' : '' }}>{{ $remaining_days }} dias</h3>
                </div>
            </div>
        </div><!-- col esquerda -->

        <div class="col-sm-6 col-direita">
            <div class="form-group">
                <div class="col-sm-12">
                    <h4>Informe seu endereço e localização</h4>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-4">
                    <input type="text" class="form-control cep" name="cep" id="cep" placeholder="C.E.P." value="{{ $user->zip_code }}">
                </div>
                <div class="col-sm-8">
                    {{--<select class="form-control" name="state" id="state">--}}
                        {{--<option value="">Selecione o estado</option>--}}
                        {{--<option value="PF">Acre</option>--}}
                        {{--<option value="129">Aazonas</option>--}}
                        {{--<option value="89">Goiás</option>--}}
                        {{--<option value="69">Distrito Federal</option>--}}
                    {{--</select>--}}
                    <input type="text" class="form-control" name="state" id="state" placeholder="Estado" value="" readonly>
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
                    <input type="text" class="form-control" name="city" id="city" placeholder="Cidade" value="{{ $user->city_name }}" readonly>
                </div>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="neighborhood" id="neighborhood" placeholder="Bairro" value="{{ $user->neighborhood }}" readonly>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="address" id="address" placeholder="Seu endereço" value="{{ $user->address }}" readonly>
                </div>
                <div class="col-sm-2">
                    <input type="text" class="form-control" name="number" id="number" placeholder="Nr." value="{{ $user->number }}">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-12">
                    <input type="text" class="form-control" name="complement" id="complement" placeholder="Complemento" value="{{ $user->complement }}">
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
                    <!-- <script src="http://maps.google.com/maps/api/js?key=AIzaSyBw0V-30gQX2eKvIEtRm5HjSPff6wXgzcA&sensor=false"></script> -->
                    {{--<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>--}}
                    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBw0V-30gQX2eKvIEtRm5HjSPff6wXgzcA" type="text/javascript"></script>

                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="latitude" id="latitude" placeholder="Latitude" value="{{ $user->latitude }}">
                </div>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="longitude" id="longitude" placeholder="Longitude" value="{{ $user->longitude }}">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-6 col-sm-offset-6">
                    <a href="" class="btn btn-info pull-right" id="proximapg">Próxima página</a>
                </div>
            </div>
        </div><!-- col direita -->
    </article>

