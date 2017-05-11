@extends('admin.layouts.master')

@section('title','Escolaridade')

@section('content')

    @include('admin.includes.flashmessages')

     <!-- WRAP DOS DADOS -->
        <div class="row">
            <div class="col-xs-12 align-right margin-top-10">
                <a href="" data-route="/admin/tabelas-de-apoio/escolaridade/create"><button class="btn btn-sm btn-success">Novo nível de escolaridade</button></a>
            </div>
        </div>

        <!-- Fomulario de pesquisa -->
        @include('admin.includes.pesquisa')


        <div class="row-fluid">
            <div class="table-responsive">
                <table id="sample-table-1" class="table table-striped table-bordered table-hover no-margin">
                    <thead>
                    <tr>
                        <th class="align-left acao-massa">
                            <label>
                                &nbsp; <input type="checkbox" class="ace">
                                <span class="lbl"></span>
                            </label>
                            <div class="btn-group">
                                <button data-toggle="dropdown" class="btn btn-xs dropdown-toggle">
                                    <span class="icon-caret-down icon-on-right"></span>
                                </button>

                                <ul class="dropdown-menu dropdown-inverse">
                                    <li><a href="#" class="ativar-all">Ativar</a></li>
                                    <li><a href="#">Desativar</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#" class="excluir_massa">Excluir</a></li>
                                </ul>
                            </div>
                        </th>
                        <th style="width: 70%;">Nível</th>
                        <th >Ordenação</th>
                        <th class="center">Ações</th>
                    </tr>
                    </thead>

                    <tbody>
                    {{--<!-- line -->{{ dd($resultados) }}--}}
                    @foreach($resultados as $key => $resultado)
                    <tr>
                        <td class="sel">
                            <label>
                                &nbsp; <input type="checkbox" class="ace">
                                <span class="lbl"></span>
                            </label>
                        </td>

                        <?php $res = $resultado->toArray(); ?>

                        <td class="nome-grupo" style="width: 70%;">
                            <a href="" data-route="/admin/tabelas-de-apoio/escolaridade/{{$resultado->schooling_id}}/edit">
                                {{ $res['name'] }}
                            </a>
                        </td>

                        <td class="">
                            {{$resultado->order}}

                            @if($resultado->order !=($resultados->total()-1))
                                <a href="#" class="pull-right margin-right-10 ordena-baixo" data-id="{{$resultado->schooling_id}}">
                                    <img src="{{ url('/') .'/admin/assets/images/seta_baixo.png'}}" alt="">
                                </a>
                            @endif

                            @if($resultado->order !=0)
                                <a href="#" class="pull-right margin-right-10 ordena-cima" data-id="{{$resultado->schooling_id}}">
                                    <img src="{{ url('/') .'/admin/assets/images/seta_cima.png'}}" alt="">
                                </a>
                            @endif
                        </td>
                        <td class="acoes center">
                            <div class="btn-group">
                                <a href="#" class="btn btn-xs btn-grey remover-item-lista excluir" data-id="{{$resultado->schooling_id}}">
                                    <i class="icon-trash bigger-120"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    <!--/ line -->

                    </tbody>
                </table>
            </div><!-- /.table-responsive -->
            <!--/ ######### tabela responsiva ######### -->
        </div>
    <!-- / WRAP DOS DADOS -->

    @include('admin.includes.paginacao')

<!-- scripts exclusivos desta area -->
<script src="{{asset('admin/js/nivel-escolaridade.js')}}"></script>

@endsection('content')