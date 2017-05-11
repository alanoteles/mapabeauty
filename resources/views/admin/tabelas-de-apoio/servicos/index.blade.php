@extends('admin.layouts.master')

@section('title','Serviços')

@section('content')

    @include('admin.includes.flashmessages')

    <!-- WRAP DOS DADOS -->
    <div class="row">
        <div class="col-xs-12 align-right margin-top-10">
            <a href="/admin/tabelas-de-apoio/services/create">
                <button class="btn btn-sm btn-success">
                    Novo serviço
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
                    <th style="width: 70%;">Serviço</th>
                    <th class="hidden-480">Exibir</th>
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
                        <a href="/admin/tabelas-de-apoio/services/{{$resultado->id}}/edit">
                            {{ $res['description'] }}
                        </a>
                    </td>
                    <td class="hidden-480 situacao situacao-clientes">
                        <select class="form-control transparent status" name="status" data-id="{{$resultado->id}}">
                            <option value="1" {{ ($resultado->status == '1') ? 'selected=selected' : ''  }}>Sim</option>
                            <option value="0" {{ ($resultado->status == '0') ? 'selected=selected' : ''  }}>Não</option>
                        </select>
                    </td>
                    <td class="acoes center">
                        <div class="btn-group">
                            <a href="#" class="btn btn-xs btn-grey remover-item-lista excluir" data-id="{{$resultado->id}}">
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