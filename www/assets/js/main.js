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


	//Activate current menu
	jQuery("*").find("li > a[href='/"+ $('body').data('page') +"']").each(function(){
		$('li').removeClass('active');
		$(this).parent().addClass("active");
	})

	//$('#page1').show();
	//$('#page2').hide();

	$('#proximapg').click(function(){
	//$('#voltapg').click(function(){

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




	$('#document').on('blur', function(){

		//if(valCpf(this.value)){
		//	return false;
        //
		//}else{
		//	bootbox.alert('CPF inválido.');
		//	return false;
		//}
		if ( valida_cpf_cnpj( this.value ) ) {
			return false;
		} else {
			bootbox.alert('CPF ou CNPJ inválido.');
			return false;
		}
	})



	$('#professional_type').on('change', function(){

		if(this.value == 'PF'){
			$('#cpf_cnpj').addClass('cpf');
			$('#cpf_cnpj').attr('placeholder', 'CPF do profissional')
			$('#cpf_cnpj').attr('maxlength', '14')

		}else{
			$('#cpf_cnpj').addClass('cnpj');
			$('#cpf_cnpj').attr('placeholder', 'CNPJ da empresa')
			$('#cpf_cnpj').attr('maxlength', '18')
		}

		return false;

	})




	$('.cep').blur(function(){
		var cep = $(this);
		num_cep = cep.val();

		num_cep = num_cep.replace(/[^\d]+/g, '')


		//alert(num_cep);

		if( num_cep == "" ){
			// nao faz nada a pedido do robson
			// }else if( num_cep.length < 10 ){
			//   bootbox.alert("<p class='lead blue'>Notificação</p><p>CEP inválido</p>", function() {});
			//   cep.val('');
		}else{

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

