<?php

namespace App\Http\Controllers;

use Nette\Utils\Json;
use App\Models\Receta;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\CategoriaReceta;

class InicioController extends Controller
{
    //

    public function index(){

        //mostrar las recetas mas votadas
        $votadas = Receta::withCount('likes')->orderBy('likes_count','desc')->take(3)->get();

        //mostrar las ultimas recetas creadas de 5 en 5
        $nuevas = Receta::latest()->take(5)->get();

        //obtener todas las categorias
        $categorias = CategoriaReceta::all();

        //agrupar las recetas pr categoria
        $recetas = [];

        foreach($categorias as $categoria){

            $recetas[ Str::slug($categoria->nombre) ][] = Receta::where('categoria_id', $categoria->id)->take(3)->get();

        }


        return view('inicio.index', compact('nuevas','recetas','votadas') );
    }
}
