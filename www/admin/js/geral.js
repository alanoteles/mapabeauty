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

            if(window.location.pathname.indexOf('servicos') > 0){ //-- Como o critério de busca é 'edit', a url ficava errada. Por isso o hard-coded.
                url = '/pt_br/admin/tabelas-de-apoio/servicos';
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









    //-- Ativa o menu esquerdo clicado
    $(".menu-esquerdo li a").on('click', function(){
        $('.menu-esquerdo li').each(function(){
            $(this).removeClass();
        });
        $(this).parent().addClass('active');
    });

});

