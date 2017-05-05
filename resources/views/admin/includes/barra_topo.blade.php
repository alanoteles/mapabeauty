<!-- BARRA TOPO -->

<div class="navbar navbar-default" id="navbar">

    <div class="navbar-container" id="navbar-container">
        <div class="navbar-header pull-left">
            <a href="" data-route="/admin"  class="navbar-brand"><small>Mapa Beauty | Área administrativa</small></a>
        </div>

        <div class="navbar-header pull-right" role="navigation">
            <ul class="nav ace-nav">


                <li class="light-blue">
                    <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                        <img class="nav-user-photo" src="{{ asset('admin/assets/avatars/user.jpg') }}" alt="Jason's Photo" />
                        <span class="user-info"><small>Bem vindo,</small>{{ (Session::has('usuario')) ? Session::get('usuario.name') : 'Visitante' }}</span>
                        <i class="icon-caret-down"></i>
                    </a>

                    <ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                        {{--<li><a href="#"><i class="icon-cog"></i>Settings</a></li>--}}
                        {{--<li><a href="#"><i class="icon-user"></i>Profile</a></li>--}}
                        {{--<li class="divider"></li>--}}
                        <li><a href="#" data-route="/admin/logout"><i class="icon-off"></i>Logout </a></li>
                    </ul>
                </li>
            </ul><!-- /.ace-nav -->
        </div><!-- /.navbar-header -->
    </div><!-- /.container -->
</div>
<!-- / BARRA TOPO -->