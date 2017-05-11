@extends('admin.layouts.master')

@section('title','Nível')

@section('content')

    @include('admin.includes.flashmessages')

    <!-- WRAP DOS DADOS -->

    <div class="row-fluid">
        <div class="table-responsive">
            <table id="sample-table-1" class="table table-striped table-bordered table-hover no-margin">
                <thead>
                <tr>

                    <th style="width: 70%;">Níveis</th>
                    <th class="center">Itens</th>
                </tr>
                </thead>

                <tbody>
                <!-- line -->
                <tr>

                    <td class="nome-grupo" style="width: 70%;"><a href="" data-route="/admin/tabelas-de-apoio/nivel/L/edit">Linha</a></td>

                    <td class="acoes center">
                        <div class="btn-group">
                            {{ $total_linhas }}
                        </div>
                    </td>
                </tr>

                <tr>

                    <td class="nome-grupo" style="width: 70%;"><a href="" data-route="/admin/tabelas-de-apoio/nivel/T/edit">Tema</a></td>

                    <td class="acoes center">
                        <div class="btn-group">
                            {{ $total_temas }}
                        </div>
                    </td>
                </tr>

                <tr>

                    <td class="nome-grupo" style="width: 70%;"><a href="" data-route="/admin/tabelas-de-apoio/nivel/S/edit">Subtema</a></td>

                    <td class="acoes center">
                        <div class="btn-group">
                            {{ $total_subtemas }}
                        </div>
                    </td>
                </tr>
                <!--/ line -->

                </tbody>
            </table>
        </div><!-- /.table-responsive -->
        <!--/ ######### tabela responsiva ######### -->
    </div>



<!-- / WRAP DOS DADOS -->

<!-- scripts exclusivos desta area -->
{{--<script src="{{asset('admin/js/modalidade.js')}}"></script>--}}

@endsection('content')