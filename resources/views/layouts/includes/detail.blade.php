<article>
    <input type="hidden" id="stars" value="">
    <input type="hidden" id="profile_id" value="{{ $profile->id }}">
    {{--<section>--}}
        {{--<form action="faleconosco-envia" method="post" id="form">--}}
            {{--{!! csrf_field() !!}--}}

            <div class="col-sm-12">
                <div class="col-md-8 col-xs-8">
                    <h3>{{ !empty($profile->fantasy_name) ? $profile->fantasy_name : $profile->professional_name }}</h3>
                </div>
                <div class="col-md-4 col-xs-4 pull-right">
                    <h4 class="pull-right">
                        {{-- <img src="/assets/img/facebook.png" alt="">
                        <img src="/assets/img/twitter.png" alt="">
                        <img src="/assets/img/googleplus.png" alt=""> --}}
                    </h4>

                </div>
            </div>

            <div class="col-sm-6 col-esquerda">

                <div class="col-md-12 col-xs-12">
                    <div class="form-group">
                        {{ !empty($profile->about) ? $profile->about : '' }}
                    </div>
                </div>

                <div class="col-md-12 col-xs-12">
                    <div class="form-group">
                        <p><strong>Endereço :</strong> {{ $profile->address . ' ' . $profile->number .
                                                          (!empty($profile->complement) ? ' - ' . $profile->complement : '') .
                                                          (!empty($profile->neighborhood) ? ' - ' . ucwords(strtolower($profile->neighborhood)) : '') . ' - ' .
                                                          ucwords(strtolower($profile->cities->name)) . ' - ' .
                                                          $profile->state }}</p>
                        <p><strong>Telefones :</strong> <span class="telefone">{{ !empty($profile->responsible_cellphone) ? $profile->responsible_cellphone : '' }}</span></p>
                        <p>
                            @if(!empty($profile->whatsapp))
                                <strong>WhatsApp :</strong> <span class="telefone"> {{ $profile->whatsapp }}</span><br>
                            @endif

                            @if(!empty($profile->facebook))
                                <strong>Facebook :</strong> {{ $profile->facebook }}<br>
                            @endif

                            @if(!empty($profile->twitter))
                                <strong>Twitter :</strong> {{ $profile->twitter }}<br>
                            @endif

                            @if(!empty($profile->google_plus))
                                <strong>Google+ :</strong> {{ $profile->google_plus }}<br>
                            @endif

                            @if(!empty($profile->youtube))
                                <strong>Youtube :</strong> {{ $profile->youtube }}<br>
                            @endif

                            @if(!empty($profile->instagram))
                                <strong>Instagram :</strong> {{ $profile->instagram }}<br>
                            @endif

                        </p>
                    </div>
                </div>

                <div class="col-md-12 col-xs-12" style="margin-bottom: 20px;">
                    {{--<div class="col-md-6 col-xs-6">--}}
                        {{--<div class="form-group">--}}
                            <span>Avaliação :
                                @if(empty($reviews))
                                    <img src="/assets/img/star_empty.png" alt="">
                                    <img src="/assets/img/star_empty.png" alt="">
                                    <img src="/assets/img/star_empty.png" alt="">
                                    <img src="/assets/img/star_empty.png" alt="">
                                    <img src="/assets/img/star_empty.png" alt="">
                                @else
                                    @for($x = 1; $x <= 5; $x++)
                                    {{-- {{ $x}} - {{ $reviews }} --}}
                                        @if($x <= $reviews)
                                            <img src="/assets/img/star_full.png" alt="">
                                        @else
                                            <img src="/assets/img/star_empty.png" alt="">
                                        @endif
                                    @endfor
                                @endif
                            </span>

                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="col-md-6 col-xs-6">--}}
                        {{--<div class="form-group">--}}
                            {{-- <a href="" class="btn btn-info pull-right" id="review"></a> --}}
                            <a class="btn btn-info pull-right" id="review" data-toggle="modal" data-target="#reviewModal"  alt="">Avalie o profissional</a>
                            {{-- <a class="btn" onclick = "$('#myModal').modal('show');$('#myModal').css('width', '250px').css('margin-left','auto').css('margin-right','auto');" ref="#myModal" >Launch Modal</a> --}}

                        {{--</div>--}}
                    {{--</div>--}}
                </div>

                <div class="form-group" id="deseja_topo" style="margin-top: 20px;" >
                    {{--<div class="col-md-12 col-xs-12" style="margin-top: 20px;border-top: 1px solid #ccc">--}}
                        <table class="table table-hover" id="table-services" style="margin-top: 20px;border-top: 1px solid #ccc">
                            <thead>
                                <tr>
                                    <td class="col-sm-6"><strong>Serviços oferecidos</strong></td>
                                    <td class="col-sm-4 text-right"><strong>Valor R$</strong></td>
                                    <td class="col-sm-2"></td>
                                </tr>
                            </thead>
                            <tbody>
                               
                                @if(!empty($profile->services))
                                    @foreach($profile->services as $service)
                                        <tr>
                                            <td class="col-sm-8">{{ $service->description }}</td>
                                            <td class="col-sm-4 text-right">{{ $service->pivot->price != '0' ? number_format($service->pivot->price,2,',','.') : 'Sob consulta' }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="3" align="center" >Nenhum serviço cadastrado</td>
                                    </tr>
                                @endif
                            </tbody>

                        </table>
                    {{--</div>--}}
                </div>
            </div>

            <div class="col-sm-6 col-direita">
                <div class="col-md-12 col-xs-12">
                    @if(!empty($profile->galleries))
                        <ul class="bxslider">
                            @foreach($profile->galleries as $gallery)
                                <li><img src="/uploads/fotos/{{ $gallery->filename }}" title=" {{ $gallery->subtitle }} " /></li>
                            @endforeach
                        </ul>
                    @endif
                </div>

                <div class="col-md-12 col-xs-12">
                    <div class="form-group">
                        {{--<button class="btn btn-success btn-block">--}}
                        {{--Enviar--}}
                        {{--</button>--}}
                        <input type="hidden" class="btn btn-success btn-block" value="Clique para visualizar no mapa" id="load_map_buttom"
                               onclick="javascript:showlocation()" />
                    </div>
                </div>
                {{--<div class="form-group ">--}}
                    <div class="col-sm-8"  id="map-container" style="margin-left: 15px;">
                        {{-- <img src="{{ asset('assets/img/loader.gif') }}"> --}}
                                <!-- <script src="http://maps.google.com/maps/api/js?key=AIzaSyBw0V-30gQX2eKvIEtRm5HjSPff6wXgzcA&sensor=false"></script> -->
                        {{--<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>--}}
                        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBw0V-30gQX2eKvIEtRm5HjSPff6wXgzcA" type="text/javascript"></script>

                    </div>

                {{--</div>--}}


            </div>


        {{--</form>--}}
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