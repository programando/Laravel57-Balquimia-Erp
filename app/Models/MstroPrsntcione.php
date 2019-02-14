<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 13 Feb 2019 21:13:56 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class MstroPrsntcione
 * 
 * @property int $id_present
 * @property string $nom_present
 * @property float $capac_volum
 * @property int $cant_und_empque
 * @property string $descrip
 * @property bool $web
 * @property bool $inactivo
 * 
 * @property \Illuminate\Database\Eloquent\Collection $productos_prsntciones
 *
 * @package App\Models
 */
class MstroPrsntcione extends Eloquent
{
	protected $primaryKey = 'id_present';
	public $timestamps = false;
	protected $dateFormat = 'd-m-Y H:i:s';

	protected $casts = [
		'capac_volum' => 'float',
		'cant_und_empque' => 'int',
		'web' => 'bool',
		'inactivo' => 'bool'
	];

	protected $fillable = [
		'nom_present',
		'capac_volum',
		'cant_und_empque',
		'descrip',
		'web',
		'inactivo'
	];

	public function productos_prsntciones()
	{
		return $this->hasMany(\App\Models\ProductosPrsntcione::class, 'id_present');
	}
}
