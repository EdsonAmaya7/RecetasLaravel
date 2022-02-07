<?php

namespace App\Http\Controllers;

use App\Models\Perfil;
use App\Models\Receta;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except'=> 'show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function show(Perfil $perfil)
    {
        //

        //obtener las recetas con paginacion

        $recetas = Receta::where('user_id', $perfil->user_id)->paginate(10);
        return view('perfiles.show', compact('perfil','recetas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function edit(Perfil $perfil)
    {
        //ejecutar el policy de view para que otro usuario no pueda ver el formulario
        //de edicion de alguien mas
        $this->authorize('view',$perfil);
        return view('perfiles.edit', compact('perfil'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Perfil $perfil)
    {
        //ejecutar el policy
        $this->authorize('update', $perfil);
        //validar los datos
        $data = request()->validate([
            'nombre'=> 'required',
            'biografia' => 'required',
            'url' => 'required',

        ]);

        //si el ususario sube una imagen
        if($request['imagen']){
            //obtener la ruta de la imagen
            $ruta_imagen = $request['imagen']->store('upload-perfiles','public');

            //redimencionar imagen
            $img = Image::make( public_path("storage/{$ruta_imagen}"))->fit(600,600);
            $img->save();

            $array_imagen = ['imagen' => $ruta_imagen];

        }
        //asignar nombre y url
        auth()->user()->url = $data['url'];
        auth()->user()->name = $data['nombre'];
        auth()->user()->save();
        //guardar informacion

        //asignar biografia e imagen
        unset($data['url']);
        unset($data['nombre']);

          auth()->user()->perfil()->update( array_merge(
            $data,
            $array_imagen ?? []

        ) );

        // $perfil -> biografia = $data['biografia'];
        // $perfil->save();
        //redireccionar
        return redirect()->route('recetas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function destroy(Perfil $perfil)
    {
        //
    }
}
