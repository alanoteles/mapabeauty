@extends('layouts.master')

<section class="feature-image feature-image-default" data-type="background" data-speed="2">
    <h1>Fale conosco</h1>
</section>

@section('content')

    <div class="content">
        <div class="container">
            <div class="col-md-12 col-sm-12 col-xs-12">

                @if(isset($enviado))

                    @include('layouts.includes.contact_sent')

                @else

                    @include('layouts.includes.contact_form')

                @endif

            </div>

        </div>
    </div>

@endsection