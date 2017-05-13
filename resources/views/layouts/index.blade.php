@extends('layouts.master')

@section('content')
    <!-- HERO 
		========================================== -->
		<section id="hero" data-type="background" data-speed="5" style="background: url('uploads/topos/{{ $banner->filename  }}') 50% 0 no-repeat fixed;">
			<article>
				<div class="container clear-fix">
					<div class="row">
					
						<div class="col-sm-5 hero-text">
							<p class="lead">{{ !empty($banner) ? $banner['message'] : '' }}</p>
	
							<p><a class="btn btn-lg btn-success" 
									@if(Auth::check())
										href="/profile" 
									@else	
										href="/login" 
									@endif
									role="button">{{ !empty($banner) ? $banner['button_label'] : '' }}</a>
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

                            @if(!empty($results))
                                @foreach($results as $key => $result)
                                    <tr @if($result['detached'] == '1') class="destaque-tabela" @endif>
                                        <td>
                                            @if(!empty($result['logo']))
                                                <img style="max-width: 80px;height: 80px" src="uploads/fotos/{{ $result['logo'] }}" alt="">
                                            @endif
                                        </td>

                                        <td>
                                            <p class="lead">
                                                <a href="/detail/{{ $result['id'] }}" style="color: #3E4249;"><strong>{{ !empty($result['fantasy_name']) ? $result['fantasy_name'] : $result['professional_name'] }}</strong></a>
                                            </p>
                                            {{ $result['about'] }}
                                        </td>
                                    </tr>
                                @endforeach
                            @endif

					    </tbody>
					</table>
				</div>
				{{--<div class="section-header maisresultados">--}}
					{{--<button class="btn btn-success">Exibir mais resultados</button>--}}

				{{--</div>--}}
			</div>
			
		</section>
@endsection