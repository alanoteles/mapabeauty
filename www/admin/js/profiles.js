$(document).ready(function(){


  // Gerar nova senha
  $(".gerar-nova-senha").click(function(){


    url = '/admin/usuarios/nova_senha';
    id  = $('#user_id').val();

    $.ajax({
      url: url,
      type: 'GET',
      data: {'id': id},
      success: function (data) {

        console.log(data);



      }
    });

    bootbox.alert('Uma nova senha foi gerada e enviada para o email "' + $('#responsible_email').val() + '" do usuário "' + $('#responsible_name').val() + '".', function() {});

    return false;
  });  
  



  // Valida formulário
  $('.salvar').on('click',function(){

    // var idFrom = $(this).attr("id");

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

    if( $("#zip_code").val() == "" ){
      $("#zip_code").parent().addClass('has-error');
      mensagem += "<div> - CEP;</div>";
    }

    if( $("#state_name").val() == "" ){
      $("#state_name").parent().addClass('has-error');
      mensagem += "<div> - Estado;</div>";
    }

    if( $("#city_name").val() == "" ){
      $("#city_name").parent().addClass('has-error');
      mensagem += "<div> - Cidade;</div>";
    }

    if( $("#neighborhood").val() == "" ){
      $("#neighborhood").parent().addClass('has-error');
      mensagem += "<div> - Bairro;</div>";
    }

    if( $("#address").val() == "" ){
      $("#address").parent().addClass('has-error');
      mensagem += "<div> - Endereço;</div>";
    }

    if( $("#fantasy_name").val() == "" ){
      $("#fantasy_name").parent().addClass('has-error');
      mensagem += "<div> - Nome de fantasia;</div>";
    }

    if( $("#number").val() == "" ){
      $("#number").parent().addClass('has-error');
      mensagem += "<div> - Número;</div>";
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
      $(this).submit();
      //$('#page1, #page2').toggle();
    }


  })

  $(".abrir-boxfile").click(function(){
    $(this).parent().children("input").click();
  })

    $(".ace-file-input input").change(function(){
    var nome_arquivo = $(this).val();
    $(".ace-file-input .file-name").attr("data-title",nome_arquivo);
  })



  $('.date-picker').datepicker({autoclose:true}).next().on(ace.click_event, function(){
    $(this).prev().focus();
  });

});  
