    <!-- MAIN CONTENT
	================================= -->


    <article id="page2" style="display: none;">
        <!--- COLUNA DA ESQUERDA
        ======================== -->
        <div class="col-sm-6 col-esquerda">
            <div class="form-group">
                <input type="text" class="form-control" name="fantasy_name" id="fantasy_name" placeholder="Nome de fantasia da empresa/profissional"
                    @if(!empty($user->profiles->fantasy_name))
                            value="{{ $user->profiles->fantasy_name }}"
                    @endif
                >

            </div>
            <div class="form-group">
                <textarea name="about" id="about" cols="30" rows="5">
                    @if(!empty($user->profiles->about))
                        {{ $user->profiles->about }}
                    @endif
                </textarea>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="facebook" id="facebook" placeholder="Informe seu Facebook ( opcional )"
                    @if(!empty($user->profiles->facebook))
                            value="{{ $user->profiles->facebook }}"
                    @endif
                >
            </div>

            <div class="form-group">
                <input type="text" class="form-control" name="twitter" id="twitter" placeholder="Informe seu Twitter ( opcional )"
                    @if(!empty($user->profiles->twitter))
                            value="{{ $user->profiles->twitter }}"
                    @endif
                >
            </div>

            <div class="form-group">
                <input type="text" class="form-control" name="youtube" id="youtube" placeholder="Informe seu Youtube ( opcional )"
                    @if(!empty($user->profiles->youtube))
                            value="{{ $user->profiles->youtube }}"
                    @endif
                >
            </div>

            <div class="form-group">
                <input type="text" class="form-control telefone" name="whatsapp" id="whatsapp" placeholder="Informe seu WhatsApp ( opcional )"
                    @if(!empty($user->profiles->whatsapp))
                            value="{{ $user->profiles->whatsapp }}"
                    @endif
                >
            </div>

            <div class="form-group">
                <input type="text" class="form-control" name="instagram" id="instagram" placeholder="Informe seu Instagram ( opcional )"
                    @if(!empty($user->profiles->instagram))
                            value="{{ $user->profiles->instagram }}"
                    @endif
                >
            </div>

            <div class="form-group text-center">
                <h4>Informe os serviços que você oferece</h4>
            </div>

            <div class="form-group" id="servicos_oferecidos">
                <div class="form-group">
                    <div class="col-sm-6">
                        <select class="form-control" name="services-select" id="services-select">
                            <option value="">Serviços oferecidos</option>

                            @foreach($services as $service)
                                <option value="{{ $service->id }}">{{ $service->description }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <div class="input-group">
                            <div class="input-group-addon">R$</div>
                            <input type="text" class="form-control money2" name="price" id="price" placeholder="Valor (opcional)">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <a href="#" class="btn btn-success pull-right insert-service">Incluir</a>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <span class="help-block small">Caso não informe um valor, será exibido <strong>"Sob consulta"</strong> no lugar.</span>
                    </div>
                </div>
            </div>

            <div class="form-group" id="deseja_topo">
                <table class="table table-hover" id="table-services">
                    <thead>
                        <tr>
                            <td class="col-sm-6"><strong>Serviços oferecidos</strong></td>
                            <td class="col-sm-4 text-right"><strong>Valor R$</strong></td>
                            <td class="col-sm-2"></td>
                        </tr>
                        {{-- {{ $user->profiles->services[0]->pivot->price }} --}}
                        @if(!empty($user->profiles->services))
                            @foreach($user->profiles->services as $service)
                                <tr>
                                    <td class="col-sm-6">{{ $service->description }}</td>
                                    <td class="col-sm-4 text-right">{{ $service->pivot->price != '0' ? number_format($service->pivot->price,2,',','.') : 'Sob consulta' }}</td>
                                    <td class="col-sm-2" style="vertical-align:middle">
                                        <a href="#" class="btn btn-success pull-right remove-service">Remover</a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </thead>
                    <tbody>
                    </tbody>

                </table>
            </div>
        </div><!-- col esquerda -->


        <!--- COLUNA DA DIREITA
        ======================== -->

        <div class="col-sm-6 col-direita">
            <div class="form-group">
                <div class="col-sm-12">
                    <h4>Galeria de imagens</h4>
                </div>
            </div>
            <!-- <div class="form-group" id="envio_arquivos"> -->
            <div class="form-group">
                <div class="col-sm-9">
                    <input type="file" class="form-control"   name="file" id="file" placeholder="Selecione">
                </div>
                <div class="col-sm-3">
                    <div class="checkbox pull-right">
                        <label>
                            <input class="pull-right" type="checkbox" value="1" name="logo" id="logo"> Logomarca
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
            <div class="form-group">
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
                    <a href="#" class="btn btn-success pull-right insert-image">Incluir imagem</a>
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
                                                <img src="uploads/fotos/{{ $gallery->filename }}" alt="">
                                            </a>
                                            @if(!empty($gallery->logo))
                                                Logo
                                            @endif
                                        </td>
                                        <td class="col-sm-8">
                                            <span class="small">{{ $gallery->subtitle }}</span>
                                        </td>
                                        <td class="col-sm-2" style="vertical-align:middle">
                                            <a href="#" class="btn btn-danger btn-sm  pull-right remove-item">Remover</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="form-group pull-right">
                <div class="col-sm-3">
                    <a class="btn btn-info pull-right" id="voltapg">Voltar</a>
                </div>
                <div class="col-sm-9">
                    <a class="btn btn-info btn-block pull-right" id="salvar">Salvar cadastro</a>

                    {{-- <a class="btn btn-info btn-block pull-right" id="salvar">Salvar cadastro e efetuar pagamento</a> --}}
                    {{--<buttom class="btn btn-info btn-block pull-right">Salvar cadastro e efetuar pagamento</buttom>--}}
                    {{--<input type="submit" class="btn btn-info btn-block pull-right" style="font-size:14px;" id="salvar" value="Salvar cadastro e efetuar pagamento">--}}
                </div>
            </div>
        </div><!-- col direita -->
    </article>
