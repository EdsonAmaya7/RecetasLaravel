@extends('layouts.app')


@section('botones')
<a href="{{ route('recetas.index') }}" class="btn btn-outline-primary mr-2 font-weight-bold text-uppercase">
    <svg class="w-6 h-6 icono" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"></path>
    </svg>
    Volver</a>
@endsection

@section('content')


{{-- <h2>{{ $receta }}</h2> --}}

<article class="contenido-receta bg-white p-5 shadow">
    <h1 class="text-center mb-4">{{ $receta->titulo }} </h1>

    <div class="receta-meta mt-3">
        <div class="imagen-receta">
            <img src={{ asset("/storage/$receta->imagen") }} class="w-100" alt="a">
        </div>
        <p class="mt-4">
            <span class="font-weight-bold text-primary mt-3">Escrito en:</span>
            <a href="{{ route('categorias.show', $receta->categoria->id) }}" class="text-dark">
            {{ $receta->categoria->nombre}}
        </a>
        </p>

        <p>
            <span class="font-weight-bold text-primary">Autor</span>
            <a href="{{ route('perfiles.show', $receta->autor->id) }}" class="text-dark">
            {{ $receta->autor->name}}
            </a>
        </p>

        <p>
            <span class="font-weight-bold text-primary">Fecha</span>
            @php
            $fecha = $receta->created_at;

            @endphp
            <fecha-receta fecha="{{ $fecha }}"></fecha-receta>
        </p>


        <div class="ingredientes">
            <h2 class="my-3 text-primary">Ingredientes</h2>
            {!! $receta->ingredientes !!}
        </div>

        <div class="preparacion">
            <h2 class="my-3 text-primary">Preparacion</h2>
            {!! $receta->preparacion !!}
        </div>


        <div class="justify-content-center row text-center">
            <like-button receta-id="{{ $receta->id }}" like="{{ $like }}" likes="{{ $likes }}"></like-button>
        </div>

    </div>
</article>
@endsection