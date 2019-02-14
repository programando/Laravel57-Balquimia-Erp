<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 13 Feb 2019 21:13:03 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class MstroCtasPuc
 * 
 * @property int $id_cta
 * @property string $cod_cta
 * @property string $nom_cta
 * 
 * @property \Illuminate\Database\Eloquent\Collection $productos
 *
 * @package App\Models
 */
class MstroCtasPuc extends Eloquent
{
	protected $table = 'mstro_ctas_puc';
	protected $primaryKey = 'id_cta';
	public $timestamps = false;
	protected $dateFormat = 'd-m-Y H:i:s';

	protected $fillable = [
		'cod_cta',
		'nom_cta'
	];

	public function productos()
	{
		return $this->hasMany(\App\Models\Producto::class, 'id_cta_vta');
	}
}
