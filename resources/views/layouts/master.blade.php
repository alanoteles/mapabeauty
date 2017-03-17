<!DOCTYPE html>
<html lang="pt_br">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11">

		<!-- Bootstrap core CSS -->
		<link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
		
		<!-- Font Awesome Icons -->
		<link href="{{ asset('assets/css/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
		
		<!-- Custom CSS -->
		<link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">
		
		<!-- Google Fonts -->
		<link href='https://fonts.googleapis.com/css?family=Raleway:400,700' rel='stylesheet' type='text/css'>

		<!-- HTML5 shiv and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
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
							<a class="navbar-brand" href="/"><img src="{{ asset('assets/img/logo3.png') }}" alt="Mapa Beauty"></a>
						</div>
						<div class="navbar-collapse collapse">
							<ul class="nav navbar-nav navbar-right">
								<li class="active"><a href="/">Início</a></li>
								<li><a href="/about">Sobre nós</a></li>
								<li><a href="/contact">Fale conosco</a></li>
								<li><a href="/profile/login">Login de parceiros</a></li>
							</ul>
						</div>
					</div>
				</div>
			
			</div>
		</header>


		@yield('content')



		<!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>	 -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
		<!-- <script src="assets/js/jquery-2.2.4.min.js"></script> -->
		<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
		<script src="{{ asset('assets/js/bootbox.min.js') }}"></script>
		<script src="{{ asset('assets/js/jquery.mask.min.js') }}"></script>
		<script src="{{ asset('assets/js/jquery.form.min.js') }}"></script>
		<script src="{{ asset('assets/js/valida_cpf_cnpj.js') }}"></script>
		<script src="{{ asset('assets/js/main.js') }}"></script>
		{{--<script src="https://use.typekit.net/gcy4xta.js"></script>--}}
		{{--<script>try{Typekit.load({ async: true });}catch(e){}</script>--}}


		<div class="modal fade" id="myModal">
			<div class="modal-dialog">
				<div class="modal-content">
					{{--<div class="modal-header">--}}
						{{--<button type="button" class="close" data-dismiss="modal">--}}
							{{--<span aria-hidden="true">&times;</span>--}}
							{{--<span class="sr-only">Close</span>--}}
						{{--</button>--}}
						{{--<h4 class="modal-title" id="myModalLabel">--}}
							{{--<i class="fa fa-envelope"></i>--}}
							{{--Subscribe to our Mailing list--}}
						{{--</h4>--}}
					{{--</div>--}}

					{{--<div class="modal-body">--}}
						{{--<p>--}}
							{{--Simply enter your name and email ! As a thank you for joining us, we're going to give you one of our best-selling courses, <em>for free!</em>--}}
						{{--</p>--}}

						{{--<form class="form-inline" role="form">--}}
							{{--<div class="form-group">--}}
								{{--<label class="sr-only" for="subscribe-name">Your first name</label>--}}
								{{--<input type="text" class="form-control" id="subscribe-name" name="subscribe-name" placeholder="Your first name">--}}
							{{--</div>--}}

							{{--<div class="form-group">--}}
								{{--<label class="sr-only" for="subscribe-email">and your email</label>--}}
								{{--<input type="text" class="form-control" id="subscribe-email" name="subscribe-email" placeholder="and your email">--}}
							{{--</div>--}}

							{{--<input type="submit" class="btn btn-danger" value="Subscribe!">--}}
						{{--</form>--}}

						{{--<hr>--}}

						{{--<p>--}}
							{{--<small>By providing your email you consent to receiving occasional promotional emails &amp; newsletters. <br>No Spam. Just good stuff. We respect your privacy &amp; you may unsubscribe at any time.</small>--}}
						{{--</p>--}}
					{{--</div>--}}

					<img id="modal_image" src="uploads/fotos/b993e7b8cff82dc980a7099df1671bc8.png" alt="">
				</div>
			</div>
		</div>
	</body>
</html>

