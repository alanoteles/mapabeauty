$(document).ready(function(){

  // Valida formulário
  $('.salvar').on('click',function(e){

    //e.preventDefault();
    // var idFrom = $(this).attr("id");

    var mensagem = "";


    if( $("#description").val() == "" ){
      $("#description").parent().addClass('has-error');
      mensagem += "<div> - Produto;</div>";
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

});  
