<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 15 Feb 2019 20:08:10 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class MstroDpto extends Eloquent
  {
    protected $casts      = [ 'inactivo' => 'bool' ];
    protected $fillable   = [ 'cod_dpto',   'nom_dpto',   'inactivo'  ];
    protected $primaryKey = 'id_dpto';
    public $timestamps    = false;


  	public function Municipios()	{
  		return $this->hasMany(\App\Models\MstroMunicipio::class, 'id_dpto');
  	}

}
