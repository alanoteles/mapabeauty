<div class="container">
    <div class="row" id="primary">
        <div id="content" class="col-sm-12">
            <div class="col-sm-12">
                @if(session()->has('error'))
                    <div class="alert alert-danger fade in">
                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                        {{-- {{ $message['msg'] }} --}}{!! session('error') !!}
                    </div>
                @endif  
            </div>
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                {{ csrf_field() }}

                <div class="col-sm-6 col-esquerda">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <h4>Quero ser um parceiro</h4>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-12">
                            {{--<button class="btn btn-success btn-block">--}}
                                {{--Cadastrar com Facebook--}}
                            {{--</button>--}}
                            <a href="{{ url('/auth/facebook') }}" class="btn btn-success btn-block"> Cadastrar com Facebook</a>
                        </div>
                    </div>

                    {{-- <div class="form-group">
                        <div class="col-sm-12">
                            <a href="{{ url('/auth/twitter') }}" class="btn btn-success btn-block"> Cadastrar com Twitter</a>
                        </div>
                    </div> --}}

                    <div class="form-group">
                        <div class="col-sm-12">
                            <a href="{{ url('/auth/google') }}" class="btn btn-success btn-block"> Cadastrar com Google+</a>
                        </div>
                    </div>

                    {{--<div class="form-group">--}}
                        {{--<div class="col-sm-12">--}}
                            {{--<a href="{{ url('/auth/instagram') }}" class="btn btn-success btn-block"> Cadastrar com Instagram</a>--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    <div class="form-group">
                        <div class="col-sm-12">
                            <button class="btn btn-success btn-block" onclick="$('#login-email').show('fast'); return false;">
                                Cadastrar com E-mail
                            </button>
                        </div>
                    </div>

                    <div id="login-email" style="display: none">
                        <div class="form-group">

                            <div class="col-sm-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Digite seu nome">
                            </div>
                            <div class="col-sm-6">
                                <input id="novo_email" type="email" class="form-control" name="novo_email" placeholder="Digite seu e-mail">
                            </div>
                        </div>

                        <div class="form-group">

                            <div class="col-sm-6">
                                <input id="nova_password" type="password" class="form-control" name="nova_password" value="" placeholder="Digite sua senha">
                            </div>
                            <div class="col-sm-6">
                                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" placeholder="Confirme sua senha">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12">
                                <button class="btn btn-info btn-block" id="save-sign-up">
                                    Salvar
                                </button>
                            </div>
                        </div>
                    </div>

                </div><!-- col esquerda -->

                <div class="col-sm-6 col-direita">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <h4>Acessar meu espaço</h4>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-12">
                            {{--<button class="btn btn-success btn-block">--}}
                                {{--Acessar com Facebook--}}
                            {{--</button>--}}
                            <a href="{{ url('/auth/facebook') }}" class="btn btn-success btn-block"> Acessar com Facebook</a>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-12">
                            {{--<button class="btn btn-success btn-block">--}}
                                {{--Acessar com Google+--}}
                            {{--</button>--}}
                            <a href="{{ url('/auth/google') }}" class="btn btn-success btn-block"> Acessar com Google+</a>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-6 {{ $errors->has('email') ? ' has-error' : '' }}">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Digite seu e-mail">
                        </div>
                        <div class="col-sm-6 {{ $errors->has('password') ? ' has-error' : '' }}">
                            <input id="password" type="password" class="form-control" name="password" placeholder="Digite sua senha">
                        </div>
                    </div>

                    {{--<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">--}}
                         {{--<div class="col-md-12">--}}
                            {{--<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Digite seu e-mail">--}}

                            {{--@if ($errors->has('email'))--}}
                                {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('email') }}</strong>--}}
                                    {{--</span>--}}
                            {{--@endif--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    {{--<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">--}}

                        {{--<div class="col-md-12">--}}
                            {{--<input id="password" type="password" class="form-control" name="password" placeholder="Digite sua senha">--}}

                            {{--@if ($errors->has('password'))--}}
                                {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('password') }}</strong>--}}
                                    {{--</span>--}}
                            {{--@endif--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    <div class="form-group">
                        <div class="col-sm-12">
                            <button class="btn btn-info btn-block" id="sign-in">
                                Entrar
                            </button>
                        </div>
                    </div>

                    {{--<div class="form-group">--}}
                        {{--<div class="col-sm-12">--}}


                            {{--<a class="btn btn-link" href="{{ url('/password/reset') }}">Esqueceu sua senha ?</a>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    <div class="form-group">
                        {{--<div class="col-sm-6">--}}
                            {{--<div class="checkbox">--}}
                                {{--<label>--}}
                                    {{--<input type="checkbox" name="remember"> Remember Me--}}
                                {{--</label>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        <div class="col-sm-4 col-md-offset-8">
                            <a class="btn btn-link" href="{{ url('/password/reset') }}">Esqueceu sua senha ?</a>
                        </div>
                    </div>

                </div><!-- col direita -->
            </form>

        </div><!-- content -->
    </div><!-- primary -->
</div><!-- container -->