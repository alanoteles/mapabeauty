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

        <p>Exemplo:  Ao cadastrar um novo Cliente é preciso informar, em um dos campos do formulário, a cidade na qual reside esse cliente. A tabela de apoio "Cidades" permite que você inclua, edite ou remova as cidades que são exibidas nesse campo do formulário.</p>


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


        {{--<div class="col-sm-6 no-padding">--}}
            {{--<a href="grupo-de-usuarios.html">--}}
                {{--<div class="bloco-medio padding-10 margin-right-20 margin-bottom-20">--}}
                    {{--<h4 class="text-primary no-margin-top margin-bottom-5">Grupo de usuários</h4>--}}
                    {{--<p>Utilize essa tabela para incluir, editar ou excluir os grupos de usuários que são utilizados no cadastro de Usuários.</p>--}}
                {{--</div>--}}
            {{--</a>--}}
        {{--</div>--}}

        <div class="col-sm-6 no-padding">
            <a href="" data-route="/admin/tabelas-de-apoio/idioma">
                <div class="bloco-medio padding-10 margin-right-20 margin-bottom-20">
                    <h4 class="text-primary no-margin-top margin-bottom-5">Idioma</h4>
                    <p>Utilize essa tabela para incluir, editar ou excluir os idiomas que são utilizados em todo o portal.</p>
                </div>
            </a>
        </div>

        {{--<div class="col-sm-6 no-padding">--}}
            {{--<a href="perfil.html">--}}
                {{--<div class="bloco-medio padding-10 margin-right-20 margin-bottom-20">--}}
                    {{--<h4 class="text-primary no-margin-top margin-bottom-5">Perfil</h4>--}}
                    {{--<p>Utilize essa tabela para editar os perfis utilizados na criação de grupos de usuários.</p>--}}
                {{--</div>--}}
            {{--</a>--}}
        {{--</div>--}}

        <div class="col-sm-6 no-padding">
            <a href="" data-route="/admin/tabelas-de-apoio/escolaridade">
                <div class="bloco-medio padding-10 margin-right-20 margin-bottom-20">
                    <h4 class="text-primary no-margin-top margin-bottom-5">Escolaridade</h4>
                    <p>Utilize essa tabela para incluir, editar ou excluir os níveis de escolaridade que são utilizadas no cadastro de Clientes. </p>
                </div>
            </a>
        </div>


        <br clear="all">
        <h3 class="header smaller lighter blue font-size-18 margin-top-35" style="font-weight: 400;">
            Banco de conhecimento
        </h3>


        <div class="col-sm-6 no-padding">
            <a href="" data-route="/admin/tabelas-de-apoio/tipo-de-midia">
                <div class="bloco-medio padding-10 margin-right-20 margin-bottom-20">
                    <h4 class="text-primary no-margin-top margin-bottom-5">Tipo de mídia</h4>
                    <p>Utilize essa tabela para incluir, editar ou excluir os tipos de mídia utilizados na criação de objetos.</p>
                </div>
            </a>
        </div>

        <div class="col-sm-6 no-padding">
            <a href="" data-route="/admin/tabelas-de-apoio/tipo-de-material">
                <div class="bloco-medio padding-10 margin-right-20 margin-bottom-20">
                    <h4 class="text-primary no-margin-top margin-bottom-5">Tipo de material</h4>
                    <p>Utilize essa tabela para incluir, editar ou excluir os tipos de materiais utilizados na criação de objetos.</p>
                </div>
            </a>
        </div>

        <div class="col-sm-6 no-padding">
            <a href="" data-route="/admin/tabelas-de-apoio/licenca">
                <div class="bloco-medio padding-10 margin-right-20 margin-bottom-20">
                    <h4 class="text-primary no-margin-top margin-bottom-5">Licença</h4>
                    <p>Utilize essa tabela para incluir, editar ou excluir os tipos de licenças utilizados na criação de objetos.</p>
                </div>
            </a>
        </div>

        <div class="col-sm-6 no-padding">
            <a href="" data-route="/admin/tabelas-de-apoio/tag">
                <div class="bloco-medio padding-10 margin-right-20 margin-bottom-20">
                    <h4 class="text-primary no-margin-top margin-bottom-5">TAG</h4>
                    <p>Utilize essa tabela para incluir, editar ou excluir as TAGs  utilizadas na criação de objetos.</p>
                </div>
            </a>
        </div>

        <div class="col-sm-6 no-padding">
            <a href="" data-route="/admin/tabelas-de-apoio/nivel">
                <div class="bloco-medio padding-10 margin-right-20 margin-bottom-20">
                    <h4 class="text-primary no-margin-top margin-bottom-5">Nível</h4>
                    <p>Utilize essa tabela para incluir, editar ou excluir os níveis de classificação dos objetos.</p>
                </div>
            </a>
        </div>

        <br clear="all">
        <h3 class="header smaller lighter blue font-size-18 margin-top-35" style="font-weight: 400;">
            Portal
        </h3>

        <div class="col-sm-6 no-padding">
            <a href="" data-route="/admin/tabelas-de-apoio/rede-social">
                <div class="bloco-medio padding-10 margin-right-20 margin-bottom-20">
                    <h4 class="text-primary no-margin-top margin-bottom-5">Redes sociais</h4>
                    <p>Utilize essa tabela para incluir, editar ou excluir as redes sociais exibidas no rodapé.</p>
                </div>
            </a>
        </div>

        <div class="col-sm-6 no-padding">
            <a href="" data-route="/admin/tabelas-de-apoio/editoria-da-noticia">
                <div class="bloco-medio padding-10 margin-right-20 margin-bottom-20">
                    <h4 class="text-primary no-margin-top margin-bottom-5">Editoria da notícia</h4>
                    <p>Utilize essa tabela para incluir, editar ou excluir as redes sociais exibidas no rodapé.</p>
                </div>
            </a>
        </div>

        <div class="col-sm-6 no-padding">
            <a href="" data-route="/admin/tabelas-de-apoio/modalidade-de-projeto">
                <div class="bloco-medio padding-10 margin-right-20 margin-bottom-20">
                    <h4 class="text-primary no-margin-top margin-bottom-5">Modalidade do projeto</h4>
                    <p>Utilize essa tabela para incluir, editar ou excluir as modalidades utilizadas na criação de um Projetos.</p>
                </div>
            </a>
        </div>

        <div class="col-sm-6 no-padding">
            <a href="" data-route="/admin/tabelas-de-apoio/situacao-do-projeto">
                <div class="bloco-medio padding-10 margin-right-20 margin-bottom-20">
                    <h4 class="text-primary no-margin-top margin-bottom-5">Situação do projeto</h4>
                    <p>Utilize essa tabela para incluir, editar ou excluir as situações utilizadas na criação de um Projetos.</p>
                </div>
            </a>
        </div>

        <div class="col-sm-6 no-padding">
            <a href="" data-route="/admin/tabelas-de-apoio/atividade-de-projeto">
                <div class="bloco-medio padding-10 margin-right-20 margin-bottom-20">
                    <h4 class="text-primary no-margin-top margin-bottom-5">Atividade de projeto</h4>
                    <p>Utilize essa tabela para incluir, editar ou excluir as atividades utilizadas na criação de um Projetos.</p>
                </div>
            </a>
        </div>

        <div class="col-sm-6 no-padding">
            <a href="" data-route="/admin/tabelas-de-apoio/grupo-de-parceiros">
                <div class="bloco-medio padding-10 margin-right-20 margin-bottom-20">
                    <h4 class="text-primary no-margin-top margin-bottom-5">Grupos de parceiros</h4>
                    <p>Utilize essa tabela para incluir, editar ou excluir os grupos utilizados nno cadastro de Parceiros..</p>
                </div>
            </a>
        </div>


    </div>

<!-- / WRAP DOS DADOS -->


<!-- scripts exclusivos desta area -->
{{--<script src="{{asset('admin/js/noticias.js')}}"></script>--}}

@endsection('content')