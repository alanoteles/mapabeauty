$(document).ready(function(){


  // Gerar nova senha
  $(".gerar-nova-senha").click(function(){


    url = '/pt_br/admin/usuarios/nova_senha';
    id  = $('#user_id').val();

    $.ajax({
      url: url,
      type: 'GET',
      data: {'id': id},
      success: function (data) {

        console.log(data);



      }
    });

    bootbox.alert('Uma nova senha foi gerada e enviada para o email "' + $('#email').val() + '" do usuário "' + $('#name').val() + '".', function() {});

    return false;
  });  
  


  //
  //// Valida formulário
  //$("form[name='frm']").on('submit', function(){
  //
  //  // var idFrom = $(this).attr("id");
  //
  //  var mensagem = "";
  //
  //
  //  if($("#email").val() != $("#email_confirm").val()){
  //    mensagem += "<div> - Os E-mails digitados não são iguais;</div>";
  //
  //    bootbox.alert("<p>Erro no preenchimento do campo e-mail:</p>"+mensagem, function() {});
  //    $(".bootbox .modal-footer .btn-primary").html("Fechar");
  //
  //    return false;
  //  }
  //
  //
  //  var ativo = true;
  //  if( $("#user_group_id").val() == "" ){
  //    mensagem += "<div> - Grupo;</div>";
  //    mensagem = mensagem.replace(" *","");
  //    mensagem = mensagem.replace("*","");
  //  }
  //
  //  if( $("#email").val() == "" ){
  //    mensagem += "<div> - E-mail;</div>";
  //    mensagem = mensagem.replace(" *","");
  //    mensagem = mensagem.replace("*","");
  //  }
  //
  //  if( $("#email_confirm").val() == "" ){
  //    mensagem += "<div> - E-mail de confirmação;</div>";
  //    mensagem = mensagem.replace(" *","");
  //    mensagem = mensagem.replace("*","");
  //  }
  //
  //
  //  if( $("#name").val() == "" ){
  //    mensagem += "<div> - Nome;</div>";
  //    mensagem = mensagem.replace(" *","");
  //    mensagem = mensagem.replace("*","");
  //    ativo = false;
  //  }else{
  //    tituloAux = $("#name").val();
  //    tituloAux = tituloAux.split(" ");
  //    //console.log(tituloAux.length);
  //    if(tituloAux.length < 2){
  //      mensagem += "- Digite o nome completo.\n";
  //      ativo = false;
  //    }else if(tituloAux[0] == "" || tituloAux[1] == "" ){
  //      mensagem += "- Digite o nome completo.\n";
  //      ativo = false;
  //    }
  //  }
  //
  //
  //  if( $("#document").val() == "" ){
  //    mensagem += "<div> - CPF;</div>";
  //    mensagem = mensagem.replace(" *","");
  //    mensagem = mensagem.replace("*","");
  //    ativo = false;
  //  }
  //
  //
  //
  //  if( $("#locale").val() == "" ){
  //    mensagem += "<div> - Idioma;</div>";
  //    mensagem = mensagem.replace(" *","");
  //    mensagem = mensagem.replace("*","");
  //    ativo = false;
  //  }
  //
  //  if( $("#ddd").val() == "" ){
  //    mensagem += "<div> - DDD;</div>";
  //    mensagem = mensagem.replace(" *","");
  //    mensagem = mensagem.replace("*","");
  //    ativo = false;
  //  }
  //
  //
  //  if( $("#mobile_phone").val() == "" ){
  //    mensagem += "<div> - Telefone;</div>";
  //    mensagem = mensagem.replace(" *","");
  //    mensagem = mensagem.replace("*","");
  //    ativo = false;
  //  }
  //
  //  if( $("#zip").val() == "" ){
  //    mensagem += "<div> - CEP;</div>";
  //    mensagem = mensagem.replace(" *","");
  //    mensagem = mensagem.replace("*","");
  //    ativo = false;
  //  }
  //
  //  if( $("#neighborhood").val() == "" ){
  //    mensagem += "<div> - Bairro;</div>";
  //    mensagem = mensagem.replace(" *","");
  //    mensagem = mensagem.replace("*","");
  //    ativo = false;
  //  }
  //
  //  if( $("#address").val() == "" ){
  //    mensagem += "<div> - Endereço;</div>";
  //    mensagem = mensagem.replace(" *","");
  //    mensagem = mensagem.replace("*","");
  //    ativo = false;
  //  }
  //
  //  if( $("#number").val() == "" ){
  //    mensagem += "<div> - Número;</div>";
  //    mensagem = mensagem.replace(" *","");
  //    mensagem = mensagem.replace("*","");
  //    ativo = false;
  //  }
  //
  //  if( $("#schooling_id").val() == "" ){
  //    mensagem += "<div> - Escolaridade;</div>";
  //    mensagem = mensagem.replace(" *","");
  //    mensagem = mensagem.replace("*","");
  //    ativo = false;
  //  }
  //
  //  if( $("#occupation").val() == "" ){
  //    mensagem += "<div> - Profissão;</div>";
  //    mensagem = mensagem.replace(" *","");
  //    mensagem = mensagem.replace("*","");
  //    ativo = false;
  //  }
  //
  //  if( $("#employer").val() == "" ){
  //      mensagem += "<div> - Instituição empregadora;</div>";
  //    mensagem = mensagem.replace(" *","");
  //    mensagem = mensagem.replace("*","");
  //    ativo = false;
  //  }
  //
  //
  //
  //
  //
  //  if(mensagem){
  //    if(ativo){
  //      bootbox.alert("<p>Os campos abaixo são de preenchimento obrigatório:</p>"+mensagem, function() {});
  //      $(".bootbox .modal-footer .btn-primary").html("Fechar");
  //    }else{
  //      bootbox.alert("<p>Os campos abaixo são de preenchimento obrigatório:</p>"+mensagem, function() {});
  //      $(".bootbox .modal-footer .btn-primary").html("Fechar");
  //    }
  //
  //    $(".bootbox .modal-footer .btn-primary").html("Fechar");
  //    return false;
  //  }
  //
  //})
  //
  //$(".abrir-boxfile").click(function(){
  //  $(this).parent().children("input").click();
  //})
  //
  //  $(".ace-file-input input").change(function(){
  //  var nome_arquivo = $(this).val();
  //  $(".ace-file-input .file-name").attr("data-title",nome_arquivo);
  //})
  //
  //$('.cep').blur(function(){
  //  var cep = $(this);
  //  num_cep = cep.val();
  //
  //  num_cep = num_cep.replace(/[^\d]+/g, '')
  //
  //
  //    //alert(num_cep);
  //
  //  if( num_cep == "" ){
  //    // nao faz nada a pedido do robson
  //  // }else if( num_cep.length < 10 ){
  //  //   bootbox.alert("<p class='lead blue'>Notificação</p><p>CEP inválido</p>", function() {});
  //  //   cep.val('');
  //  }else{
  //
  //      url = '/pt_br/admin/usuarios/busca_cep';
  //      console.log(url);
  //      $.ajax({
  //          url: url,
  //          type: 'GET',
  //          data: {'cep': num_cep},
  //          dataType: 'json',
  //          success: function (data) {
  //
  //              console.log(data);
  //              if(data != '0') {
  //                  $('#state').val(data.uf);
  //                  $('#city').val(data.cidade);
  //                  $('#neighborhood').val(data.bairro);
  //                  $('#adderss').val(data.logradouro);
  //              }else{
  //                  bootbox.alert("<p>CEP inválido</p>", function() {});
  //              }
  //
  //
  //
  //          }
  //      });
  //
  //
  //
  //  }
  //
  //});
  //
  //$('.date-picker').datepicker({autoclose:true}).next().on(ace.click_event, function(){
  //  $(this).prev().focus();
  //});

});  
