$(function() {
	
	// Cache the Window object
	var $window = $(window);
	
	// Parallax Backgrounds
	// Tutorial: http://code.tutsplus.com/tutorials/a-simple-parallax-scrolling-technique--net-27641
	
	$('section[data-type="background"]').each(function(){
		var $bgobj = $(this); // assigning the object
		
		$(window).scroll(function() {
		
			// Scroll the background at var speed
			// the yPos is a negative value because we're scrolling it UP!								
			var yPos = -($window.scrollTop() / $bgobj.data('speed'));
			
			// Put together our final background position
			var coords = '50% '+ yPos + 'px';
			
			// Move the background
			$bgobj.css({ backgroundPosition: coords });
			
		}); // end window scroll
	});

	//-- Save the form and, if a product was selected, open lighbox to payment
	$('#salvar').on('click',function(){
		
		var mensagem = "";

		if( $("#fantasy_name").val() == "" ){
			$("#fantasy_name").parent().addClass('has-error');
			mensagem += "<div> - Nome de fantasia;</div>";
		}

		if( $("#services").val() == "" ){
			$("#services-select").parent().addClass('has-error');
			mensagem += "<div> - Serviços oferecidos;</div>";
		}

		if(mensagem){
			bootbox.alert("<h5>Os campos abaixo são de preenchimento obrigatório:</h5>"+mensagem, function() {});
			$(".bootbox .modal-footer .btn-primary").html("Fechar");
			return false;
		}else{
			//alert('else');return false;
			$('#form').attr('action', 'profile');
			$('#form').submit();
		}
	});

//console.log($('#latitude').val());
//console.log($('#longitude').val());

	//-- Carrega o mapa com as coordenadas já cadastradas --//
	if($('#latitude').val() != '' && $('#longitude').val() != ''){
		$('#load_map_buttom').click();
		//$( "#target" ).click();		//eval(panel.trigger('click'));
	}



	$('.insert-service').on('click',function(){

		service_id 		= $('#services-select option:selected').val();

		if(service_id != ''){
			service_price 	= ($('#price').val() != '') ? $('#price').val() : 'Sob consulta';

			//console.log(service_price);

			record = JSON.stringify({"id":service_id, "price":service_price});

			if ($('#services').val() != '') {
				//data.rows 					= jQuery.parseJSON(($('#services').val()))
				temp = jQuery.parseJSON(($('#services').val()));
				temp.push(record);

				data = {
					rows: [
						temp
					]
				};
				//data.rows[data.rows.length] = record;

				$('#services').val(JSON.stringify(data.rows));

			} else {
				data = {
					rows: [
						record
					]
				};

				$('#services').val(JSON.stringify(data.rows));
			}

			$('#table-services > tbody').append(
				'<tr data-id="' + service_id + '">' +
					'<td>' + $('#services-select option:selected').text() + '</td>' +
					'<td class="text-right">' + service_price + '</td>' +
					'<td class="col-sm-2" style="vertical-align:middle">' +
						'<a href="#" class="btn btn-success pull-right remove-service">Remover</a>' +
					'</td>' +
				'</tr>');

			$('#price').val('');	
		}
		
		return false;
	});

	$('.insert-image').on('click',function(){
		//console.log($(this));
		$('#form').attr('action', '/profile/uploadAnexo');
		$('#form').submit();
	});



	$(document).on('click', "a.remove-service", function(e) {
		e.preventDefault();

		var item = $(this);
		item.parent().parent().remove();

		id = item.parent().parent().attr('data-id');
        //
		//hash = img.substr(0, img.length - 4);

		data = jQuery.parseJSON(($('#services').val()));

		index_removed = '';

		$.each(data, function(index, value) {
			x = jQuery.parseJSON(JSON.stringify(value));

			if(x.id == id){
				index_removed = index;
			}

		});

		data.splice(parseInt(index_removed),1);

		$('#services').val(JSON.stringify(data));
	});



	$(document).on('click', "a.remove-item", function(e) {
		e.preventDefault();

		var item = $(this);
		item.parent().parent().remove();

		img 	= item.parent().parent().find('td').eq(0).find('a').attr('data-file');
		hash 	= img.substr(0, img.length - 4);
		data 	= jQuery.parseJSON(($('#uploads').val()));

		index_removed = '';

		$.each(data, function(index, value) {
			x = jQuery.parseJSON(value);

			if(x['hash'] == hash){
				index_removed = index;
			}
		});
		data.splice(parseInt(index_removed),1);

		$('#uploads').val(JSON.stringify(data));
	});


	//-- Abre modal exibindo a foto do cadastro
	$('#myModal').on('show.bs.modal', function(event) {
		$('#modal_image').attr('src','uploads/fotos/' + $(event.relatedTarget).data('file'));
	});




	//-- Faz upload da foto via AJAX e atualiza a variável "uploads" com os dados retornados da imagem
	$("#form").on('submit',(function(e) {
//console.log($(this).attr('action'));
		if($(this).attr('action') != 'profile' && $(this).attr('action') != ''){ //-- O submit foi feito para o envio de imagens
//console.log('if');
			e.preventDefault();

			$.ajax({
				url: "/profile/uploadAnexo",
				type: "POST",
				data: new FormData(this),
				contentType: false,
				cache: false,
				processData: false,
				success: function (data) {
					// retorno = data.file_info_uploaded;


					record = JSON.stringify(data.file_info_uploaded);

					if ($('#uploads').val() != '') {
						temp = jQuery.parseJSON(($('#uploads').val()));
						temp.push(record);

						//data.rows = jQuery.parseJSON(($('#uploads').val()));
						// data = {
						// 	rows: [
						// 		temp
						// 	]
						// };

//console.log(retorno);
						//data.rows[data.rows.length] = retorno;
//console.log(data.rows);
						//console.log(data.rows);
						$('#uploads').val(JSON.stringify(temp));

					} else {
						//console.log(retorno);
						// data = {
						// 		rows: [
						// 			record
						// 		]
						// };
						//data.rows[0] = retorno;
						$('#uploads').val(JSON.stringify(record));
					}

					//-- Mount table with images
					$('.fotos-cadastro').find('tr').remove();

					$.each(temp, function(name, value) {

						value = jQuery.parseJSON(value);
						logo = (value['logo'] == '1') ? 'Logo' : '';
						$('.fotos-cadastro > tbody').append(
							'<tr>' +
								'<td  class="col-sm-2" style="vertical-align:middle">' +
									'<a class="myModal" data-toggle="modal" data-target="#myModal" data-file="' + value['hash'] + '.'+ value['extension'] +'">' +
									'<img src="uploads/fotos/'  + value['hash'] + '.'+ value['extension'] + '" alt="">' +
									'</a>'+ logo +
								'</td>' +
								'<td class="col-sm-8">' +
									'<span class="small">' + value['subtitle'] + '</span>' +
								'</td>' +
								'<td class="col-sm-2" style="vertical-align:middle">' +
									'<a href="#" class="btn btn-danger btn-sm  pull-right remove-item">Remover</a>' +
								'</td>' +
							'</tr>');

						$('#file_subtitle').val('');
					});
					//console.log(retorno.filename);
					$('#form').attr('action', 'profile');
					//console.log($('#uploads').val());
					//return false;
				},
				error: function (data) {
					$('#form').attr('action', 'profile');

					retorno = jQuery.parseJSON(JSON.stringify(data));

					bootbox.alert(retorno.responseJSON, function () {});
					$(".bootbox .modal-footer .btn-primary").html("Fechar");
					return false;
				}
			});
			return false;

		}else{ //-- O submit foi feito para postar o form completo

			//-- Se o produto escolhido foi o mês grátis, seta a cortesia como "1", indicando que foi utilizada. Não faz a compra.
			product_id = $('#product_id option:selected').val();

			if(product_id != '1' && product_id != ''){ //-- Se não for o mês grátis, registra a compra.

				if($('#pagseguro').is(":checked")){
					url = '/purchase/register-pagseguro';
				}else{
					url = '/purchase/register-paypal';
				}

				$(this).text('Carregando...');
				$.ajax({
					url: url,
					type: 'POST',
					data: {'product_id': product_id},
					success: function (response) {

						codigo = response;

						isOpenLightbox = PagSeguroLightbox({
							code: codigo
						}, {
							success : function(transactionCode) {
								alert("success - " + transactionCode);
								window.location.href = window.location.protocol + "//" + window.location.hostname + '/purchase/returned/' + transactionCode
							},
							abort : function() {
								alert("abort");
							}
						});
					}
				});
				e.preventDefault();
				return false;

			}
			//return false;
		}

	}));


	//Activate current menu
	jQuery("*").find("li > a[href='/"+ $('body').data('page') +"']").each(function(){
		$('li').removeClass('active');
		$(this).parent().addClass("active");
	})


	$('#voltapg').click(function() {
		$('#page1, #page2').toggle();
		return false;
	});


	$('#proximapg').click(function(){

		var mensagem = "";

		if( $("#professional_type").val() == "" ){
			$("#professional_type").parent().addClass('has-error');
			mensagem += "<div> - Pessoa Física ou Jurídica;</div>";
		}

		if( $("#professional_name").val() == "" ){
			$("#professional_name").parent().addClass('has-error');
			mensagem += "<div> - Nome da empresa/profissional;</div>";
		}

		if( $("#document").val() == "" ){
			$("#document").parent().addClass('has-error');
			mensagem += "<div> - CPF ou CNPJ;</div>";
		}

		if( $("#responsible_name").val() == "" ){
			$("#responsible_name").parent().addClass('has-error');
			mensagem += "<div> - Nome do responsável;</div>";
		}

		if( $("#responsible_email").val() == "" ){
			$("#responsible_email").parent().addClass('has-error');
			mensagem += "<div> - Email do responsável;</div>";
		}

		if( $("#responsible_cellphone").val() == "" ){
			$("#responsible_cellphone").parent().addClass('has-error');
			mensagem += "<div> - Celular do responsável;</div>";
		}

		// if( $("#product_id").val() == "" ){
		// 	$("#product_id").parent().addClass('has-error');
		// 	mensagem += "<div> - Período de contratação</div>";
		// }

		if( $("#zip_code").val() == "" ){
			$("#zip_code").parent().addClass('has-error');
			mensagem += "<div> - CEP;</div>";
		}

		if(mensagem){
			bootbox.alert("<h5>Os campos abaixo são de preenchimento obrigatório:</h5>"+mensagem, function() {});
			$(".bootbox .modal-footer .btn-primary").html("Fechar");
			return false;
		}else{
			//alert('else');return false;
			//$(this).submit();
			$('#page1, #page2').toggle();
		}

		return false;
	})



	//-- Verifica se o CPF ou CNPJ digitado é válido
	$('#document').on('blur', function(){

		if ( valida_cpf_cnpj( this.value ) ) {
			return false;
		} else {
			bootbox.alert('CPF ou CNPJ inválido.');
			return false;
		}
	})

	$('#product_id').on('change', function(){

		if(this.value != '' && this.value != '1#0'){
			$('#salvar').text('Salvar cadastro e efetuar pagamento');
		}else{
			$('#salvar').text('Salvar cadastro');
		}
	})

	//-- Modifica "placeholder", classe da máscara e tamanho máximo permitido do campo CPF/CNPJ
	$('#professional_type').on('change', function(){

		if(this.value == 'F'){

			$('#document').addClass('cpf');
			$('#document').attr('placeholder', 'CPF do profissional')
			$('#document').attr('maxlength', '14')

		}else{
			$('#document').addClass('cnpj');
			$('#document').attr('placeholder', 'CNPJ da empresa')
			$('#document').attr('maxlength', '18')
		}

		return false;

	})




	$('.cep').blur(function(){
		var cep = $(this);
		num_cep = cep.val();

		num_cep = num_cep.replace(/[^\d]+/g, '')

		//alert(num_cep);

		if( num_cep != "" ){

			url = '/profile/busca_cep/' + num_cep;
			//console.log(url);
			$.ajax({
				url: url,
				type: 'GET',
				dataType: 'json',
				success: function (data) {

					 //console.log(data);
					// console.log(data != '0');
					if(data != '0') {
						//console.log('if');
						//$('#state').val(data.uf);
						//$('#city').val(data.cidade);
						$('#city').val(data.city_id);
						$('#city_name').val(data.cidade);
						$('#state').val(data.uf);
						$('#state_name').val(data.state_name);
						$('#neighborhood').val(data.bairro);
						$('#address').val(data.tipo_logradouro + ' ' + data.logradouro);
					}else{
						bootbox.alert("<p>CEP inválido</p>", function() {});
					}
				}
			});
		}

		return false;
	});

	//-- Calcula a soma do produto selecionado e do destaque
	$('#detach, #product_id').on('change', function(){
		//alert($(this).val());
		$selected_detach 		= ($('#detach option:selected').val() != '') ? $('#detach option:selected').val() : '0#0' ;
		$selected_product_id 	= ($('#product_id option:selected').val() != '') ? $('#product_id option:selected').val() : '0#0';

		$itens_detach 		= $selected_detach.split('#');
		$itens_product_id	= $selected_product_id.split('#');

		$detach_value 		= $itens_detach[1].replace(',', '.');
		$product_id_value 	= $itens_product_id[1].replace(',', '.');
//console.log($product_id_value);
		$total = parseFloat($detach_value) + parseFloat($product_id_value) ;
//console.log($total);
		$('#detached_selected').val($detach_value);
		$('#total').text(parseFloat($total, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString());
		//$('#total').text(this.replace('.',','));
//console.log(parseFloat($detach_value) + parseFloat($product_id_value));

	});

	// Máscaras
	$('.cep').mask('00.000-000');
	$('.telefone').mask('(00) 0000-00009');
	$('.cpf').mask('000.000.000-00', {reverse: true});
	$('.cnpj').mask('00.000.000/0000-00', {reverse: true});
	$('.money').mask('000.000.000.000.000,00', {reverse: true});
	$('.money2').mask("#.##0,00", {reverse: true});

});


var map = null;

function showlocation() {
	// One-shot position request.
	//navigator.geolocation.getCurrentPosition(callback, errorHandler,{timeout:10000});
	navigator.geolocation.getCurrentPosition(init_map, errorHandler,{timeout:10000});
}
//
//function callback(position) {
//	console.log(position.coords.latitude);
//
//	var lat = position.coords.latitude;
//	var lon = position.coords.longitude;
//
//	$('#latitude').val(position.coords.latitude);
//	$('#longitude').val(position.coords.longitude);
//
//	var latLong = new google.maps.LatLng(lat, lon);
//
//	var marker = new google.maps.Marker({
//		position: latLong
//	});
//
//	marker.setMap(map);
//	map.setZoom(8);
//	map.setCenter(marker.getPosition());
//
//	google.maps.event.addDomListener(window, 'load', initMap);
//	//google.maps.event.addDomListener(window, 'load', init_map);
//
//
//}
//
//function initMap() {
//	var mapOptions = {
//		center: new google.maps.LatLng(0, 0),
//		zoom: 1,
//		mapTypeId: google.maps.MapTypeId.ROADMAP
//	};
//	map = new google.maps.Map(document.getElementById("map-container"), mapOptions);
//
//}

function showResponse(responseText, statusText, xhr, $form)  {
	// for normal html responses, the first argument to the success callback
	// is the XMLHttpRequest object's responseText property

	// if the ajaxForm method was passed an Options Object with the dataType
	// property set to 'xml' then the first argument to the success callback
	// is the XMLHttpRequest object's responseXML property

	// if the ajaxForm method was passed an Options Object with the dataType
	// property set to 'json' then the first argument to the success callback
	// is the json data object returned by the server

	//retorno = jQuery.parseJSON(JSON.stringify(data));

	console.log(statusText);
	console.log(responseText);
	alert('status: ' + statusText + '\n\nresponseText: \n' + responseText +
		'\n\nThe output div should have already been updated with the responseText.');
}


function errorHandler(error) {
	switch(error.code) {
		case error.PERMISSION_DENIED:
			alert("O usuário negou acesso à sua localizacão.");
			break;
		case error.POSITION_UNAVAILABLE:
			alert("Informações de localização não disponíveis.");
			break;
		case error.TIMEOUT:
			alert("Tempo limite esgotado para receber os dados de lozalização.");
			break;
		case error.UNKNOWN_ERROR:
			alert("Um erro desconhecido ocorreu.");
			break;
	}
}




function init_map(position) {

	var lat = position.coords.latitude;
	var lon = position.coords.longitude;

	$('#latitude').val(position.coords.latitude);
	$('#longitude').val(position.coords.longitude);


	var var_location = new google.maps.LatLng(lat,lon);

	var var_mapoptions = {
		scrollwheel: false,
		center: var_location,
		zoom: 15,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};

	var var_marker = new google.maps.Marker({
		position: var_location,
		map: var_map});

	var var_map = new google.maps.Map(document.getElementById("map-container"),
		var_mapoptions);

	var_marker.setMap(var_map);

	google.maps.event.addDomListener(window, 'load', init_map);
}

//google.maps.event.addDomListener(window, 'load', init_map);

