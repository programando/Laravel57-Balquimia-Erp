<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 13 Feb 2019 21:15:34 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class WebPrdCateg
 * 
 * @property int $id_categ
 * @property string $nom_categ
 * @property float $dvsor_grp_b
 * @property float $dvsor_grp_b1
 * @property bool $inactivo
 * 
 * @property \Illuminate\Database\Eloquent\Collection $web_prd_sub_categs
 *
 * @package App\Models
 */
class WebPrdCateg extends Eloquent
{
	protected $table = 'web_prd_categ';
	protected $primaryKey = 'id_categ';
	public $timestamps = false;
	protected $dateFormat = 'd-m-Y H:i:s';

	protected $casts = [
		'dvsor_grp_b' => 'float',
		'dvsor_grp_b1' => 'float',
		'inactivo' => 'bool'
	];

	protected $fillable = [
		'nom_categ',
		'dvsor_grp_b',
		'dvsor_grp_b1',
		'inactivo'
	];

	public function web_prd_sub_categs()
	{
		return $this->hasMany(\App\Models\WebPrdSubCateg::class, 'id_categ');
	}
}
