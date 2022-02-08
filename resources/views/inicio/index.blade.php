@extends('layouts.app')


@section('styles')
{{--
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
    integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.green.min.css" />
--}}


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.green.min.css"
    integrity="sha512-C8Movfk6DU/H5PzarG0+Dv9MA9IZzvmQpO/3cIlGIflmtY3vIud07myMu4M/NTPJl8jmZtt/4mC9bAioMZBBdA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.green.css"
    integrity="sha512-riTSV+/RKaiReucjeDW+Id3WlRLVZlTKAJJOHejihLiYHdGaHV7lxWaCfAvUR0ErLYvxTePZpuKZbrTbwpyG9w=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"
    integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css"
    integrity="sha512-OTcub78R3msOCtY3Tc6FzeDJ8N9qvQn1Ph49ou13xgA9VsH9+LRxoFU6EqLhW4+PKRfU+/HReXmSZXHEkpYoOA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
    integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css"
    integrity="sha512-UTNP5BXLIptsaj5WdKFrkFov94lDx+eBvbKyoe1YAfjeRPC+gT5kyZ10kOHCfNZqEui1sxmqvodNUx3KbuYI/A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection


@section('hero')
<div class="hero-categorias">
    <form action="" class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-md-4 texto-buscar">
                <p class="display-4">Encuentra una receta para tu próxima comida</p>

                <input type="search" name="buscar" class="form-control" placeholder="Buscar Receta" id="">
            </div>
        </div>
    </form>
</div>
@endsection
@section('content')

{{-- <img src={{ asset("/storage/images/bgimagen.jpg") }} alt=""> --}}


<div class="container nuevas-recetas">
    <h2 class="titulo-categoria text-uppercase mt-5 mb-4">Últimas Recetas</h2>

    <div class="owl-carousel owl-theme">
        @foreach($nuevas as $nueva)

        <div class="card ">
            <img src={{ asset("/storage/$nueva->imagen") }} alt="" class="card-img-top">

            <div class="card-body">
                <h3>{{ Str::title( $nueva->titulo ) }}</h3>

                <p>{{ Str::words( strip_tags( $nueva->preparacion ), 15 ) }}</p>

                <a href="{{ route('recetas.show',$nueva->id)}}"
                    class="btn btn-primary d-bllock font-weight-bold text-uppercase">Ver Receta</a>
            </div>
        </div>

        @endforeach

    </div>

</div>

<div class="container">
    <h2 class="titulo-receta text-uppercase mt-5 mb-4">Recetas mas votadas</h2>

    <div class="row">
        @foreach($votadas as $receta)

        @include('ui.receta')

        @endforeach
    </div>
</div>

@foreach($recetas as $key => $grupo)
<div class="container">
    <h2 class="titulo-receta text-uppercase mt-5 mb-4">{{ str_replace('-'," ", $key) }}</h2>

    <div class="row">
        @foreach($grupo as $recetas)
        @foreach($recetas as $receta)

        @include('ui.receta')

        @endforeach
        @endforeach
    </div>
</div>
@endforeach


@endsection

@section('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
@endsection