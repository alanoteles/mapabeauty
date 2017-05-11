@extends('admin.layouts.master')

@section('title','Tags')

@section('content')

    @include('admin.includes.flashmessages')

    <!-- WRAP DOS DADOS -->
    <div class="row">
        <div class="col-xs-12 align-right margin-top-10">
            <a href="" data-route="/admin/tabelas-de-apoio/tag/create">
                <button class="btn btn-sm btn-success">
                    Nova tag
                </button>
            </a>
        </div>
    </div>


    <!-- Fomulario de pesquisa -->
    @include('admin.includes.pesquisa')
    <!-- Fomulario de pesquisa -->


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
                    <th style="width: 70%;">Nome da tag</th>
                    <th class="center">Ações</th>
                </tr>
                </thead>

                <tbody>
                <!-- line -->
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
                        <a href="" data-route="/admin/tabelas-de-apoio/tag/{{$resultado->tag_id}}/edit">
                            {{ $res['name'] }}
                        </a>
                    </td>

                    <td class="acoes center">
                        <div class="btn-group">
                            <a href="#" class="btn btn-xs btn-grey remover-item-lista excluir" data-id="{{$resultado->tag_id}}">
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

    <!-- PAGINAÇÃO -->
    @include('admin.includes.paginacao')
    <!--/ PAGINAÇÃO -->

<!-- / WRAP DOS DADOS -->

<!-- scripts exclusivos desta area -->
{{--<script src="{{asset('admin/js/modalidade.js')}}"></script>--}}

@endsection('content')