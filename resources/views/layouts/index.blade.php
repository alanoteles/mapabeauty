@extends('layouts.master')

@section('content')
    <!-- HERO 
		========================================== -->
		<section id="hero" data-type="background" data-speed="5">
			<article>
				<div class="container clear-fix">
					<div class="row">
						<!-- <div class="col-sm-5">
							<img src="<?php //bloginfo('stylesheet_directory');  ?>/assets/img/logo-badge.png" alt="Bootstrap to Worpress" class="logo">
						</div> --><!-- col -->

						<div class="col-sm-5 hero-text">
							<!-- <h1><?php //bloginfo('name'); ?></h1> -->
							<p class="lead">Conecte-se com seu próximo cliente !</p>

							<!-- <div id="price-timeline">
								<div class="price active">
									<h4>Pre-Launch Price <small>Ends soon</small></h4>
									<span><?php //echo $prelaunch_price ?></span>
								</div> --><!-- price -->
								<!-- <div class="price">
									<h4>Launch Price <small>Coming soon</small></h4>
									<span><?php //echo $launch_price ?></span>
								</div> --><!-- price -->
								<!-- <div class="price">
									<h4>Final Price <small>Coming soon</small></h4>
									<span><?php //echo $final_price ?></span>
								</div> --><!-- price -->
							<!-- </div> -->

							<p><a class="btn btn-lg btn-success" href="/profile/login" role="button">Seja nosso parceiro !  &raquo;</a></p>
						
						</div><!-- col -->

					</div><!-- row -->
				</div><!-- container -->
			</article>
		</section><!-- hero -->

		<!-- OPT IN
		========================================== -->
		<section id="optin">
			<div class="container">
				<form role="form" class="form-inline">
					<div class="row">
					
						<div class="form-group col-sm-2">
							<select class="form-control input-sm" name="" id="">
								<option value="">Selecione um estado</option>
							</select>
						</div>
						<div class="form-group  col-sm-2">
							<select class="form-control input-sm" name="" id="">
								<option value="">Selecione uma cidade</option>
							</select>
						</div>
						<div class="form-group col-sm-2">
							<select class="form-control input-sm" name="" id="">
								<option value="">Selecione um bairro</option>
							</select>
						</div>
						<div class="form-group col-sm-2">
							<select class="form-control input-sm" name="" id="">
								<option value="">O que você procura ?</option>
							</select>
						</div>
						<div class="form-group  col-sm-4 pull-right">
							<a class="btn btn-success btn-block" data-toggle="modal" data-target="#myModal">
								Buscar
							</a>
						</div>
					</div>	
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
					      <tr class="destaque-tabela">
					      	<td>
					      		<img src="assets/img/icon-rocket.png" alt="">
				      		</td>
					        
					        <td>
								<p class="lead"><strong>Clínica ABC</strong></p>
					        	Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore molestias a, libero harum deserunt minus. Eveniet veritatis, quaerat quod omnis a deleniti eaque ab iste. Odit voluptate, hic. Facilis earum quasi, ut, praesentium, commodi rerum placeat ducimus autem veniam, iusto ipsam? Rerum ipsa commodi sequi dolores quis nobis porro animi?
				        	</td>
					      </tr>
					      <tr>
					      	<td>
					      		<img src="assets/img/icon-rocket.png" alt="">
				      		</td>  
					        <td>
					        	<p class="lead"><strong>Clínica ABC</strong></p>
					        	Lorem ipsum dolor sit amet, consectetur adipisicing elit. Labore facere, magnam inventore enim, ea, neque voluptatum fugiat sed rem nihil, molestias? Accusamus facere, est animi esse blanditiis harum, dolores omnis voluptatibus ipsa repudiandae quidem et. Deserunt aperiam molestiae ad tenetur asperiores fuga hic vero, recusandae minima placeat odio sapiente unde.
				        	</td>
					      </tr>
					      <tr>
					      	<td>
					      		<img src="assets/img/icon-rocket.png" alt="">
					      	</td>  
					        <td>
						        <p class="lead"><strong>Clínica ABC</strong></p>
						        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consectetur, amet. Deserunt voluptates sed id quia quos quas voluptatum rem alias enim fugit quod, adipisci distinctio laborum a voluptate, sint iusto rerum. Animi ea fugit cum, tenetur, similique velit ut voluptas libero maiores quasi nesciunt fuga modi vitae dolorem deleniti iste.
					        </td>
					      </tr>
					      <tr>
					      	<td>
					      		<img src="assets/img/icon-rocket.png" alt="">
					      	</td>  
					        <td>
						        <p class="lead"><strong>Clínica ABC</strong></p>
						        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consectetur, amet. Deserunt voluptates sed id quia quos quas voluptatum rem alias enim fugit quod, adipisci distinctio laborum a voluptate, sint iusto rerum. Animi ea fugit cum, tenetur, similique velit ut voluptas libero maiores quasi nesciunt fuga modi vitae dolorem deleniti iste.
					        </td>
					      </tr>
					      <tr>
					      	<td>
					      		<img src="assets/img/icon-rocket.png" alt="">
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