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

	$('#salvar').on('click',function(){
		$('#form').attr('action', 'profile');
		$('#form').submit();
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
		service_price 	= ($('#price').val() != '') ? $('#price').val() : 'Sob consulta';

		console.log(service_price);

		record = {"id":service_id, "price":service_price};

		if ($('#services').val() != '') {
			data.rows 					= jQuery.parseJSON(($('#services').val()))
			data.rows[data.rows.length] = record;

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

		img = item.parent().parent().find('td').eq(0).find('a').attr('data-file');

		hash = img.substr(0, img.length - 4);

		data = jQuery.parseJSON(($('#uploads').val()));

		index_removed = '';

		$.each(data, function(index, value) {
			x = jQuery.parseJSON(JSON.stringify(value));

			if(x.hash == hash){
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

		if($(this).attr('action') != 'profile'){

			e.preventDefault();

			$.ajax({
				url: "/profile/uploadAnexo",
				type: "POST",
				data: new FormData(this),
				contentType: false,
				cache: false,
				processData: false,
				success: function (data) {
					retorno = data.file_info_uploaded;

					if ($('#uploads').val() != '') {
						data.rows = jQuery.parseJSON(($('#uploads').val()))
						data.rows[data.rows.length] = retorno;

						//console.log(data.rows);
						$('#uploads').val(JSON.stringify(data.rows));

					} else {
						//console.log(retorno);
						data = {
								rows: [
									retorno
								]
						};
						//data.rows[0] = retorno;
						$('#uploads').val(JSON.stringify(data.rows));
					}

					//-- Mount table with images
					$('.fotos-cadastro').find('tr').remove();

					$.each(data.rows, function(name, value) {

						logo = (value['logo'] == '1') ? 'Logo' : '';
						$('.fotos-cadastro > tbody').append(
							'<tr>' +
								'<td  class="col-sm-2" style="vertical-align:middle">' +
									'<a class="myModal" data-toggle="modal" data-target="#myModal" data-file="' + value['hash'] + '.'+ value['extension'] +'">' +
									'<img src="' + value['path'] + value['hash'] + '.'+ value['extension'] + '" alt="">' +
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

					//console.log($('#uploads').val());
				},
				error: function (data) {
					retorno = jQuery.parseJSON(JSON.stringify(data));

					bootbox.alert(retorno.responseJSON, function () {
					});
					$(".bootbox .modal-footer .btn-primary").html("Fechar");
					return false;
				}
			});
			return false;
		}

	}));


	//Activate current menu
	jQuery("*").find("li > a[href='/"+ $('body').data('page') +"']").each(function(){
		$('li').removeClass('active');
		$(this).parent().addClass("active");
	})

	//$('#page1').show();
	//$('#page2').hide();

	$('#proximapg').click(function(){
	//$('#voltapg').click(function(){
//$('#page1, #page2').toggle();
//return false;

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

		//if( $("#responsible_cellphone").val() == "" ){
		//	$("#responsible_cellphone").parent().addClass('has-error');
		//	mensagem += "<div> - Celular do responsável;</div>";
		//}

		if( $("#product_id").val() == "" ){
			$("#product_id").parent().addClass('has-error');
			mensagem += "<div> - Período de contratação</div>";
		}

		if( $("#cep").val() == "" ){
			$("#cep").parent().addClass('has-error');
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



	//-- Modifica "placeholder", classe da máscara e tamanho máximo permitido do campo CPF/CNPJ
	$('#professional_type').on('change', function(){

		if(this.value == 'PF'){

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
			console.log(url);
			$.ajax({
				url: url,
				type: 'GET',
				dataType: 'json',
				success: function (data) {

					console.log(data);
					console.log(data != '0');
					if(data != '0') {
						console.log('if');
						//$('#state').val(data.uf);
						$('#city').val(data.cidade);
						$('#state').val(data.state_name);
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

