<div class="row margin-top-15 banco-curriculo-pesquisa">
    <div class="col-xs-12">
        <a href="#" id="pesquisaC" class="active">Pesquisa</a>
        <!-- &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; <a href="#" id="pesquisaAC" class="inactive">Pesquisa avançada</a> -->
        <hr class="margin-top-5 margin-bottom-5">
    </div>
</div>


<!-- Formulário de pesquisa -->
<div class="col-xs-12 no-padding margin-bottom-15 margin-top-10">
    <form name="frm" id="pesquisar" method="get" action="/{{ $action }}">
        <input type="hidden" id="model" name="model"    value="{{ $model }}"/>
        <input type="hidden" name="table"               value="{{ $table }}"/>
        <input type="hidden" name="view"                value="{{ $view }}"/>
        <input type="hidden" name="table_translation"   value="{{ $table_translation or ''}}"/>
        <input type="hidden" name="fk"                  value="{{ $fk or ''}}"/>
        <input type="hidden" name="orderBy"             value="{{ $orderBy or ''}}"/>


        <!--  pesquisa  -->
        <div id="area-pesquisa-c">
            <div class="col-xs-3 no-padding-left">
                <input type="text" id="palavra-chave" name="palavra_chave" value="{{ (!empty($palavra_chave) ? $palavra_chave : '') }}" placeholder="palavra-chave" class="col-xs-12 font-light">
            </div>

            @if(isset($exibir))
                <div class="col-xs-2">
                    <select class="form-control" id="exibir" name="exibir">
                        <option value="">Exibir</option>
                        <option value="">Exibir Todos</option>
                        <option value="S">Exibir Sim</option>
                        <option value="N">Exibir Não</option>
                    </select>
                </div>
            @endif

            @if(!empty($situacoes))
                <div class="col-xs-2">
                    <select class="form-control" id="situacao" name="situacao">
                        <option value="">Situações</option>
                        @foreach($situacoes as $situacao)
                            @if($situacao->locale == 'pt_br')
                                <option value="{{ $situacao->id }}">{{ $situacao->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            @endif


            <div class="col-xs-3">
                <button type="submit" class="btn btn-info btn-sm bnt-input-height">Pesquisar</button>
            </div>
        </div>
        {!! csrf_field() !!}
    </form>
</div>
<!-- / Formulário de pesquisa -->