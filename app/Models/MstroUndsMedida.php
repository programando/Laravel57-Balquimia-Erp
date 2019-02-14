<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 13 Feb 2019 21:13:21 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class MstroUndsMedida
 * 
 * @property int $id_med
 * @property string $cod_med
 * @property string $equiv_dane
 * @property string $nom_med
 * @property bool $inactivo
 * 
 * @property \Illuminate\Database\Eloquent\Collection $productos
 *
 * @package App\Models
 */
class MstroUndsMedida extends Eloquent
{
	protected $primaryKey = 'id_med';
	public $timestamps = false;
	protected $dateFormat = 'd-m-Y H:i:s';

	protected $casts = [
		'inactivo' => 'bool'
	];

	protected $fillable = [
		'cod_med',
		'equiv_dane',
		'nom_med',
		'inactivo'
	];

	public function productos()
	{
		return $this->hasMany(\App\Models\Producto::class, 'id_med_cpra');
	}
}
