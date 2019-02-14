<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 13 Feb 2019 21:12:43 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class MstroDanePrdGrp
 * 
 * @property int $id_cls_dane_prd
 * @property string $nom_cls_dane_prd
 * @property string $ciiu
 * @property bool $inactivo
 * 
 * @property \Illuminate\Database\Eloquent\Collection $productos
 *
 * @package App\Models
 */
class MstroDanePrdGrp extends Eloquent
{
	protected $primaryKey = 'id_cls_dane_prd';
	public $timestamps = false;
	protected $dateFormat = 'd-m-Y H:i:s';

	protected $casts = [
		'inactivo' => 'bool'
	];

	protected $fillable = [
		'nom_cls_dane_prd',
		'ciiu',
		'inactivo'
	];

	public function productos()
	{
		return $this->hasMany(\App\Models\Producto::class, 'id_cls_dane_prd');
	}
}
