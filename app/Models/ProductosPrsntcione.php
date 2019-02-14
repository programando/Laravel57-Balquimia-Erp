<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 13 Feb 2019 20:55:41 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class ProductosPrsntcione extends Eloquent
{
  protected $primaryKey = 'id_prd';
  public $timestamps    = false;


	protected $casts = ['cobro_flete'     => 'bool',  'inactivo'        => 'bool'  ,  'adm_kardex'      => 'bool',
                      'aplica_tron'     => 'bool',   'cls_prd'         => 'int',   'costo'           => 'float',
                      'dvsor_precio'    => 'float',  'en_lista_precio' => 'bool',   'en_oferta'       => 'bool',
                      'es_combo'        => 'bool',    'es_kit'          => 'bool',   'id_agrpcion'     => 'int',
                      'id_comis'        => 'int',     'id_linea'        => 'int',   'id_marca'        => 'int',
                      'id_prd_ppal'     => 'int',     'id_present'      => 'int',   'id_sub_categ'    => 'int',
                      'margen'          => 'float',    'peso_grm'        => 'float',  'peso_kg'         => 'float',
                      'prd_fbrcdo'      => 'bool',      'ver_web_tron'    => 'bool',    'vr_mcdo_con_iva' => 'float',
                      'vr_vta'          => 'float',     'vr_vta_web'      => 'float',
	];

	protected $fillable = ['id_prd_ppal',  'id_present',   'id_linea',   'id_marca',   'id_comis',   'id_sub_categ',
		                     'id_agrpcion',   'cls_prd',    	'costo',   	'margen',    'peso_grm',   	'peso_kg',
		                      'fragancia',    'en_lista_precio',    'vr_vta',   'vr_vta_web',   'prd_fbrcdo',
		                      'adm_kardex',   'es_kit',   'en_oferta',  'es_combo',   'vr_mcdo_con_iva',  'dvsor_precio',
		                      'aplica_tron',  'ver_web_tron',   'ver_web_balq',   'cobro_flete',    'descrip_tron',
		                      'descrip_balq', 'tags_bsqda',   'inactivo'
	           ];

    	public function Agrupacion(){
    		return $this->belongsTo(\App\Models\MstroAgrpcionesPrd::class, 'id_agrpcion');
    	   }

    	public function Comision(){
    		return $this->belongsTo(\App\Models\MstroComisionesPrd::class, 'id_comis');
    	   }

    	public function Linea()	{
    		return $this->belongsTo(\App\Models\MstroLinea::class, 'id_linea');
    	   }

    	public function Marca()	{
    		return $this->belongsTo(\App\Models\MstroMarca::class, 'id_marca');
    	}

    	public function ProductoPpal()	{
    		return $this->belongsTo(\App\Models\Producto::class, 'id_prd_ppal');
    	   }

    	public function Presentaciones()	{
    		return $this->belongsTo(\App\Models\MstroPrsntcione::class, 'id_present');
    	   }

    	public function webCategoria()	{
    		return $this->belongsTo(\App\Models\WebPrdSubCateg::class, 'id_sub_categ');
    	   }

    	public function FacturasDt()	{
    		return $this->hasMany(\App\Models\FacturasDt::class, 'id_prd');
    	   }

    	public function PedidosDt()	{
    		return $this->hasMany(\App\Models\PedidosDt::class, 'id_prd');
    	}
}
