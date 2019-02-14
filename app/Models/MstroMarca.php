<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 13 Feb 2019 21:15:15 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class MstroMarca
 * 
 * @property int $id_marca
 * @property string $nom_marca
 * @property bool $uso_dmstico
 * @property bool $inactivo
 * 
 * @property \Illuminate\Database\Eloquent\Collection $productos_prsntciones
 *
 * @package App\Models
 */
class MstroMarca extends Eloquent
{
	protected $primaryKey = 'id_marca';
	public $timestamps = false;
	protected $dateFormat = 'd-m-Y H:i:s';

	protected $casts = [
		'uso_dmstico' => 'bool',
		'inactivo' => 'bool'
	];

	protected $fillable = [
		'nom_marca',
		'uso_dmstico',
		'inactivo'
	];

	public function productos_prsntciones()
	{
		return $this->hasMany(\App\Models\ProductosPrsntcione::class, 'id_marca');
	}
}
