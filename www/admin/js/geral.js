jQuery(document).ready(function(){

    //Verifica se o campo existe e desabilita.
    if($('#fileupload_translation').length){
        $('#fileupload_translation').attr('disabled',true);
        $('#visualizar_trad').hide();
    }

    //Upload de imagem via CKEditor
    $('#content_data').on('fileUploadRequest', function(e){
        e.preventDefault();

        alert(e.data);

    });


    //URL atual, incluindo porta e protocolo
    var url = window.location.href;
    url = url.split('/');
    url = url[0]+'//'+url[2];

    //Selecionar todos checkbox
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

    //$(".valor").mask("999.999.999,99",{placeholder:" "});
    $('.valor').mask('000.000.000.000.000,00', {reverse: true});
    $('.cep').mask('00.000-000');
    $('.telefone').mask('0000-00009');
    $('.ddd').mask('00');
    $('.cpf').mask('999.999.999-99');


    //Definindo formato padrão para datepicker
    $('.data').datepicker({
        format: 'dd/mm/yyyy',
        language: 'pt-BR',
        autoclose:true
    });
    //Formato padrão para daterangepicker
    $('input.date-range-picker').daterangepicker({
        timePicker: false,
        format: 'DD/MM/YYYY',
        locale: {
            applyLabel: 'Aplicar',
            cancelLabel: 'Cancelar',
            fromLabel: "Data início",
            toLabel: "Data fim",
            "customRangeLabel": "Custom",
            "daysOfWeek": [
                "Do",
                "Se",
                "Te",
                "Qu",
                "Qu",
                "Se",
                "Sa"
            ],
            "monthNames": [
                "Janeiro",
                "Fevereiro",
                "Março",
                "Abril",
                "Maio",
                "Junho",
                "Julho",
                "Agosto",
                "Setembro",
                "Outubro",
                "Novembro",
                "Dezembro"
            ],
            "firstDay": 1
        }
    }).prev().on(ace.click_event, function(){
        $(this).next().focus();
    });
    $('.date-picker').datepicker({autoclose:true }).next().on(ace.click_event, function(){
        $(this).prev().focus();
    });

    //-- Essa rotina ajusta um problema que o multi-idiomas causa nos links, duplicando-os.
    $('a').each(function () {

        if ($(this).attr('data-route')) {
            var link = '/' + $('#app_locale').val() + $(this).data('route');
            $(this).attr('href', link);
        }

    })



    $('.status').on('change', function (e) {

        e.preventDefault();
        var model       = $('#model').val();
        var id          = $(this).data('id');


        if(window.location.pathname.indexOf('pesquisa') > 0) {
            url = window.location.pathname.replace('/pesquisa', '') ;
        }else{
            url = window.location.pathname;
        }

        url = url +  '/' + id;


        $.ajax({
            url: url,
            type: 'PUT',
            data: {model: model},
            dataType: 'json'
        });
    });




    $('.excluir, .remover-item').on('click', function (e) {

        e.preventDefault();
        var model       = $('#model').val();
        var id          = $(this).data('id');

        if(window.location.pathname.indexOf('pesquisa') > 0) {
            url = window.location.pathname.replace('/pesquisa', '') ;
        }else if(window.location.pathname.indexOf('edit') > 0) {

            if(window.location.pathname.indexOf('editoria-da-noticia') > 0){ //-- Como o critério de busca é 'edit', a url ficava errada. Por isso o hard-coded.
                url = '/pt_br/admin/tabelas-de-apoio/editoria-da-noticia';
            }else {
                url = window.location.pathname.substring(0, window.location.pathname.indexOf('/edit'));
            }

        }else{

            url = window.location.pathname;

        }

        url_limpa   = url;
        if(id != undefined) {
            if (isNaN(parseInt(url.substr(-1)))){ //-- Se o último caracter na url não for um número, adiciona o id do registro.
                url = url + '/' + id;
            }else{
                url_limpa = url.substring(0,url.lastIndexOf('/'));
            }
        }else{
            url_limpa = url.substring(0,url.lastIndexOf('/'));
        }


        bootbox.confirm("Confirma a EXCLUSÃO desse registro ?", function(result) {

            if(result){

                $.ajax({
                    url: url,
                    type: 'DELETE',
                    data: {model: model},
                    dataType: 'json',
                    success: function (data) {
                        window.location.href = url_limpa;
                    }
                });
            }
        });

    });


    $('.checkbox_sim_nao').click(function(){
        if( $('.checkbox_sim_nao .tipo').hasClass('sim') ){
            $('.checkbox_sim_nao .tipo').removeClass('sim');
            $('.checkbox_sim_nao .tipo').addClass('nao');

            $('#status').val('0');
        }else{
            $('.checkbox_sim_nao .tipo').removeClass('nao');
            $('.checkbox_sim_nao .tipo').addClass('sim');

            $('#status').val('1');
        }
    });


    //$( ".data" ).datepicker({
    //    showOtherMonths: true,
    //    selectOtherMonths: false,
    //    dateFormat: "dd/mm/yy"
    //
    //});

    $('input.date-range-picker').daterangepicker({
        timePicker: false,
        locale: {
            format: 'DD/MM/YYYY',
            applyLabel: 'Aplicar',
            cancelLabel: 'Cancelar',
            fromLabel: "Data início",
            toLabel: "Data fim"
        }
    }).prev().on(ace.click_event, function(){
        $(this).next().focus();
    });
    $('.date-picker').datepicker({autoclose:true }).next().on(ace.click_event, function(){
        $(this).prev().focus();
    });

    //$("button.applyBtn").html("Aplicar");
    //$("button.cancelBtn").html("Cancelar");





    //-- Busca de Objetos/Anexos do Admin --//
    if(window.location.href.indexOf('/edit') > 0 || window.location.href.indexOf('create') > 0) { //-- Só vai capturar os clicks no form de edição. Sem isso, ele pega os clicks da paginação do index.
        $('body').on('click', '#btn_pesquisa_objetos, .pagination li a', function (event) {

            //console.log($(e.target));
            event.preventDefault();
            var palavra_chave = $('#palavra_chave_objetos').val();
            var linha = $("#linha").find(":selected").val();
            var tema = $("#tema").find(":selected").val();
            var subtema = $("#subtema").find(":selected").val();
            var url = "/pt_br/biblioteca-busca";


            //-- Identifica de onde veio o click
            if ($(event.target).is('#btn_pesquisa_objetos')) { //-- Botão LOCALIZAR
                tipo = 'POST';
            } else {
                if ($(event.target).is('.pagination li a')) { //-- Botão de paginação do resultado
                    url += '?' + $(this).attr('href').split("?").pop();
                    tipo = 'GET';
                }
            }

            $.ajax({
                url: url,
                type: tipo,
                data: {'termo': palavra_chave, 'linha': linha, 'tema': tema, 'subtema': subtema, 'admin': '1'},
                dataType: 'json',
                success: function (data) {

                    $('#busca_anexos').find('div').remove();
                    $('#busca_anexos').append(data.resultados);

                }
            });

        });
    }


    //-- Adiciona anexo à lista (como os elementos foram adicionados dinamicamente via AJAX, é preciso usar um event delegate para capturar o click.) --//
    $(document).on('click', "a.add-item-table", function(e) {
        e.preventDefault();

        $(".bootbox .modal-footer .btn-default").html("Não");
        $(".bootbox .modal-footer .btn-primary").html("Sim");


        var item = $(this);
        tr = item.parent().parent(); //-- Objeto clicado para ser anexado.
        array_anexos = $('#array_anexos').val();


        if((array_anexos.indexOf(tr.data('id')) != -1)){
            bootbox.alert('Esse objeto já está anexado.');
            return false;

        }else{
            bootbox.confirm('Você tem certeza que deseja adicionar o item selecionado?', function(result) {
                if(result) {

                    anexos_ids = [array_anexos];

                    linha = '';
                    linha += '<tr data-id="' + tr.data('id') + '" class="anexos">';
                    linha += '  <td class="col-xs-3">' + tr.find('td').eq(0).text() + '</td>'; //-- Título
                    linha += '  <td class="col-xs-3">' + tr.find('td').eq(1).text() + '</td>'; //-- Linha
                    linha += '  <td class="col-xs-3">' + tr.find('td').eq(2).text() + '</td>'; //-- Tema
                    linha += '  <td class="col-xs-2">' + tr.find('td').eq(3).text() + '</td>'; //-- Subtema
                    linha += '  <td class="col-xs-1 align-center">';
                    linha += '    <button type="button" class="btn btn-xs btn-grey btn remover-item-table"><i class="icon-trash no-margin"></i></button>';
                    linha += '  </td>';
                    linha += '</tr>';

                    $("#objetos_anexados").append(linha);

                    anexos_ids[anexos_ids.length] = tr.data('id');
                    $('#array_anexos').val(anexos_ids.join(','));

                }
            });

        }

        return false;
    });





    // Remove anexo da lista
    $(document).on('click', ".remover-item-table", function(e) {
        var item = $(this);
        bootbox.confirm('Você tem certeza que deseja excluir o item selecionado?', function(result) {
            if(result) {
                item.parent().parent().remove();

                anexos_ids = [];
                $('.anexos').each(function(){
                    anexos_ids[anexos_ids.length] = $(this).data('id');
                })
                $('#array_anexos').val(anexos_ids.join(','));
            }
        });

        $(".bootbox .modal-footer .btn-default").html("Cancelar");
        $(".bootbox .modal-footer .btn-primary").html("Concluir");

        return false;
    });



    //-- Retorna os temas relacionados às linhas para preencher os select boxes do "Localizar Arquivos"
    $('#linha').on('change', function () {

        id = parseInt($(this).find(":selected").val());
        $('#subtema').attr('disabled', true);

        $.ajax({
            url: url + '/pt_br/linhas-busca',
            type: 'POST',
            data: {id: id},
            dataType: 'json',
            success: function (data) {

                $('#tema').attr('disabled', false);
                $('#tema').children('option:not(:first)').remove();

                $.each(data, function(name, value){

                    $('#tema').append( '<option value="' + value['id'] + '">' + value['title'] + '</option>' );

                });
            }
        });
    });


    //-- Retorna os subtemas relacionados aos temas para preencher os select boxes do "Localizar Arquivos"
    $('#tema').on('change', function () {

        id = parseInt($(this).find(":selected").val());

        $.ajax({
            url: url + '/pt_br/temas-busca',
            type: 'POST',
            data: {id: id},
            dataType: 'json',
            success: function (data) {

                $('#subtema').attr('disabled', false);
                $('#subtema').children('option:not(:first)').remove();

                $.each(data, function(name, value){

                    $('#subtema').append( '<option value="' + value['id'] + '">' + value['title'] + '</option>' );

                });
            }
        });
    });



    $('.visualizar, .visualizar_trad').on('click', function (e) {

        e.preventDefault();
        var url = '/' + $('#app_locale').val() + $(this).data('link');

        window.location = url;

    });





    //--    Dialog Tradução
    //--    É necessário que a DIV que contém o "icon_dialog.png" tenha a classe "dialog-traducao" e o id
    //--  do campo seja o mesmo do campo INPUT ou TEXTAREA original acrescido de "_trad". Ex.: comment e comment_trad
    $( ".dialog-traducao" ).on('click', function(e) {
        e.preventDefault();

        if( this.$ === undefined ){
            this.$ = $( this );
        }

        var data = this.$.data( 'IBA' );

        campo_trad      = $(this).parent().find('div').eq(0).find('input, textarea').attr('id');
        campo_original  = campo_trad.substring(0, campo_trad.indexOf('_trad'));
        campo_tipo      = $('#' + campo_trad)[0].tagName;


        if(campo_tipo.toUpperCase() == 'INPUT' || (campo_tipo.toUpperCase() == 'TEXTAREA' && !$('#' + campo_trad).hasClass('ckeditor')) ){

            campo_label = $(this).parent().find('label').text();

        }else if(campo_tipo.toUpperCase() == 'TEXTAREA' && $('#' + campo_trad).hasClass('ckeditor')){

            //-- Nos campos CKEditor não existe o "label" com o nome do campo. É um "h3".

            if( data === undefined ){

                data = { $wrapper : this.$.parents( '.form-group' ) };
                data.$title = data.$wrapper.prev( 'h3' ).first();
                data.$text = data.$wrapper.find( 'textarea' ).first();

                this.$.data( 'IBA', data );

            }
            campo_label = data.$title.html().trim();
        }
        var dialog = $( "#dialog-message" ).removeClass('hide').dialog({
            title: campo_label.replace('*','')
        });
        $( "#dialog-message" ).removeClass('hide');

        $("#dialog-message").html('');
        $("#dialog-message").html($('#' + campo_original).val());


        $(".ui-widget-overlay").hide();
    });






    //-- Retorna os dados relativos ao idioma selecionado na aba Traduções --->
    //$(".idioma_trad").change(function(){
    $(document).on('change', ".idioma_trad", function(e) {
        e.preventDefault();

        var $this = $(this);

        //-- Remove o ID e o 'edit' da URL, para poder chamar a controler de forma genérica --//
        if(window.location.pathname.indexOf('editoria-da-noticia') > 0){ //-- Como o critério de busca é 'edit', a url ficava errada. Por isso o hard-coded.
            url = '/pt_br/admin/tabelas-de-apoio/editoria-da-noticia';
        }else{
            url = window.location.pathname.substring(0,window.location.pathname.substring(0, window.location.pathname.indexOf('/edit')).lastIndexOf('/'));
        }


        $('#aba-traducoes input').val('');
        $('#aba-traducoes textarea').val('');

        $('#aba-traducoes textarea').each(function () {
            if ($(this).hasClass('ckeditor')) {
                CKEDITOR.instances[$(this).attr('id')].setData('');
            }
        });

        if($this.val() != '') {

            //Verifica se o campo existe e habilita.
            if($('#fileupload_translation').length){
                $('#fileupload_translation').attr('disabled',false);
                $('#visualizar_trad').show();

            }

            if($('#model').val() == 'Banner') {
                $('.parent-image-trad').show();

            }

            $.ajax({
                url: url + '/retorna-traducao',
                type: 'GET',
                data: {id: $this.data('id'), model: $('#model').val(), locale: $this.val()},
                dataType: 'json',
                success: function (data) {

                    if (data.length != 0) {
                        resultado = data[0];

                        $('#aba-traducoes textarea').each(function () {
                            if (resultado.hasOwnProperty($(this).attr('id')) != -1) {

                                attrib_trad = $(this).attr('id');
                                attrib_limpo = $(this).attr('id').substring(0, $(this).attr('id').indexOf('_trad'));

                                if ($(this).hasClass('ckeditor')) {
                                    CKEDITOR.instances[attrib_trad].setData(resultado[attrib_limpo]);

                                } else {
                                    $(this).val(resultado[attrib_limpo]);
                                }

                            }
                        });

                        $('#aba-traducoes input').each(function () {
                            if (resultado.hasOwnProperty($(this).attr('id')) != -1) {

                                attrib_limpo = $(this).attr('id').substring(0, $(this).attr('id').indexOf('_trad'));

                                $(this).val(resultado[attrib_limpo]);

                            }
                        });

                        if (resultado.hasOwnProperty('attachment')) {

                                $('#nome_arquivo_trad').text(resultado['originalName']);
                                $('.visualizar_trad').attr('data-link', '/download/' + resultado['attachment'] + '/' + resultado['originalName']);

                        }

                        if($('#model').val() == 'Banner') {
                            $('#imagem-trad').attr('src','/uploads/banners/' + resultado['image']);
                        }

                    }else{
                        $('#visualizar_trad').hide();

                        if($('#model').val() == 'Banner') {
                            $('#imagem-trad').attr('src','');
                            $('.parent-image-trad').hide();

                        }
                    }

                }
            });
        }else{
            //Verifica se o campo existe e habilita.
            if($('#fileupload_translation').length){
                $('#fileupload_translation').attr('disabled',true);
                $('#visualizar_trad').hide();
            }

            if($('#model').val() == 'Banner') {
                $('#imagem-trad').attr('src','');
                $('#banners-galeria-trad').hide();

            }
        }
    })






    $("#addTags").click(function(){

        nova_tag   = ( $('#tagsnew_chosen > div.chosen-drop > ul.chosen-results > li.no-results > span').text() != '') ?
            $('#tagsnew_chosen > div.chosen-drop > ul.chosen-results > li.no-results > span').text() : '';

        texto       = ($("#tagsnew").val() != '') ? $("#tagsnew option:selected").text() : '';
        id_tag      = ($("#tagsnew").val() != '') ? $("#tagsnew").val() : '';


        //id      = Math.floor((Math.random() * 10000) + 1); //-- Gera ID randômico

        if(texto != '' || nova_tag != '') {
            $(".tagsnew").append('<span class="tag item" data-id="' + id_tag + '">' + (texto != '' ? texto : nova_tag ) + '<button type="button" class="close" onClick="removeTag(this)">×</button></span>');
            $("#tagsnew").val('');
            $("#tagsnew").focus();
            $(".tagsnew").show();


            novos_ids = [];
            novas_tags = [];
            $('.tag.item').each(function () {
                if (nova_tag != '' && $(this).data('id') == '') {
                    novas_tags[novas_tags.length] = $(this)
                        .clone()
                        .children()
                        .remove()
                        .end()
                        .text(); //-- Essa implementação pega só o texto do span, sem o "x" do button.

                    $('#novas_tags').val(novas_tags.join(','));
                } else {
                    if ($(this).data('id') != '') {
                        novos_ids[novos_ids.length] = parseInt($(this).data('id'));
                        $('#array_tags').val(novos_ids.join(','));
                    }
                }
            })
        }

        return false;
    })



    //-- Ativa o menu esquerdo clicado
    $(".menu-esquerdo li a").on('click', function(){
        $('.menu-esquerdo li').each(function(){
            $(this).removeClass();
        });
        $(this).parent().addClass('active');
    });

});


function removeExecutorNew(tag){
    $("#executornew"+tag).fadeOut();
    setTimeout(function(){
        $("#executornew"+tag).remove();

        novos_ids = [];
        $('.executor').each(function(){
            novos_ids[novos_ids.length] = $(this).data('id');
        })
        $('#array_executores').val(novos_ids.join(','));
    },250)
}

function removeProponenteNew(tag){
    $("#proponentenew"+tag).fadeOut();
    setTimeout(function(){
        $("#proponentenew"+tag).remove();

        novos_ids = [];
        $('.proponente').each(function(){
            novos_ids[novos_ids.length] = $(this).data('id');
        })
        $('#array_proponentes').val(novos_ids.join(','));

    },250)
}




function removeTag(tag){

    //$("#"+tag).remove();
    $(tag).parent().remove();

    novos_ids   = [];
    novas_tags  = [];
    $('.tag.item').each(function(){
        if($(this).data('id') == '') {
            novas_tags[novas_tags.length] = $(this)
                .clone()
                .children()
                .remove()
                .end()
                .text(); //-- Essa implementação pega só o texto do span, sem o "x" do button.

            $('#novas_tags').val(novas_tags.join(','));
        }else{
            novos_ids[novos_ids.length] = parseInt($(this).data('id'));
            $('#array_tags').val(novos_ids.join(','));
        }
    })

    if($('.tag.item').length == 0){
        $('#array_tags').val('');
    }

}

