<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receta extends Model
{
    use HasFactory;


    protected $fillable = [
        'titulo',
        'preparacion',
        'ingredientes',
        'imagen',
        'categoria_id',
    ];
    // obtiene la categoria via fk
    public function categoria(){

        return $this->belongsTo(CategoriaReceta::class);

    }
    //obtener la informacion del user via fk

    public function autor(){

        return $this->belongsTo(User::class,'user_id');

    }

    // likes que ha resibido la receta

    public function likes(){

        return $this->belongsToMany(User::class, 'likes_receta','user_id', 'receta_id');
    }
}
