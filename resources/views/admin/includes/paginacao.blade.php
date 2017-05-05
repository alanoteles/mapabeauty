{{--{{ $resultados  }}--}}
@if(isset($resultados))
    <div class="row">
        <div class="col-xs-12 container-pag no-margin padding-15" >
            <div class="col-xs-6 no-padding-left padding-top-10">
                {{ $resultados->firstItem() }} a {{ $resultados->lastItem() }} registros de {{ $resultados->total() }}
            </div>
            <div class="col-xs-6 align-right no-padding-right no-padding-top">
                {{--{{ $resultados->links() }}--}}
                {{ $resultados->appends(['palavra_chave'    => \Request::input('palavra_chave'),
                                        'table'             => \Request::input('table'),
                                        'table_translation' => \Request::input('table_translation'),
                                        'fk'                => \Request::input('fk'),
                                        'model'             => \Request::input('model'),
                                        'exibir'            => \Request::input('exibir'),
                                        'grupo'             => \Request::input('grupo'),
                                        'situacao'          => \Request::input('situacao'),
                                        'idioma'            => \Request::input('idioma'),
                                        'atividade'         => \Request::input('atividade'),
                                        'editoria'          => \Request::input('editoria'),
                                        'modalidade'        => \Request::input('modalidade'),
                                        'tipo_de_midia'     => \Request::input('tipo_de_midia'),
                                        'linha'             => \Request::input('linha'),
                                        'tema'              => \Request::input('tema'),
                                        'view'              => \Request::input('view')
                ])->links() }}
            </div>
        </div>
    </div>
@endif