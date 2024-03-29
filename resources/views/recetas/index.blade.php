@extends('layouts.app')

@section('botones')

@include('ui.navegacion')

@endsection


@section('content')
<h2 class="text-center mb-5">Administra tus recetas</h2>

<div class="col-md-10 mx-auto bg-white p-3">

    <table class="table">
        <thead class="bg-primary text-light">
            <tr>
                <th scope="col">Titulo</th>
                <th scope="col">Categoria</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($recetas as $receta)

            <tr>
                <td>{{ $receta->titulo }}</td>
                <td>{{ $receta->categoria->nombre }}</td>
                <td>
                    {{-- antigua manera de eliminar --}}
                    <!-- <form action="{{ route('recetas.destroy', $receta->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="submit" class=" w-100 btn btn-danger mb-1 d-block" name="" id=""
                        value="Elminar &times;">
                    </form> -->
                    <eliminar-receta receta-id={{$receta->id}} ></eliminar-receta>
                    <a href="{{ route('recetas.edit',$receta->id ) }}" class="btn btn-dark mb-1 d-block">Editar</a>
                    <a href="{{ route('recetas.show',$receta->id) }}" class="btn btn-success mb-1 d-block">Ver</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="col-12-mt-4 justify-content-center d-flex">
        {{ $recetas->links() }}
    </div>
    

    <h2 class="text-center my-5">Recetas que te gustan</h2>
    <div class="col-md-10 mx-auto bg-white p-3">
        @if(count( $usuario->meGusta) > 0)

        <ul class="list-group">
            @foreach($usuario->meGusta as $receta)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <p>{{ $receta->titulo }}</p>
                    <a href="{{ route('recetas.show',$receta->id) }}" class="btn btn-outline-success text-uppercase">Ver</a>
                </li>
            @endforeach
        </ul>
        @else
            <p class="text-center">Aún no tienes likes en recetas <small>cuando le des apareceran aqui</small></p>
        @endif
    </div>

</div>
@endsection