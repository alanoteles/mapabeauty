<div class="container">
    <div class="row" id="primary">
        <div id="content" class="col-sm-12">
            <form class="form-horizontal">
                <div class="col-sm-6 col-esquerda">
                    <div class="form-group">
                        <h4>Informe seus dados empresariais/profissionais</h4>
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="" id="">
                            <option value="">Pessoa Física ou Jurídica ?</option>
                            <option value="PF">Pessoa Física</option>
                            <option value="PJ">Pessoa Jurídica</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="nome_empresa_profissional" id="nome_empresa_profissional" placeholder="Nome da empresa/profissional">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" name="cpf_cnpj" id="cpf_cnpj" placeholder="CPF/CNPJ da empresa/profissional">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" name="nome_responsavel" id="nome_responsavel" placeholder="Nome do responsável">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" name="email_responsavel" id="email_responsavel" placeholder="E-mail do responsável">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" name="celular_responsavel" id="celular_responsavel" placeholder="Celular do responsável">
                    </div>
                    <div class="form-group text-center">
                        <h4>Como deseja participar ?</h4>
                    </div>


                    <div class="form-group" id="periodo">
                        <label for="periodo_contratacao" class="col-sm-6 form-control-static control-label small text-left">Período de contratação :</label>
                        <div class="col-sm-6">
                            <select class="form-control" name="periodo_contratacao" id="periodo_contratacao">
                                <option value="">Selecione o período desejado</option>
                                <option value="PF">Grátis por 30 dias !</option>
                                <option value="129">180 dias - R$ 129,00</option>
                                <option value="89">120 dias - R$ 89,00</option>
                                <option value="69">90 dias - R$ 69,00</option>
                                <option value="45">60 dias - R$ 45,00</option>
                                <option value="25">30 dias - R$ 25,00</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group" id="deseja_topo">
                        <label for="periodo_contratacao" class="col-sm-6 control-label small text-left">Deseja aparecer no topo da listagem ?</label>
                        <div class="col-sm-6">
                            <select class="form-control" name="topo_listagem" id="topo_listagem">
                                <option value="">Selecione uma opção</option>
                                <option value="S">Sim</option>
                                <option value="N">Não</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group" id="deseja_topo">
                        <!-- <div class="col-sm-6"> -->
                        <label for="valor" class="col-sm-6 control-label small">Valor da sua compra :</label>
                        <!-- Valor da sua compra : <strong>R$ 90,00</strong> -->
                        <!-- </div> -->
                        <div class="col-sm-6">
                            <strong>R$ 90,00</strong>
                        </div>
                    </div>

                    <div class="form-group" id="forma_pagto">
                        <label for="forma_pagto" class="col-sm-6 control-label small">Escolha uma forma de pagamento :</label>
                        <div class="col-sm-6">
                            <div class="radio-inline">
                                <label>
                                    <input type="radio" name="forma_pagamento" id="pagseguro" value="pagseguro" checked>
                                    PagSeguro
                                </label>
                            </div>
                            <div class="radio-inline">
                                <label>
                                    <input type="radio" name="forma_pagamento" id="paypal" value="paypal" checked>
                                    PayPal
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group" id="dias_restantes">
                        <div class="col-sm-6 control-label small">
                            <h5>Quantidade de dias restantes :</h5>
                        </div>
                        <div class="col-sm-6">
                            <h3>38 dias</h3>
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
                            <input type="text" class="form-control" name="cep" id="cep" placeholder="C.E.P.">
                        </div>
                        <div class="col-sm-8">
                            <select class="form-control" name="periodo_contratacao" id="periodo_contratacao">
                                <option value="">Selecione o estado</option>
                                <option value="PF">Acre</option>
                                <option value="129">Aazonas</option>
                                <option value="89">Goiás</option>
                                <option value="69">Distrito Federal</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-6">
                            <select class="form-control" name="cidade" id="cidade">
                                <option value="">Selecione a cidade</option>
                                <option value="PF">Goiania</option>
                                <option value="129">Brasília</option>
                                <option value="89">São Paulo</option>
                                <option value="69">Rio de Janeiro</option>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="bairro" id="bairro" placeholder="Bairro">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="bairro" id="bairro" placeholder="Seu endereço">
                        </div>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="bairro" id="bairro" placeholder="Nr.">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-12">
                            <input type="text" class="form-control" name="bairro" id="bairro" placeholder="Complemento">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-12">
                            <button class="btn btn-success btn-block">
                                Clique para capturarmos a sua localização no mapa
                            </button>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-sm-12  small">* É importante que você esteja no local que deseja cadastrar.</label>
                    </div>

                    <div class="form-group ">
                        <div class="col-sm-12"  id="map-container" style="margin-left: 15px;">
                            <!-- <script src="http://maps.google.com/maps/api/js?key=AIzaSyBw0V-30gQX2eKvIEtRm5HjSPff6wXgzcA&sensor=false"></script> -->
                            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBw0V-30gQX2eKvIEtRm5HjSPff6wXgzcA" type="text/javascript"></script>
                            <script>

                                function init_map() {
                                    var var_location = new google.maps.LatLng(45.430817,12.331516);

                                    var var_mapoptions = {
                                        scrollwheel: false,
                                        center: var_location,
                                        zoom: 14
                                    };

                                    var var_marker = new google.maps.Marker({
                                        position: var_location,
                                        map: var_map,
                                        title:"Venice"});

                                    var var_map = new google.maps.Map(document.getElementById("map-container"),
                                            var_mapoptions);

                                    var_marker.setMap(var_map);

                                }

                                google.maps.event.addDomListener(window, 'load', init_map);

                            </script>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="bairro" id="bairro" placeholder="Latitude">
                        </div>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="bairro" id="bairro" placeholder="Longitude">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-6 col-sm-offset-6">
                            <a href="/profile/2" class="btn btn-info pull-right">Próxima página</a>
                        </div>
                    </div>
                </div><!-- col direita -->
            </form>

        </div><!-- content -->
    </div><!-- primary -->
</div><!-- container -->