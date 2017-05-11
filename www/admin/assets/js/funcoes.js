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


  jQuery("#addArea").click(function(){
    jQuery(".area-tags").append( '<span class="tag" id="10">'+ jQuery("#form-field-area").val() +'<button type="button" class="close" onClick="removeTag(10)">×</button></span>' );
    jQuery("#form-field-area").val('');
    
    return false;
  })


  jQuery("#closed-dica").click(function(){
    jQuery("#area-dica").slideUp(450);
    return false;
  })

  jQuery(".banco-curriculo-pesquisa #pesquisaAC").click(function(){
    jQuery(".banco-curriculo-pesquisa a").removeClass("active");
    jQuery(".banco-curriculo-pesquisa a").removeClass("inactive");

    jQuery(".banco-curriculo-pesquisa #pesquisaAC").addClass("active");
    jQuery(".banco-curriculo-pesquisa #pesquisaC").addClass("inactive");

    jQuery("#area-pesquisa-c").slideUp(250);
    setTimeout(function(){
      jQuery("#area-pesquisa-ac").slideDown(250);
    },350);
    return false;
  });

  jQuery(".banco-curriculo-pesquisa #pesquisaC").click(function(){
    jQuery(".banco-curriculo-pesquisa a").removeClass("active");
    jQuery(".banco-curriculo-pesquisa a").removeClass("inactive");

    jQuery(".banco-curriculo-pesquisa #pesquisaC").addClass("active");
    jQuery(".banco-curriculo-pesquisa #pesquisaAC").addClass("inactive");

    jQuery("#area-pesquisa-ac").slideUp(250);
    setTimeout(function(){
      jQuery("#area-pesquisa-c").slideDown(250);
    },350);   
    return false;
  });  

  jQuery("select.loc-cliente").change(function(){
    jQuery(".labels label.hide").removeClass("hide");
    jQuery(".labels label.exibir").addClass("hide");
    
    //alert("teste");

    return false;
  });  

  jQuery("select.loc-pacote").change(function(){
    jQuery(".labels2 label.hide").removeClass("hide");
    jQuery(".labels2 label.exibir").addClass("hide");
    
    //alert("teste");

    return false;
  }); 
  

  jQuery("select.loc-pacote-produtos").change(function(){
    jQuery(".labels-produtos label.hide").removeClass("hide");
    jQuery(".labels-produtos label.exibir").addClass("hide");
    
    jQuery("#inc-prod-pacote").removeClass("hide");
    //alert("teste3");

    return false;
  }); 


  jQuery("#inc-prod-pacote").click(function(){
    
    jQuery(".produtos-adicionados tbody tr.line-marc").addClass("hide");

    jQuery(".produtos-adicionados tbody").append("\
        <tr>\
            <td class='col-xs-6'>Lorem ipsum dolor est sit amet</td>\
            <td class='col-xs-1'>1.250,00</td>\
            <td class='col-xs-2'>1.100,00</td>\
            <td class='col-xs-1'>Curso</td>\
            <td class='col-xs-1'><button class='btn btn-xs btn-grey btn'><i class='icon-trash no-margin'></i></button></td>\
        </tr>\
      ");
    

    return false;
  }); 



  jQuery("input#arquivosPacote").change(function(){
    jQuery("#arquivo-selecionado").html( "nome do arquivo.png (1.2 MB)" );
    jQuery("#area-upload-img .area-img").html("<img src='uploads/u159.jpg'>"  );
    jQuery("#area-upload-img .area-img").css({"border": "1px solid #bbb"});
    jQuery("#bntBotoesGaleria a").removeClass("hide");
    jQuery("#bntBotoesGaleria button").removeClass("hide");
    return false;
  }); 
  

  jQuery("#bntBotoesGaleria button.cancelar").click(function(){
    jQuery("#arquivo-selecionado").html( "nenhum arquivo selecionado" );
    jQuery("#area-upload-img .area-img").html("<img src='assets/images/marc-imagem.jpg'>"  );
    jQuery("#area-upload-img .area-img").css({"border": "none"});
    jQuery("#bntBotoesGaleria button").addClass("hide");
    return false;
  }); 
  
  jQuery("#bntBotoesGaleria button#inc-img-galeria").click(function(){
    jQuery(".area-progress-upload-img").show();

         

    jQuery(".area-progress-upload-img .progress-upload-img").animate({
      width: "100%"
    },1500)
    
    setTimeout(function(){
      jQuery(".img-marc-thumb").addClass("hide");
      jQuery(".ace-thumbnails").removeClass("hide");
    },1500);
    
    return false;
  });   


  jQuery(".area-progress-upload-img .cancelar-upload-progess").click(function(){
    jQuery("#arquivo-selecionado").html( "nenhum arquivo selecionado" );
    jQuery("#area-upload-img .area-img").html("<img src='assets/images/marc-imagem.jpg'>"  );
    jQuery("#area-upload-img .area-img").css({"border": "none"});
    jQuery("#bntBotoesGaleria button").addClass("hide");
    jQuery(".area-progress-upload-img").addClass("hide");
    jQuery(".img-marc-thumb").removeClass("hide");
    jQuery(".ace-thumbnails").addClass("hide");    
    return false;
  });   

  
});


function removeTag(tag){
  jQuery("#"+tag).hide();
}