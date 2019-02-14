<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 13 Feb 2019 21:13:37 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class MstroTpsPrd
 * 
 * @property int $id_tp_prd
 * @property string $cod_tp_prd
 * @property string $nom_tp_prd
 * @property bool $web
 * @property bool $inactivo
 * 
 * @property \Illuminate\Database\Eloquent\Collection $productos
 *
 * @package App\Models
 */
class MstroTpsPrd extends Eloquent
{
	protected $table = 'mstro_tps_prd';
	protected $primaryKey = 'id_tp_prd';
	public $timestamps = false;
	protected $dateFormat = 'd-m-Y H:i:s';

	protected $casts = [
		'web' => 'bool',
		'inactivo' => 'bool'
	];

	protected $fillable = [
		'cod_tp_prd',
		'nom_tp_prd',
		'web',
		'inactivo'
	];

	public function productos()
	{
		return $this->hasMany(\App\Models\Producto::class, 'id_tp_prd');
	}
}
