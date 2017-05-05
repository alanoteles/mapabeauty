<div class="col-sm-12 no-padding margin-top-40 margin-bottom-10">
    <div class="widget-body" style="border: 0;">
        <div class="widget-main no-padding">
            <table class="table table-bordered table-striped produtos-pesquisados">
                <thead class="thin-border-bottom">
                <tr>
                    <th>Título</th>
                    <th>Linha</th>
                    <th>Tema</th>
                    <th>Sub tema</th>
                    <th>Ações</th>
                </tr>
                </thead>


                <tbody id="resultado_ajax_objetos">
                    @if(count($resultados) > 0)
                        @foreach($resultados as $key => $anexos)

                            <tr data-id="{{ $anexos->id }}">
                                <td class="col-xs-3">{{ $anexos->title }}</td>
                                <td class="col-xs-3">{{ $anexos->thread->title }}</td>
                                <td class="col-xs-3">{{ $anexos->topic->title }}</td>
                                <td class="col-xs-2">{{ $anexos->subtopic->title }}</td>
                                <td class="col-xs-1 align-center"><a href="" class="add-item-table"><img src="{{ asset('admin/assets/images/icon_adicionar_ativo.png') }}" alt=""></a></td>
                            </tr>
                        @endforeach
                    @else
                        <tr><td colspan="5" align="center">Nenhum objeto encontrado</td></tr>
                    @endif

                </tbody>
            </table>
        </div><!-- /widget-main -->
    </div><!-- /widget-body -->
</div>

{{--<br clear="all" />--}}
@if(count($resultados) > 0)
    <div class="row">
        <div class="col-xs-12 container-pag no-margin padding-15" >
            <div class="col-xs-6 no-padding-left padding-top-10">
                {{ $resultados->firstItem() }} a {{ $resultados->lastItem() }} registros de {{ $resultados->total() }}
            </div>
            <div class="col-xs-6 align-right no-padding-right no-padding-top" id="pagination">
                {{ $resultados->links() }}
            </div>
        </div>
    </div>
@endif