<?php

namespace App\Http\Controllers;

use App\Models\Receta;
use Illuminate\Http\Request;
use App\Models\CategoriaReceta;

class CategoriasController extends Controller
{

    public function show(CategoriaReceta $categoriaReceta)
    {
        //
        $recetas = Receta::where('categoria_id', $categoriaReceta->id)->paginate(5);

        return view('categorias.show', compact('recetas', 'categoriaReceta' ));

    }
}
