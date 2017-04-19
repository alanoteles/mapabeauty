@extends('layouts.master')

@section('content')
    <!-- HERO 
		========================================== -->
		<section id="hero" data-type="background" data-speed="5">
			<article>
				<div class="container clear-fix">
					<div class="row">
					
						<div class="col-sm-5 hero-text">
							<p class="lead">Conecte-se com seu próximo cliente !</p>
	
							<p><a class="btn btn-lg btn-success" 
									@if(Auth::check())
										href="/profile" 
									@else	
										href="/login" 
									@endif
									role="button">Seja nosso parceiro !  &raquo;</a>
							</p>
						
						</div><!-- col -->

					</div><!-- row -->
				</div><!-- container -->
			</article>
		</section><!-- hero -->

		<!-- OPT IN
		========================================== -->
		<section id="optin">
			<div class="container">
				<form role="form" class="form-inline" method="post" action="/search">

					<div class="row">
					
						<div class="form-group col-sm-2">
							<select class="form-control input-sm" name="select-state" id="select-state">
								<option value="">Selecione um estado</option>
								@foreach($states as $state)
									<option value="{{ $state->code }}">{{ $state->name }}</option>
								@endforeach

							</select>
						</div>
						<div class="form-group  col-sm-2">
							<select class="form-control input-sm" name="select-city" id="select-city" disabled>
								<option value="">Selecione uma cidade</option>
							</select>
						</div>
						<div class="form-group col-sm-2">
							<select class="form-control input-sm" name="select-neighborhood" id="select-neighborhood" disabled>
								<option value="">Selecione um bairro</option>
							</select>
						</div>
						<div class="form-group col-sm-2">
							<select class="form-control input-sm" name="select-service" id="select-service">
								<option value="">O que você procura ?</option>
								@foreach($services as $service)
								<option value="{{ $service->id }}">{{ $service->description }}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group  col-sm-4 pull-right">
							<button type="submit" class="btn btn-success btn-block">
								Buscar
							</button>
						</div>
					</div>
                    {!! csrf_field() !!}
				</form>
				</div>
			</div>
		</section>


		<!-- BOOST YOUR INCOME 
		========================================== -->
		<section id="listagem-home">
			<div class="container">
				<div class="col-sm-12">
					<table class="table table-striped">
					    <tbody>
{{--aa{{ print_r($results) }}--}}
                        @if(!empty($results))
                            @foreach($results as $key => $result)
                                <tr @if($result['detached'] == '1') class="destaque-tabela" @endif>
                                    <td>
                                        @if(!empty($result['logo']))
                                            <img style="max-width: 80px;height: 80px" src="uploads/fotos/{{ $result['logo'] }}" alt="">
                                        @endif
                                    </td>

                                    <td>
                                        <p class="lead"><strong>{{ !empty($result['fantasy_name']) ? $result['fantasy_name'] : $result['professional_name'] }}</strong></p>
                                        {{ $result['about'] }}
                                    </td>
                                </tr>
                            @endforeach
                        @endif
					      <tr>
					      	<td>
					      		<img src="/assets/img/icon-rocket.png" alt="">
				      		</td>  
					        <td>
					        	<p class="lead"><strong>Clínica ABC</strong></p>
					        	Lorem ipsum dolor sit amet, consectetur adipisicing elit. Labore facere, magnam inventore enim, ea, neque voluptatum fugiat sed rem nihil, molestias? Accusamus facere, est animi esse blanditiis harum, dolores omnis voluptatibus ipsa repudiandae quidem et. Deserunt aperiam molestiae ad tenetur asperiores fuga hic vero, recusandae minima placeat odio sapiente unde.
				        	</td>
					      </tr>
					      <tr>
					      	<td>
					      		<img src="/assets/img/icon-rocket.png" alt="">
					      	</td>  
					        <td>
						        <p class="lead"><strong>Clínica ABC</strong></p>
						        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consectetur, amet. Deserunt voluptates sed id quia quos quas voluptatum rem alias enim fugit quod, adipisci distinctio laborum a voluptate, sint iusto rerum. Animi ea fugit cum, tenetur, similique velit ut voluptas libero maiores quasi nesciunt fuga modi vitae dolorem deleniti iste.
					        </td>
					      </tr>
					      <tr>
					      	<td>
					      		<img src="/assets/img/icon-rocket.png" alt="">
					      	</td>  
					        <td>
						        <p class="lead"><strong>Clínica ABC</strong></p>
						        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consectetur, amet. Deserunt voluptates sed id quia quos quas voluptatum rem alias enim fugit quod, adipisci distinctio laborum a voluptate, sint iusto rerum. Animi ea fugit cum, tenetur, similique velit ut voluptas libero maiores quasi nesciunt fuga modi vitae dolorem deleniti iste.
					        </td>
					      </tr>
					      <tr>
					      	<td>
					      		<img src="/assets/img/icon-rocket.png" alt="">
					      	</td>  
					        <td>
						        <p class="lead"><strong>Clínica ABC</strong></p>
						        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consectetur, amet. Deserunt voluptates sed id quia quos quas voluptatum rem alias enim fugit quod, adipisci distinctio laborum a voluptate, sint iusto rerum. Animi ea fugit cum, tenetur, similique velit ut voluptas libero maiores quasi nesciunt fuga modi vitae dolorem deleniti iste.
					        </td>
					      </tr>
					    </tbody>
					</table>
				</div>
				<div class="section-header maisresultados">
					<button class="btn btn-success">Exibir mais resultados</button>

				</div>
			</div>
			
		</section>
@endsection