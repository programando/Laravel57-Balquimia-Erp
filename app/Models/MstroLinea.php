<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 13 Feb 2019 21:14:59 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class MstroLinea
 * 
 * @property int $id_linea
 * @property string $cod_linea
 * @property string $nom_linea
 * @property int $orden
 * @property bool $inactivo
 * 
 * @property \Illuminate\Database\Eloquent\Collection $mstro_lineas_sub_lineas_asocs
 * @property \Illuminate\Database\Eloquent\Collection $productos_prsntciones
 * @property \Illuminate\Database\Eloquent\Collection $terceros
 *
 * @package App\Models
 */
class MstroLinea extends Eloquent
{
	protected $primaryKey = 'id_linea';
	public $timestamps = false;
	protected $dateFormat = 'd-m-Y H:i:s';

	protected $casts = [
		'orden' => 'int',
		'inactivo' => 'bool'
	];

	protected $fillable = [
		'cod_linea',
		'nom_linea',
		'orden',
		'inactivo'
	];

	public function mstro_lineas_sub_lineas_asocs()
	{
		return $this->hasMany(\App\Models\MstroLineasSubLineasAsoc::class, 'id_linea');
	}

	public function productos_prsntciones()
	{
		return $this->hasMany(\App\Models\ProductosPrsntcione::class, 'id_linea');
	}

	public function terceros()
	{
		return $this->hasMany(\App\Models\Tercero::class, 'vend_id_linea');
	}
}
