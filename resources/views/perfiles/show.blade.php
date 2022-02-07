@extends('layouts.app')


@section('botones')
<a href="{{ route('recetas.index') }}" class="btn btn-outline-primary mr-2 font-weight-bold text-uppercase">
  <svg class="w-6 h-6 icono" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"></path>
  </svg>
  Volver</a>
@endsection

@section('content')



<div class="container">
  <div class="row">
    <div class="col-md-5">
      @if($perfil->imagen)
      <img src="{{ asset("/storage/$perfil->imagen" )}}" class="w-100 rounded-circle" alt="">
      @endif
    </div>

    <div class="col-md-7 mt-5 mt-md-0">
      <h2 class="text-center mb-2 text-primary">{{ $perfil->usuario->name }}</h2>
      <a href=" {{ $perfil->usuario->url }} ">Visitar Sitio Web</a>
      <div class="biografia">
        {!! $perfil->biografia !!}
      </div>
    </div>

  </div>
</div>

<h2 class="text-center my-5">Recetas Creadas Por : <span class="text-primary">{{ $perfil->usuario->name }}</span></h2>

<div class="container">
  <div class="row mx-auto bg-white p-4">

    @if( count($recetas) > 0)

    @foreach($recetas as $receta)

    <div class="col-md-4 mb-4">
      <div class="card">

        <img src={{ asset("/storage/$receta->imagen") }} class="card-img-top" alt="">

        <div class="card-body">

          <h3>{{ $receta->titulo }}</h3>

          <a href="{{ route('recetas.show', $receta->id) }}"
            class="btn btn-primary d-block mt-4 text-uppercase font-weight-bold">Ver Receta</a>
        </div>
      </div>
    </div>

    @endforeach

    @else

    <p class="text-center w-100">No hay recetas aún</p>

    @endif
  </div>

  <div class="d-flex justify-content-center">
    {{ $recetas->links() }}
  </div>

</div>









@endsection