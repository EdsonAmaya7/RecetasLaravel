@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css" integrity="sha512-5m1IeUDKtuFGvfgz32VVD0Jd/ySGX7xdLxhqemTmThxHdgqlgPdupWoSN8ThtUSLpAGBvA8DY2oO7jJCrGdxoA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css" integrity="sha512-CWdvnJD7uGtuypLLe5rLU3eUAkbzBR3Bm1SFPEaRfvXXI2v2H5Y0057EMTzNuGGRIznt8+128QIDQ8RqmHbAdg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

@endsection

@section('botones')

<a href="{{ route('recetas.index') }}" class="btn btn-primary mr-2 text-white">Volver</a>

@endsection


@section('content')
<h2 class="text-center mb-5">Crear nueva receta</h2>

<div class="row justify-content-center mt-5">
    <div class="col-md-8">
        <form action="{{ route('recetas.store') }}" method="POST" enctype="multipart/form-data" novalidate>
            @csrf
            <div class="form-group">
                <label for="titulo">Titulo Receta</label>
                <input type="text"
                name="titulo"
                id="titulo"
                class="form-control @error('titulo') is-invalid @enderror"
                placeholder="Titulo Receta"
                value=" {{ old('titulo') }}">

            @error('titulo')
                <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>

            <div class="form-group">
                <label for="categoria">Categoria</label>

                <select name="categoria"
                id="categoria"
                class="form-control @error('categoria') is-invalid @enderror"
                >

                <option value="">-- Seleccione --</option>
                @foreach($categorias as $categoria)

                <option value="{{ $categoria->id }}" {{ old('categoria') == $categoria->id ? 'selected' : '' }}>{{ $categoria->nombre }}</option>

                @endforeach
                </select>

                @error('categoria')
                <span class="invalid-feedback d-block" role="alert">
                    <strong> {{ $message }}</strong>
                </span>

                @enderror
            </div>

            <div class="form-group mt-3">
                <label for="preparacion">Preparacion</label>
                <input type="hidden" name="preparacion" id="preparacion" value="{{ old('preparacion') }}">
                <trix-editor class="form-control @error('preparacion') is-invalid @enderror" input="preparacion"></trix-editor>

                @error('preparacion')
                <span class="invalid-feedback  d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group mt-3">
                <label for="ingredientes">ingredientes</label>
                <input type="hidden" name="ingredientes" id="ingredientes" value="{{ old('ingredientes') }}">
                <trix-editor
                 class="form-control @error('ingredientes') is-invalid @enderror" input="ingredientes"></trix-editor>

                @error('ingredientes')
                <span class="invalid-feedback  d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group-mt-3">
                <label for="imagen">Elige la imagen</label>

                <input type="file" name="imagen" id="imagen" class="form-control @error('imagen') is-invalid @enderror">

                @error('imagen')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>



            <div class="form-group">
                <input type="submit" name="" id="" value="Agregar Receta" class="btn btn-primary mt-4">
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.js" defer integrity="sha512-2RLMQRNr+D47nbLnsbEqtEmgKy67OSCpWJjJM394czt99xj3jJJJBQ43K7lJpfYAYtvekeyzqfZTx2mqoDh7vg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix-core.min.js" defer integrity="sha512-lyT4F0/BxdpY5Rn1EcTA/4OTTGjvJT9SxWGxC1boH9p8TI6MzNexLxEuIe+K/pYoMMcLZTSICA/d3y0ColgiKg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix-core.js" defer integrity="sha512-H8CbNdhcOBCt62S6eVGAUSiyNx5OGVEVrYIIVs0iIgurgD1+oTA9THTZ1tqxSE9yw9vzfilg83xgyxD467a28g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js" defer integrity="sha512-/1nVu72YEESEbcmhE/EvjH/RxTg62EKvYWLG3NdeZibTCuEtW5M4z3aypcvsoZw03FAopi94y04GhuqRU9p+CQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection