<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 13 Feb 2019 21:14:43 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class MstroComisionesPrd
 * 
 * @property int $id_comis
 * @property string $cod_grp
 * @property float $margen_ini
 * @property float $margen_fin
 * @property float $comis
 * 
 * @property \Illuminate\Database\Eloquent\Collection $productos_prsntciones
 *
 * @package App\Models
 */
class MstroComisionesPrd extends Eloquent
{
	protected $primaryKey = 'id_comis';
	public $timestamps = false;
	protected $dateFormat = 'd-m-Y H:i:s';

	protected $casts = [
		'margen_ini' => 'float',
		'margen_fin' => 'float',
		'comis' => 'float'
	];

	protected $fillable = [
		'cod_grp',
		'margen_ini',
		'margen_fin',
		'comis'
	];

	public function productos_prsntciones()
	{
		return $this->hasMany(\App\Models\ProductosPrsntcione::class, 'id_comis');
	}
}
