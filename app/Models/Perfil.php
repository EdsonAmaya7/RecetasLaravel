<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    use HasFactory;


    //  relacion 1:1 de perfil con usuario

    public function usuario()
    {

        return $this->belongsTo(User::class, 'user_id');
    }
}
