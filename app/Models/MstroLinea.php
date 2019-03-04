<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 02 Mar 2019 15:47:46 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;


class MstroLinea extends Eloquent
{
  protected $primaryKey = 'id_linea';
  public $timestamps    = false;


	protected $casts = [ 'orden'    => 'int',  'inactivo' => 'bool' ];

	protected $fillable = [ 'cod_linea', 'nom_linea', 'orden', 'inactivo' ];

  	public function SubLineas() {
  		return $this->hasMany(\App\Models\MstroLineasSubLineasAsoc::class, 'id_linea');
  	}

  	public function ProductosPresentaciones(){
  		return $this->hasMany(\App\Models\ProductosPrsntcione::class, 'id_linea');
  	}

  	public function Terceros(){
  		return $this->hasMany(\App\Models\Tercero::class, 'vend_id_linea');
  	}

  	public function TercerosLineasAsociadas(){
  		return $this->hasMany(\App\Models\TercerosLineasAsoc::class, 'id_linea');
  	}


}
