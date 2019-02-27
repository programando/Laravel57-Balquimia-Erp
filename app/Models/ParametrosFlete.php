<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 27 Feb 2019 20:35:49 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;


class ParametrosFlete extends Eloquent
{
  protected $primaryKey = 'id_reg';
  public $timestamps = false;
  protected $dateFormat = 'd-m-Y H:i:s';

  protected $casts = [
    'id_terc' => 'int',
    'dscto_ccial' => 'float',
    'vr_min_asgrble' => 'float',
    'sgro_min_pcje' => 'float',
    'sgro_min_vr' => 'float',
    'sgro_min_und' => 'float',
    'sgro_min_rex_pcje' => 'float',
    'sgro_min_rex_vr' => 'float',
    'sgro_min_rex_und_vr' => 'float',
    'urb_peso_min' => 'float',
    'urb_peso_min_cajas' => 'float',
    'urb_flete_min_vr' => 'float',
    'urb_flete_vrble_pcje' => 'float',
    'urb_flete_vrble_vr' => 'float',
    'reg_peso_min' => 'float',
    'reg_peso_min_cajas' => 'float',
    'reg_flete_min_vr' => 'float',
    'reg_flete_vrble_pcje' => 'float',
    'reg_flete_vrble_vr' => 'float',
    'nac_peso_min' => 'float',
    'nac_peso_min_cajas' => 'float',
    'nac_flete_min_vr' => 'float',
    'nac_flete_vrble_pcje' => 'float',
    'nac_flete_vrble_vr' => 'float',
    'reex_peso_min' => 'float',
    'reex_peso_min_cajas' => 'float',
    'reex_flete_min_vr' => 'float',
    'reex_flete_vrble_pcje' => 'float',
    'reex_flete_vrble_vr' => 'float',
    'pcje_utldad_bq' => 'float',

  ];

  protected $fillable = [
    'id_terc',
    'dscto_ccial',
    'pcje_utldad_bq',
    'vr_min_asgrble',
    'sgro_min_pcje',
    'sgro_min_vr',
    'sgro_min_und',
    'sgro_min_rex_pcje',
    'sgro_min_rex_vr',
    'sgro_min_rex_und_vr',
    'urb_peso_min',
    'urb_peso_min_cajas',
    'urb_flete_min_vr',
    'urb_flete_vrble_pcje',
    'urb_flete_vrble_vr',
    'reg_peso_min',
    'reg_peso_min_cajas',
    'reg_flete_min_vr',
    'reg_flete_vrble_pcje',
    'reg_flete_vrble_vr',
    'nac_peso_min',
    'nac_peso_min_cajas',
    'nac_flete_min_vr',
    'nac_flete_vrble_pcje',
    'nac_flete_vrble_vr',
    'reex_peso_min',
    'reex_peso_min_cajas',
    'reex_flete_min_vr',
    'reex_flete_vrble_pcje',
    'reex_flete_vrble_vr'
  ];


       public function scopeRedeTrans( $query ) {
          return $this->where('id_terc','1572');
        }

       public function scopeLaPrensa( $query ) {
          return $this->where('id_terc','4315');
        }

}
