<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 21 Jan 2019 19:59:51 +0000.
 */

namespace App\Models;

use App\Helpers\Strings;
use Illuminate\Database\Eloquent\Model as Eloquent;

use DB;
class Pedido extends Eloquent
{
  protected $primaryKey = 'id_ped';
  public $timestamps    = false;


	protected $casts = [ 'id_fact'         => 'int',         'id_terc_cli'     => 'int',       'id_terc_usu'     => 'int',       'id_terc_autz'    => 'int',
                       'id_stdo'         => 'int',         'num_ped'         => 'int',       'blq_cart'        => 'bool',      'facturado'       => 'bool',
                       'remisionado'     => 'bool',        'alistamiento'    => 'bool',       'stdo_infdo'      => 'bool',     'inactivo'        => 'bool',
                       'vr_subtotal'     => 'float',       'pcje_dscto'      => 'float',      'vr_dscto'        => 'float',    'vr_flete'        => 'float',
                       'vr_iva'          => 'float',       'vr_total'        => 'float',      'mnv'             => 'bool',     'peso_grm'        => 'float',
                       'vr_comis_usadas' => 'float',       'prn_resumen'     => 'bool',       'prn_ped'         => 'bool',     'prn_fact'        => 'bool',
                       'prn_rotulo'      => 'bool',        'vr_prd_tron'     => 'float',       'vr_accsrios'     => 'float',   'vr_otros_prd'    => 'float'
	];

	protected $dates = [ 	'fcha_ped',    'fcha_autz_cart',   'fcha_autz_pn',   'fcha_dspcho' ];

	protected $fillable = [  'id_fact',    'id_terc_cli',    'id_terc_usu',    'id_terc_autz',     'id_stdo',    'num_ped',    'num_ord_cpra',   'fcha_ped',
		                       'fcha_autz_cart',    'fcha_autz_pn',   'fcha_dspcho',    'blq_cart',     'facturado',    'remisionado',    'alistamiento',
		                       'observ_remis',    'observ_ped',   'observ_cart',      'stdo_infdo',   'inactivo',     'observ_inactivo',    'vr_subtotal',
		                       'pcje_dscto',      'vr_dscto',     'vr_flete',         'vr_iva',     'vr_total',       'web',
		                       'fma_pgo',         'peso_grm',     'vr_comis_usadas',  'prn_resumen',   'prn_ped',     'prn_fact',
		                        'prn_rotulo',     'vr_prd_tron',   'vr_prd_indus',      'vr_accsrios',    'vr_otros_prd'
	];

    	public function Estado()	{
    		return $this->belongsTo(\App\Models\MstroPedidosEstado::class, 'id_stdo');
    	}

      public function Cliente() {
        return $this->belongsTo(\App\Models\Tercero::class, 'id_terc_cli');
      }

      public function Autoriza() {
        return $this->belongsTo(\App\Models\Tercero::class, 'id_terc_autz');
      }

    	public function Usuario() {
    		return $this->belongsTo(\App\Models\Tercero::class, 'id_terc_usu');
    	}

    	public function PedidosDt() {
    		return $this->hasMany(\App\Models\PedidosDt::class, 'id_ped');
    	}

  /*  MUTATORS
      modifica el contenido del campo antes de almacenar en el campo
  */
    public function setNumOrdCpraAttribute ( $value ){
        $this->attributes['num_ord_cpra'] = Strings::UpperTrim ( $value,20); ;
    }

    public function setObservRemisAttribute ( $value ){
        $this->attributes['observ_remis'] = Strings::UpperTrim ( $value,200);
    }
    public function setObservPedAttribute ( $value ){
        $this->attributes['observ_ped'] = Strings::UpperTrim ( $value,200);
    }

    public function setObservCartAttribute ( $value ){
        $this->attributes['observ_cart'] = Strings::UpperTrim ( $value,200);
    }

    public function setNumPedAttribute( $value ){
        $Consec = DB::select("call pedidos_generar_consecutivo()");
        $NumPed = $Consec[0]->num_ped;
        if ( $NumPed  == 1 ) {
           // EL 1 ANTEPUESTO CORRESPONDE A PEDIDO DE LA WEB, EL 2 EN EL NUMERO DE PEDIDO CORRESPONDE A PEDIDO COMPUTRON
            $Mes    = date('m');
            $Anio   = date('y');
            $NumPed = '1'.$Mes.$Anio. $NumPed ;
          }
        $this->attributes['num_ped'] = $NumPed  ;
    }

/** ACCESORES
    Retornan el contenido del campo renombrando la variable de salida
**/

     /* public function scopePorAutorizarCartera ( $query ) {
        return $query->where('facturado', 0)
                     ->whereNull('fcha_autz_cart')
                     ->orderBy('fcha_ped')
                     ->get();
      }
      */

}


