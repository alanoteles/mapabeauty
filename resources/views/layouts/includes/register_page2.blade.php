<!-- MAIN CONTENT
	================================= -->


                <article id="page2" style="display: none;">
                    <!--- COLUNA DA ESQUERDA
                    ======================== -->
                    <div class="col-sm-6 col-esquerda">
                        <div class="form-group">
                            <input type="text" class="form-control" name="nome_fantasia" id="nome_fantasia" placeholder="Nome de fantasia da empresa/profissional">
                        </div>
                        <div class="form-group">
                            <textarea name="sobre" id="sobre" cols="30" rows="5"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="facebook" id="facebook" placeholder="Informe seu Facebook ( opcional )">
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" name="twitter" id="twitter" placeholder="Informe seu Twitter ( opcional )">
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" name="youtube" id="youtube" placeholder="Informe seu Youtube ( opcional )">
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" name="instagram" id="instagram" placeholder="Informe seu Instagram ( opcional )">
                        </div>

                        <div class="form-group text-center">
                            <h4>Informe os serviços que você oferece</h4>
                        </div>

                        <div class="form-group" id="servicos_oferecidos">
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <select class="form-control" name="servicos" id="servicos">
                                        <option value="">Serviços oferecidos</option>
                                        <option value="PF">Corte Masculino</option>
                                        <option value="129">Maquiagem</option>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <div class="input-group-addon">R$</div>
                                        <input type="text" class="form-control" name="bairro" id="bairro" placeholder="Valor (opcional)">
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <a href="#" class="btn btn-success pull-right">Incluir</a>
                                </div>
                            </div>
                            <div class="form-group">
                                <span class="help-block small">Caso não informe um valor, será exibido <strong>"Sob consulta"</strong> no lugar.</span>
                            </div>
                        </div>

                        <div class="form-group" id="deseja_topo">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <td class="col-sm-6"><strong>Serviços oferecidos</strong></td>
                                    <td class="col-sm-4 text-right"><strong>Valor R$</strong></td>
                                    <td class="col-sm-2"></td>
                                </tr>
                                <tr>
                                    <td>Serviço #1</td>
                                    <td class="text-right">50,00</td>
                                    <td><a href="#" class="btn btn-success pull-right">Remover</a></td>
                                </tr>
                                <tr>
                                    <td>Serviço #2</td>
                                    <td class="text-right">250,00</td>
                                    <td><a href="#" class="btn btn-success pull-right">Remover</a></td>
                                </tr>
                                <tr>
                                    <td>Serviço #3</td>
                                    <td class="text-right">Sob consulta</td>
                                    <td><a href="#" class="btn btn-success pull-right">Remover</a></td>
                                </tr>


                                </thead>

                            </table>
                        </div>
                    </div><!-- col esquerda -->


                    <!--- COLUNA DA DIREITA
                    ======================== -->

                    <div class="col-sm-6 col-direita">
                        <div class="form-group">
                            <h4>Galeria de imagens</h4>
                        </div>

                        <!-- <div class="form-group" id="envio_arquivos"> -->
                        <div class="form-group">
                            <div class="col-sm-9">
                                <input type="file" class="form-control"   name="arquivo" id="arquivo" placeholder="Selecione">
                            </div>
                            <div class="col-sm-3">
                                <div class="checkbox pull-right">
                                    <label>
                                        <input class="pull-right" type="checkbox" value="LOGO"> Logomarca
                                    </label>
                                </div>
                            </div>
                            <!-- <div class="col-sm-2">
                                <a href="#" class="btn btn-success pull-right">Incluir</a>
                            </div> -->
                        </div>

                        <!-- </div> -->
                        <div class="form-group">
                                <span class="help-block small">
                                    Dica: Formato PNG com fundo transparente ou JPG.<br>
                                    Tamanho da foto : 350 x 200 px<br>
                                    Tamanho da logomarca : 80 x 80 px
                                </span>
                        </div>

                        <div class="form-group legenda">
                            <div class="col-sm-9">
                                <input type="text" class="form-control " name="bairro" id="bairro" placeholder="Informe uma legenda para a foto (opcional)">
                            </div>
                            <div class="col-sm-3">
                                <a href="#" class="btn btn-success pull-right">Incluir imagem</a>
                            </div>
                        </div>
                        <!-- <hr> -->
                        <div class="form-group">

                            <table class="table table-striped fotos-cadastro">
                                <tbody>
                                <tr>
                                    <td  class="col-sm-2">
                                        <img src="{{ asset('assets/img/icon-rocket.png') }}" alt="">
                                    </td>
                                    <td class="col-sm-8">
                                        <span class="small">Lorem ipsum dolor sit amet</span>
                                    </td>
                                    <td class="col-sm-2">
                                        <a href="#" class="btn btn-danger btn-sm  pull-right">Remover</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td  class="col-sm-2">
                                        <img src="{{ asset('assets/img/icon-rocket.png') }}" alt="">
                                    </td>
                                    <td class="col-sm-8">
                                        <span class="small">Lorem ipsum dolor sit amet</span>
                                    </td>
                                    <td class="col-sm-2">
                                        <a href="#" class="btn btn-danger btn-sm  pull-right">Remover</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td  class="col-sm-2">
                                        <img src="{{ asset('assets/img/icon-rocket.png') }}" alt="">
                                    </td>
                                    <td class="col-sm-8">
                                        <span class="small">Lorem ipsum dolor sit amet</span>
                                    </td>
                                    <td class="col-sm-2">
                                        <a href="#" class="btn btn-danger btn-sm pull-right">Remover</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td  class="col-sm-2">
                                        <img src="{{ asset('assets/img/icon-rocket.png') }}" alt="">
                                    </td>
                                    <td class="col-sm-8">
                                        <span class="small">Lorem ipsum dolor sit amet</span>
                                    </td>
                                    <td class="col-sm-2">
                                        <a href="#" class="btn btn-danger btn-sm  pull-right">Remover</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td  class="col-sm-2">
                                        <img src="{{ asset('assets/img/icon-rocket.png') }}" alt="">
                                    </td>
                                    <td class="col-sm-8">
                                        <span class="small">Lorem ipsum dolor sit amet</span>
                                    </td>
                                    <td class="col-sm-2">
                                        <a href="#" class="btn btn-danger btn-sm  pull-right">Remover</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td  class="col-sm-2">
                                        <img src="{{ asset('assets/img/icon-rocket.png') }}" alt="">
                                    </td>
                                    <td class="col-sm-8">
                                        <span class="small">Lorem ipsum dolor sit amet</span>
                                    </td>
                                    <td class="col-sm-2">
                                        <a href="#" class="btn btn-danger btn-sm  pull-right">Remover</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td  class="col-sm-2">
                                        <img src="{{ asset('assets/img/icon-rocket.png') }}" alt="">
                                    </td>
                                    <td class="col-sm-8">
                                        <span class="small">Lorem ipsum dolor sit amet</span>
                                    </td>
                                    <td class="col-sm-2">
                                        <a href="#" class="btn btn-danger btn-sm  pull-right">Remover</a>
                                    </td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-2 col-sm-4">
                                <a href="" class="btn btn-info " id="voltapg">Voltar</a>
                            </div>
                            <div class="col-sm-6">
                                {{--<a href="cadastro2.html" class="btn btn-info btn-block pull-right">Salvar cadastro e efetuar pagamento</a>--}}
                                {{--<buttom onClick="this.submit" class="btn btn-info btn-block pull-right">Salvar</buttom>--}}
                                <input type="submit" value="Salvar">
                            </div>
                        </div>
                    </div><!-- col direita -->
                </article>
