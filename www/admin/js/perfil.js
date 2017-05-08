jQuery(document).ready(function(){

  jQuery('.acao-massa .ace').click(function(){
    
    var checked = jQuery(this).attr('checked');
    
    if( checked == undefined ){
      jQuery(this).attr("checked",true)      
      checked = jQuery(this).attr('checked');
    }else{
      if(checked){
        jQuery(this).attr("checked",false)      
      }else{
        jQuery(this).attr("checked",true)      
      }
      checked = jQuery(this).attr('checked');        
    }
    
    if( checked ){
      //jQuery(".sel .ace").attr('checked',true);
      jQuery(".sel .ace").click();
    }else{
      //jQuery(".sel .ace").attr('checked',false);
      jQuery(".sel .ace").click();
    }  
  });  

  $('.checkbox_sim_nao').click(function(){
    if( jQuery('.checkbox_sim_nao .tipo').hasClass('sim') ){
      jQuery('.checkbox_sim_nao .tipo').removeClass('sim');
      jQuery('.checkbox_sim_nao .tipo').addClass('nao');
    }else{
      jQuery('.checkbox_sim_nao .tipo').removeClass('nao');
      jQuery('.checkbox_sim_nao .tipo').addClass('sim');
    }
  });  
  // Remove item da lista
  jQuery(".remover-item-lista").click(function(){
    var item = jQuery(this);
    bootbox.confirm('Você tem certeza que deseja excluir?', function(result) {
      if(result) {
        item.parent().parent().parent().fadeOut(450);
      }
    });

    jQuery(".bootbox .modal-footer .btn-default").html("Cancelar");
    jQuery(".bootbox .modal-footer .btn-primary").html("Concluir");

    return false;
  });

  // Remove item aberto
  jQuery(".remover-item").click(function(){

    bootbox.confirm('Você tem certeza que deseja excluir o usuário "Fulano Beltrano"?', function(result) {
      if(result) {

      }
    });

    jQuery(".bootbox .modal-footer .btn-default").html("Cancelar");
    jQuery(".bootbox .modal-footer .btn-primary").html("Concluir");

    return false;
  });

  // Excluir item em massa
  jQuery(".excluir_massa").click(function(){

    bootbox.confirm("Você tem certeza que deseja excluir os 10 usuários selecionados?", function(result) {
      if(result) {

      }
    });

    jQuery(".bootbox .modal-footer .btn-default").html("Cancelar");
    jQuery(".bootbox .modal-footer .btn-primary").html("Concluir");
    return false;
  }); 
  // Valida formulário
  jQuery("form[name='frm']").on('submit', function(){

    var idFrom = $(this).attr("id");

    var mensagem = "";

    $('#'+idFrom+' input, #'+idFrom+' select').each(function(index){  
        var elemento = $(this);
        var nomeElemento = "";
        if( elemento.attr('required')=="true" && elemento.val() == "" ){
          nomeElemento = elemento.parent().parent().children("label").html();
          nomeElemento = nomeElemento.replace("*","");
          mensagem += "<div> - " + nomeElemento + ";</div>";
        }
        // alert(
        //   ' Name: ' + elemento.attr('name') + 
        //   '\n Type: ' + elemento.attr('type') + 
        //   '\n Value: ' + elemento.val() +
        //   '\n Required: ' + elemento.attr('require')
        // );  
      }
    );


    if(mensagem){
      mensagem = mensagem.replace(" *","");
      mensagem = mensagem.replace("*","");
      
      bootbox.alert("<p>Os campos abaixo são de preenchimento obrigatório:</p>"+mensagem, function() {});   
      jQuery(".bootbox .modal-footer .btn-primary").html("Fechar");
      return false;
    }

    
  })


  // jQuery("#usuario-certificadora").click(function(){
  //   jQuery("#entidade").removeAttr("disabled");
  //   jQuery(".check-admin input").attr("disabled","disabled");
  // });

  // jQuery("#usuario-administrador").click(function(){
  //   jQuery("#entidade").attr("disabled","disabled");
  //   jQuery(".check-admin input").removeAttr("disabled");
  // });

  // jQuery("#usuario-portal").click(function(){
  //   jQuery("#entidade").attr("disabled","disabled");
  //   jQuery(".check-admin input").attr("disabled","disabled");
  // });  

  // Regras ao selecionar o perfil
  jQuery("#perfil").change(function(){

    var $this = jQuery(this);
    console.log($this.val());

    if( $this.val() == 1 ){ // Adminsitrador
      console.log("Adminsitrador");
      
      jQuery("#ckcriarobjetos, #ckchancelarobjetos").removeAttr("disabled");
      jQuery("#ckcriarobjetos").click();
      jQuery("#ckchancelarobjetos").click();
      jQuery("#ckcriarobjetos, #ckchancelarobjetos").attr("disabled","disabled");
      jQuery("#todas_entidades_certificadoras").attr("selected","selected");
      jQuery("#regiao").attr("disabled","disabled");

      jQuery(".check-admin input").removeAttr("disabled");
      jQuery(".check-admin input").click();
      jQuery(".check-admin input").attr("disabled","disabled");

    }else if( $this.val() > 1 ){ // CFMV

      jQuery("#ckcriarobjetos").attr("checked",false);
      jQuery("#ckchancelarobjetos").attr("checked",false);
      jQuery("#ckcriarobjetos, #ckchancelarobjetos, .check-admin input").removeAttr("disabled");
      jQuery(".check-admin input").removeAttr("disabled");
      jQuery(".check-admin input").attr("checked",false);
      jQuery("#todas_entidades_certificadoras").removeAttr("selected");

      jQuery("#ckcriarobjetos").removeAttr("disabled");
      jQuery("#ckchancelarobjetos").removeAttr("disabled");

      if( $this.val() == 200 ){
        jQuery("#regiao").removeAttr("disabled");
      }else{
        jQuery("#regiao").attr("disabled","disabled");
      }

    }else{
      
      jQuery("#ckcriarobjetos, #ckchancelarobjetos, .check-admin input").removeAttr("disabled");
      jQuery("#ckcriarobjetos").click();
      jQuery("#ckchancelarobjetos").click();
      jQuery(".check-admin input").click();
      jQuery("#ckcriarobjetos, #ckchancelarobjetos, .check-admin input").attr("disabled","disabled");
      jQuery("#regiao").attr("disabled","disabled");


      jQuery("#todas_entidades_certificadoras").removeAttr("selected");
      
    }

  })

  jQuery("#ckchancelarobjetos").click(function(){
    if( jQuery("#perfil").val() > 1 ){
      if( jQuery("#entidade").attr("disabled") ){
        jQuery("#entidade").removeAttr("disabled");
      }else{
        jQuery("#entidade").attr("disabled","disabled");
      }  
        
    }
  })


});  
