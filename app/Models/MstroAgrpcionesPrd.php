<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 13 Feb 2019 21:14:22 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class MstroAgrpcionesPrd
 * 
 * @property int $id_agrpcion
 * @property string $nom_agrpcion
 * @property bool $inactivo
 * 
 * @property \Illuminate\Database\Eloquent\Collection $productos_prsntciones
 *
 * @package App\Models
 */
class MstroAgrpcionesPrd extends Eloquent
{
	protected $table = 'mstro_agrpciones_prd';
	protected $primaryKey = 'id_agrpcion';
	public $timestamps = false;
	protected $dateFormat = 'd-m-Y H:i:s';

	protected $casts = [
		'inactivo' => 'bool'
	];

	protected $fillable = [
		'nom_agrpcion',
		'inactivo'
	];

	public function productos_prsntciones()
	{
		return $this->hasMany(\App\Models\ProductosPrsntcione::class, 'id_agrpcion');
	}
}
