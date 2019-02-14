<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 13 Feb 2019 21:15:44 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class WebPrdSubCateg
 * 
 * @property int $id_sub_categ
 * @property int $id_categ
 * @property string $nom_sub_categ
 * @property bool $inactivo
 * 
 * @property \App\Models\WebPrdCateg $web_prd_categ
 * @property \Illuminate\Database\Eloquent\Collection $productos_prsntciones
 *
 * @package App\Models
 */
class WebPrdSubCateg extends Eloquent
{
	protected $table = 'web_prd_sub_categ';
	protected $primaryKey = 'id_sub_categ';
	public $timestamps = false;
	protected $dateFormat = 'd-m-Y H:i:s';

	protected $casts = [
		'id_categ' => 'int',
		'inactivo' => 'bool'
	];

	protected $fillable = [
		'id_categ',
		'nom_sub_categ',
		'inactivo'
	];

	public function web_prd_categ()
	{
		return $this->belongsTo(\App\Models\WebPrdCateg::class, 'id_categ');
	}

	public function productos_prsntciones()
	{
		return $this->hasMany(\App\Models\ProductosPrsntcione::class, 'id_sub_categ');
	}
}
