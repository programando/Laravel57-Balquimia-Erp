<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Frase extends Model
{
   protected $table    = 'frases' ;
   protected $fillable = ['nom_frase','autor'];
   protected $hiden    = ['id_frase', 'id_terc'];
}
