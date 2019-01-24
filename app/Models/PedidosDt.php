<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 21 Jan 2019 20:00:13 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;


class PedidosDt extends Eloquent
{
  protected $table      = 'pedidos_dt';
  protected $primaryKey = 'id_ped_dt';
  public $timestamps    = false;


	protected $casts = [
    'id_ped'          => 'int',
    'id_prd'          => 'int',
    'cant'            => 'float',
    'vr_precio_lista' => 'float',
    'vr_flete'        => 'float',
    'vr_fnacion'      => 'float',
    'vr_precio_adic'  => 'float',
    'vr_dscto'        => 'float',
    'pcje_iva'        => 'float',
    'vr_iva'          => 'float',
    'vr_unit_real'    => 'float',
    'vt_tot_item'     => 'float',
    'id_comis'        => 'int'
	];

	protected $fillable = [
		'id_ped',
		'id_prd',
		'cant',
		'vr_precio_lista',
		'vr_flete',
		'vr_fnacion',
		'vr_precio_adic',
		'vr_dscto',
		'pcje_iva',
		'vr_iva',
		'vr_unit_real',
		'vt_tot_item',
		'id_comis'
	];

	public function Pedido(){
		return $this->belongsTo(\App\Models\Pedido::class, 'id_ped');
	}

	public function Productos()	{
		return $this->belongsTo(\App\Models\ProductosPrsntcione::class, 'id_prd');
	}

}
