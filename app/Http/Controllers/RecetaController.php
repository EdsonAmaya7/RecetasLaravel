<?php

namespace App\Http\Controllers;

use App\Models\Receta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\CategoriaReceta;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;


class RecetaController extends Controller
{

    // autentificacion no deja acceder a otro lado sin hacer login
    public function __construct()
    {
        $this->middleware('auth',['except' => ['show','search']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // auth()->user()->recetas->dd();
        // antiguo metodo con relaciones aqui no funciona la paginacion
        // $recetas = auth()->user()->recetas;
        // return view('recetas.index', compact('recetas'));

        // recetas con paginacion
        $usuario = auth()->user();

        $recetas = Receta::where('user_id',$usuario->id)->paginate(2);
        return view('recetas.index', compact('recetas','usuario'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // DB::table('categoria_recetas')->get()->pluck('nombre','id')->dd();
        // consulta a la bd sin modelo
        // $categorias = DB::table('categoria_recetas')->get()->pluck('nombre','id');

        $categorias = CategoriaReceta::all(['id','nombre']);


        return view('recetas.create',compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // dd($request->all());
        // dd($request['imagen']->store('upload-recetas','public'));
        $data = request()->validate([
            'titulo' => 'required|min:6',
            'preparacion' => 'required',
            'ingredientes' => 'required',
            'imagen' => 'required|image',
            'categoria' => 'required',
        ]);

        $ruta_imagen = $request['imagen']->store('upload-recetas','public');
        // se ocupa el enlace simbolico para usar public_path
        $img = Image::make( public_path("storage/{$ruta_imagen}"))->fit(1000,550);
        $img->save();

        // insertar en la bd sin modelo
        // DB::table('recetas')->insert([
        //     'titulo' => $data['titulo'],
        //     'preparacion' => $data['preparacion'],
        //     'ingredientes' => $data['ingredientes'],
        //     'imagen' => $ruta_imagen,
        //     'user_id' => Auth::user()->id,
        //     'categoria_id' => $data['categoria']

        // ]);

        // insertar en la bd con el modelo y la relacion recetas
        auth()->user()->recetas()->create([

            'titulo' => $data['titulo'],
            'preparacion' => $data['preparacion'],
            'ingredientes' => $data['ingredientes'],
            'imagen' => $ruta_imagen,
            'categoria_id' => $data['categoria']

        ]);

        return redirect()->route('recetas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function show(Receta $receta)
    {
        //obtener si el usuario actual le dio me gusta  a la receta
        $like = ( auth()->user() ) ? auth()->user()->meGusta->contains($receta->id) : false;

        //pasa la cantidad de likes a la vista
        $likes = $receta->likes->count();
        return view('recetas.show', compact('receta','like','likes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function edit(Receta $receta)
    {
        //
        $this->authorize('view',$receta);
        $categorias = CategoriaReceta::all(['id','nombre']);
        return view('recetas.edit', compact('categorias','receta'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Receta $receta)
    {
        //revisar el policy
        $this->authorize('update',$receta);

        $data = request()->validate([
            'titulo' => 'required|min:6',
            'preparacion' => 'required',
            'ingredientes' => 'required',
            'categoria' => 'required',
        ]);

        $receta->titulo = $data['titulo'];
        $receta->preparacion = $data['preparacion'];
        $receta->ingredientes = $data['ingredientes'];
        $receta->categoria_id = $data['categoria'];


        //si el usuario sube una nueva imagen
        if(request('imagen')) {
            //obtener la ruta de la imagen
            $ruta_imagen = $request['imagen']->store('upload-recetas','public');

            //recortando la imagen
            $img = Image::make( public_path("storage/{$ruta_imagen}"))->fit(1000,550);
            $img->save();

            //asigno al objeto
            $receta->imagen = $ruta_imagen;
        }
        $receta->save();

        return redirect()->route('recetas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Receta $receta)
    {
        //Ejecutar el policy
        $this->authorize('delete',$receta);

        //elimina la recet
        $receta->delete();

        return redirect()->route('recetas.index');
    }


    public function search(Request $request){
        $busqueda = $request['buscar'];

        $recetas = Receta::where('titulo', 'like', '%' . $busqueda . '%')->paginate(1);
        $recetas->appends(['buscar'=>$busqueda]);

        return view('busquedas.show', compact('recetas','busqueda') );
    }
}
