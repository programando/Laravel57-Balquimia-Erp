<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 13 Feb 2019 20:54:40 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;


class Producto extends Eloquent
{
  protected $primaryKey = 'id_prd_ppal';
  public $timestamps    = false;


	protected $casts = ['id_cta_vta'      => 'int',          'id_cta_inv'      => 'int',            'id_tp_prd'       => 'int',
                      'id_cls_dane_prd' => 'int',          'id_med_cpra'     => 'int',            'densidad'        => 'float',
                      'mp_fbrcda'         => 'bool',         'mp_ctrlda'       => 'bool',           'prestable'       => 'bool',
                      'accesorio'       => 'bool',         'inactivo'        => 'bool'
                    ];

	protected $fillable = [  'clave',          'id_cta_vta',           'id_cta_inv',         'id_tp_prd',        	'id_cls_dane_prd',
		                        'id_med_cpra',    'nom_prd',            'nom_faction',         	'fragancia',        'tp_dspcho',
		                        'densidad',       'mp_fbrcda',            'mp_ctrlda',        	'prestable',       	'accesorio',
		                        'inactivo'
	                     ];

  	public function  agrupacionDane()	{
  		return $this->belongsTo(\App\Models\MstroDanePrdGrp::class, 'id_cls_dane_prd');
  	 }

  	public function pucVenta()	{
  		return $this->belongsTo(\App\Models\MstroCtasPuc::class, 'id_cta_vta');
  	 }

      public function pucInventario()  {
      return $this->belongsTo(\App\Models\MstroCtasPuc::class, 'id_cta_inv');
      }


  	public function unidadMedida() {
  		return $this->belongsTo(\App\Models\MstroUndsMedida::class, 'id_med_cpra');
  	 }

  	public function tipoProducto()	{
  		return $this->belongsTo(\App\Models\MstroTpsPrd::class, 'id_tp_prd');
  	 }

  	public function Presentaciones()	{
  		return $this->hasMany(\App\Models\ProductosPrsntcione::class, 'id_prd_ppal');
  	 }

  /*//////////////////////////////////////
        SCOPES
   *//////////////////////////////////////
     public function scopeProductosActivos( $query, $Filtro ){
           return $query
                    ->Where('id_tp_prd','3')
                    ->Where('inactivo','0')
                    ->Where('nom_prd'         ,'LIKE'   , "%$Filtro%");
     }





}
