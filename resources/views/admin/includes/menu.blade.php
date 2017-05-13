<!-- BARA DA LATERAL ESQUERDA -->
<div class="sidebar" id="sidebar">

    <!-- Abas superiores -->
    <div class="sidebar-shortcuts" id="sidebar-shortcuts">

        <!-- Icones na aba-->
        <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
            <div class="abas abas-active"><i class="icon-site" onclick="window.location.href='#site'"></i></div>
            <!--
            <div class="abas"><i class="icon-loja" onclick="window.location.href='#loja'"></i></div>
            <div class="abas"><i class="icon-banco" onclick="window.location.href='#banco'"></i></div>
             -->
        </div>

        <!-- Icones na aba em mobile-->
        <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
            <span class="btn btn-success"></span>
            <span class="btn btn-info"></span>
            <span class="btn btn-warning"></span>
            <span class="btn btn-danger"></span>
        </div>
    </div>
    <!--/ Abas -->




    <!-- ############### Menu  ############### -->
    <ul class="nav nav-list menu-esquerdo">
        <li class="{{ strpos(Route::getCurrentRoute()->getPath(),'profiles') ? 'active' : '' }}"><a href="/admin/profiles" ><i class="icon-dashboard"></i><span class="menu-text">Profissionais</span></a></li>
        <li class="{{ strpos(Route::getCurrentRoute()->getPath(),'purchases') ? 'active' : '' }}"><a href="/admin/purchases"><i class="icon-dashboard"></i><span class="menu-text">Compras</span></a></li>
        <li class="{{ strpos(Route::getCurrentRoute()->getPath(),'banners') ? 'active' : '' }}"><a href="/admin/banners"><i class="icon-dashboard"></i><span class="menu-text">Banners</span></a></li>
        <li class="{{ strpos(Route::getCurrentRoute()->getPath(),'tabelas-de-apoio') ? 'active' : '' }}"><a href="/admin/tabelas-de-apoio"><i class="icon-dashboard"></i><span class="menu-text">Tabelas de apoio</span></a></li>
        {{--<li class="inactive"><a href=""><i class="icon-dashboard"></i><span class="menu-text">Ajuda e suporte</span></a></li>--}}
    </ul>
    <!-- / ############### Menu  ############### -->

</div>
<!-- / BARA DA LATERAL ESQUERDA -->