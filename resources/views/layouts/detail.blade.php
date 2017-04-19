@extends('layouts.master')

<section class="feature-image feature-image-default" data-type="background" data-speed="2">
    <h1>Detalhes</h1>
</section>

@section('content')

    <div class="content">
        <div class="container">
            <div class="col-md-12 col-sm-12 col-xs-12">

                @include('layouts.includes.detail')

            </div>

        </div>
    </div>

@endsection