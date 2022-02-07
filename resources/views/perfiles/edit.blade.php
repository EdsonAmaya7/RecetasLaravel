@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css"
    integrity="sha512-5m1IeUDKtuFGvfgz32VVD0Jd/ySGX7xdLxhqemTmThxHdgqlgPdupWoSN8ThtUSLpAGBvA8DY2oO7jJCrGdxoA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css"
    integrity="sha512-CWdvnJD7uGtuypLLe5rLU3eUAkbzBR3Bm1SFPEaRfvXXI2v2H5Y0057EMTzNuGGRIznt8+128QIDQ8RqmHbAdg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

@endsection

@section('botones')

<a href="{{ route('recetas.index') }}" class="btn btn-outline-primary mr-2 font-weight-bold text-uppercase">
    <svg class="w-6 h-6 icono" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"></path></svg>
    Volver</a>

@endsection

@section('content')

<h1 class="text-center">Editar Mi perfil</h1>

{{-- {{$perfil}} --}}
<div class="row justify-content-center mt-5">
    <div class="col-md-10 bg-white p-3">
        <form action="{{ route('perfiles.update',$perfil->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="form-control @error('nombre') is-invalid @enderror"
                    placeholder="nombre Receta" value="{{ $perfil->usuario->name }}">

                @error('nombre')
                <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="url">Tu sitio web</label>
                <input type="text" name="url" id="url" class="form-control @error('url') is-invalid @enderror"
                    placeholder="url Receta" value=" {{ $perfil->usuario->url }}">

                @error('url')
                <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group mt-3">
                <label for="biografia">biografia</label>
                <input type="hidden" name="biografia" id="biografia" value="{{ $perfil->biografia }}">
                <trix-editor class="form-control @error('biografia') is-invalid @enderror" input="biografia">
                </trix-editor>

                @error('biografia')
                <span class="invalid-feedback  d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group-mt-3">
                <label for="imagen">Elige la imagen</label>

                <input type="file" name="imagen" id="imagen" class="form-control @error('imagen') is-invalid @enderror">

                @if($perfil->imagen)

                <div class="mt-4">
                    <p>Imagen actual</p>
                    <img src="{{ asset(" /storage/$perfil->imagen")}}" alt="" style="width: 300px">
                </div>

                @error('imagen')
                <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                @endif

            </div>


            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Actualizar Perfil">
            </div>



        </form>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.js" defer
    integrity="sha512-2RLMQRNr+D47nbLnsbEqtEmgKy67OSCpWJjJM394czt99xj3jJJJBQ43K7lJpfYAYtvekeyzqfZTx2mqoDh7vg=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix-core.min.js" defer
    integrity="sha512-lyT4F0/BxdpY5Rn1EcTA/4OTTGjvJT9SxWGxC1boH9p8TI6MzNexLxEuIe+K/pYoMMcLZTSICA/d3y0ColgiKg=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix-core.js" defer
    integrity="sha512-H8CbNdhcOBCt62S6eVGAUSiyNx5OGVEVrYIIVs0iIgurgD1+oTA9THTZ1tqxSE9yw9vzfilg83xgyxD467a28g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js" defer
    integrity="sha512-/1nVu72YEESEbcmhE/EvjH/RxTg62EKvYWLG3NdeZibTCuEtW5M4z3aypcvsoZw03FAopi94y04GhuqRU9p+CQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection