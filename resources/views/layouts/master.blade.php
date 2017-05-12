<!DOCTYPE html>
<html lang="pt_br">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11">

		<!-- Bootstrap core CSS -->
		<link href="{{ secure_asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
		
		<!-- Font Awesome Icons -->
		<link href="{{ secure_asset('assets/css/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
		
		<!-- Custom CSS -->
		<link href="{{ secure_asset('assets/css/custom.css') }}" rel="stylesheet">


        <link href="{{ secure_asset('assets/css/jquery.bxslider.min.css') }}" rel="stylesheet">
		
		<!-- Google Fonts -->
		<link href='https://fonts.googleapis.com/css?family=Raleway:400,700' rel='stylesheet' type='text/css'>

		<!-- HTML5 shiv and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

		<meta name="csrf-token" content="{{ csrf_token() }}" />

	</head>

	<body data-page="{{ $page or '-'}}">
		<!-- HEADER
		================================================== -->
		<header class="site-header" role="banner">
			
			<!-- NAVBAR
			================================================== -->
			<div class="navbar-wrapper">
				
				<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
					<div class="container">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
							<a class="navbar-brand" href="/"><img src="{{ secure_asset('assets/img/logo3.png') }}" alt="Mapa Beauty"></a>
						</div>
						<div class="navbar-collapse collapse">
							<ul class="nav navbar-nav navbar-right">
								<li class="active"><a href="/">Início</a></li>
								<li><a href="/about">Sobre nós</a></li>
								<li><a href="/contact">Fale conosco</a></li>
								@if(Auth::check())
									<li><a href="/profile">Acessar seu perfil</a></li>
									<li><a href="/logout">Sair</a></li>
								@else
									<li><a href="/login">Login de parceiros</a></li>
								@endif
								
							</ul>
						</div>
					</div>
				</div>
			
			</div>
		</header>


		@yield('content')



		<!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>	 -->
		{{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>--}}
		<script src="assets/js/jquery-2.2.4.min.js"></script>
		<script src="{{ secure_asset('assets/js/bootstrap.min.js') }}"></script>
		<script src="{{ secure_asset('assets/js/bootbox.min.js') }}"></script>
		<script src="{{ secure_asset('assets/js/jquery.mask.min.js') }}"></script>
		<script src="{{ secure_asset('assets/js/js.cookie.js') }}"></script>
		<script src="{{ secure_asset('assets/js/jquery.form.min.js') }}"></script>
		<script src="{{ secure_asset('assets/js/valida_cpf_cnpj.js') }}"></script>
		<script src="{{ secure_asset('assets/js/jquery.bxslider/jquery.bxslider.min.js') }}"></script>
		{{-- <script src="{{ asset('assets/js/jquery.cookie.js') }}"></script> --}}

		<script type="text/javascript">
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
		</script>

		<script src="{{ secure_asset('assets/js/main.js') }}"></script>
		{{--<script src="https://use.typekit.net/gcy4xta.js"></script>--}}
		{{--<script>try{Typekit.load({ async: true });}catch(e){}</script>--}}


		<div class="modal fade" id="myModal">
			<div class="modal-dialog">
				<div class="modal-content">
					<img id="modal_image" src="" alt="" style="display: none;">

					<div class="review" style="display: block;">
						<p align="center" >Gostou do atendimento ? <br>Dê sua nota !</p>
						<span>
                            <img src="/assets/img/star.png" alt="">
                            <img src="/assets/img/star.png" alt="">
                            <img src="/assets/img/star.png" alt="">
                            <img src="/assets/img/star.png" alt="">
                            <img src="/assets/img/star.png" alt="">
                        </span>
                        <a href="" class="btn btn-info" id="review_facebook">Facebook</a>
                        <a href="" class="btn btn-info" id="review_twitter">Twitter</a>
                        <a href="" class="btn btn-info" id="review_google">Google+</a>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" id="reviewModal">
			<div class="modal-dialog .modal-sm">
				<div class="modal-content">
					<div class="modal-header">
                		Gostou do atendimento ?
            		</div>
					<p align="center" >Dê sua nota !<br>
						{{-- <span>
	                        <img src="/assets/img/star.png" alt="">
	                        <img src="/assets/img/star.png" alt="">
	                        <img src="/assets/img/star.png" alt="">
	                        <img src="/assets/img/star.png" alt="">
	                        <img src="/assets/img/star.png" alt="">
	                    </span> --}}
	                    <div id="r1" class="rate_widget" align="center">
					        <div class="star_1 ratings_stars" data-value="1"></div>
					        <div class="star_2 ratings_stars" data-value="2"></div>
					        <div class="star_3 ratings_stars" data-value="3"></div>
					        <div class="star_4 ratings_stars" data-value="4"></div>
					        <div class="star_5 ratings_stars" data-value="5"></div>
					    </div>
                	</p>
                	<br><br>
                	<p align="center">
                		<a href="" class="btn btn-sm btn-info" id="send-review">Enviar</a>
                	</p>
                    	
					
				</div>
			</div>
		</div>
	</body>
</html>

