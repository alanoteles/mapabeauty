<article>

    {{--<section>--}}
        <form action="contact-send" method="post" id="form">
            {!! csrf_field() !!}

            <div class="col-sm-12">
                <div class="col-md-12 col-xs-12">
                    <h3>Deixe sua mensagem</h3>

                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto consequatur consequuntur et facilis inventore officia porro quae quas sint
                        tempore! Aliquam animi architecto atque blanditiis consequuntur cupiditate, distinctio dolore excepturi fugiat.</p>
                </div>
            </div>

            <div class="col-sm-6 col-esquerda">

                <div class="col-md-12 col-xs-12">
                    <div class="form-group">
                        <input type="text" class="form-control" name="name" id="name" placeholder="Digite seu nome">
                    </div>
                </div>

                <div class="col-md-12 col-xs-12">
                    <div class="form-group">
                        <input type="text" class="form-control" name="email" id="email" placeholder="Digite seu e-mail">
                    </div>
                </div>

                <div class="col-md-12 col-xs-12">
                    <select class="form-control" name="subject" id="subject">
                        <option value="">Escolha um assunto</option>
                        <option value="D">Dúvidas/Informações</option>
                        <option value="E">Elogios</option>
                        <option value="R">Reclamações</option>
                    </select>
                </div>
            </div>

            <div class="col-sm-6 col-direita">

                <div class="col-md-12 col-xs-12">
                    <div class="form-group">
                        <textarea name="message" id="message" cols="30" rows="3"></textarea>
                    </div>
                </div>

                <div class="col-md-12 col-xs-12">
                    <div class="form-group">
                        <button class="btn btn-success btn-block">
                            Enviar
                        </button>
                    </div>
                </div>
            </div>


        </form>
    {{--</section>--}}


</article>

{{--<div id="lightbox">--}}
    {{--<p>Click to close</p>--}}
    {{--<div id="content">--}}
        {{--<img src='/images/gif-loading.gif' />--}}
    {{--</div>--}}
{{--</div>--}}

{{--<script type="text/javascript">--}}
    {{--function ShowLoading(e) {--}}
        {{--var div = document.createElement('div');--}}
        {{--var img = document.createElement('img');--}}
        {{--img.src = '/images/gif-loading.gif';--}}
        {{--div.innerHTML = "Loading...<br />";--}}
        {{--div.style.cssText = 'float: left; margin: 150px 0 0 47%; z-index: 5000; width: 6%;';--}}
        {{--div.appendChild(img);--}}
        {{--document.body.appendChild(div);--}}
        {{--return true;--}}
        {{--// These 2 lines cancel form submission, so only use if needed.--}}
        {{--window.event.cancelBubble = true;--}}
        {{--e.stopPropagation();--}}
    {{--}--}}
{{--</script>--}}