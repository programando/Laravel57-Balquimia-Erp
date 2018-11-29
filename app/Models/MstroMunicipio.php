<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 28 Nov 2018 20:48:23 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class MstroMunicipio extends Eloquent
{
  protected $primaryKey = 'id_mcpio';
  public $timestamps    = false;


	protected $casts = [ 'id_dpto' => 'int', 'zn_vta' => 'bool', 'mnv' => 'bool', 'inactivo' => 'bool' ];

	protected $fillable = [ 'id_dpto', 'cod_mcpio', 'nom_mcpio', 'zn_vta',  'cod_dane', 'cod_dian', 'mnv', 	'inactivo' ];

	public function Departamento(){
		return $this->belongsTo(\App\Models\MstroDpto::class, 'id_dpto');
	}

	public function Tercero(){
		return $this->hasMany(\App\Models\Tercero::class, 'id_mcipio');
	}
}
