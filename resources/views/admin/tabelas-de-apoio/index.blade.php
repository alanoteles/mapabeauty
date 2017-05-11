@extends('admin.layouts.master')

@section('title','Tabelas de Apoio')

@section('content')

        <!-- WRAP DOS DADOS -->

    <!-- =========== -->

    <div id="area-dica">
        <div class="font-size-16 orange title-apoio">
            <div class="pull-left">O que são tabelas de apoio?</div>
            <div class="pull-right"><a href="#" class="orange" id="closed-dica">x</a></div>
        </div>

        <p>Tabelas de apoio são funcionalidades do sistema que tem uma relevância menor do que as funcionalidades que são exibidas no menu. Essas funcionalidades são pouco utilizadas, mas de extrema importância para o sistema. Os registros inseridos em uma tabela de apoio são exibidos dentro de outros formulários do sistema .</p>

        <p>Exemplo:  Ao cadastrar um novo Profissional é preciso informar, em um dos campos do formulário, os serviços que ele oferece. A tabela de apoio "Serviços" permite que você inclua, edite ou remova os serviços que são exibidos nesse campo do formulário.</p>


        <hr class="no-margin margin-top-5">

        <div class="row-fluid">
            <div class="checkbox text-checkbox no-padding">
                <label>
                    <input name="form-field-checkbox" type="checkbox" class="ace">
                    <span class="lbl"> &nbsp;&nbsp;<div class="font-open-light">Não exibir mais essa dica</div></span>
                </label>
            </div>
        </div>
    </div>

    <!-- =========== -->


    <!-- Tabelas de apoio -->
    <div class="col-sm-12 no-padding margin-top-10 lista-tabelas-apoio">

        <h3 class="header smaller lighter blue font-size-18 margin-top-25" style="font-weight: 400;">
            Geral
        </h3>


        <div class="col-sm-6 no-padding">
            <a href="/admin/tabelas-de-apoio/services">
                <div class="bloco-medio padding-10 margin-right-20 margin-bottom-20">
                    <h4 class="text-primary no-margin-top margin-bottom-5">Serviços</h4>
                    <p>Utilize essa tabela para incluir, editar ou excluir os serviços que serão listados no site.</p>
                </div>
            </a>
        </div>


        <div class="col-sm-6 no-padding">
            <a href="/admin/tabelas-de-apoio/products">
                <div class="bloco-medio padding-10 margin-right-20 margin-bottom-20">
                    <h4 class="text-primary no-margin-top margin-bottom-5">Produtos</h4>
                    <p>Utilize essa tabela para incluir, editar ou excluir os produtos que serão listados no site. </p>
                </div>
            </a>
        </div>


    </div>

<!-- / WRAP DOS DADOS -->


<!-- scripts exclusivos desta area -->
{{--<script src="{{asset('admin/js/noticias.js')}}"></script>--}}

@endsection('content')