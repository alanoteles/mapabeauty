@extends('admin.layouts.master')

@section('title','Usuários')

@section('content')

    @include('admin.includes.flashmessages')

    <div class="row">
        <div class="col-xs-12 align-right margin-top-10">
            <a href="{{ URL::to(App::getLocale() . '/admin/usuarios/create') }}" class="btn btn-sm btn-success">Novo usuário</a>
        </div>
    </div>

    @include('admin.includes.pesquisa')

    <!-- Lista -->
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
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th class="hidden-480">Grupo</th>
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
                        <td style="width: 30%;"><a href="" data-route="/admin/usuarios/{{ $resultado->id }}/edit">{{ $resultado->name }}</a></td>
                        <td style="width: 30%;" >{{ $resultado->email }}</td>
                        <td class="hidden-480 situacao situacao-clientes">{{ $resultado->user_group->name }}</td>
                        <td class="hidden-480 situacao situacao-clientes">

                            <select class="form-control transparent status" name="status" style="height: 22px;"  data-id="{{ (isset($resultado->id) ? $resultado->id : $resultado->id) }}">
                                <option value="1" {{ ($resultado->status == '1') ? 'selected=selected' : ''  }}>Sim</option>
                                <option value="0" {{ ($resultado->status == '0') ? 'selected=selected' : ''  }}>Não</option>
                            </select>
                        </td>
                        <td class="acoes center">
                            <div class="btn-group">
                                
                                <a href="" class="btn btn-xs btn-grey remover-item-lista excluir"  data-id="{{  $resultado->id  }}">
                                    <i class="icon-trash bigger-120"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                <!--/ line -->


                </tbody>
            </table>
        </div>
    </div>
    <!-- / Lista -->

    @include('admin.includes.paginacao')

    <!-- scripts exclusivos desta area -->
    <script src="{{asset('admin/js/usuarios.js')}}"></script>

@endsection('content')