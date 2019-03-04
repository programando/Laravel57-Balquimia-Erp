<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 02 Mar 2019 15:48:05 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;




class TercerosLineasAsoc extends Eloquent
{
  protected $primaryKey = 'id_asoc_linea';
  protected $table      = 'terceros_lineas_asoc';
  public $timestamps    = false;


	protected $casts = [ 'id_terc' => 'int', 'id_linea' => 'int' ];

	protected $fillable = [ 'id_terc', 'id_linea' ];

  	public function Lineas(){
  		return $this->belongsTo(\App\Models\MstroLinea::class, 'id_linea');
  	}

  	public function Terceros() {
  		return $this->belongsTo(\App\Models\Tercero::class, 'id_terc');
  	}

    public function scopeLineasAsociadas( $query, $IdTercero ) {
        //return $query->where('id_terc', $IdTercero )->select('id_linea')->get();
      return  $query->where('id_terc', $IdTercero )->pluck('id_linea')->toArray();

    }

}
