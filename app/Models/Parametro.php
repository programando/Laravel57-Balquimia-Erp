<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 14 Feb 2019 18:15:41 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;


class Parametro extends Eloquent
{
	protected $primaryKey = 'id_param';
	public $timestamps = false;
	protected $dateFormat = 'd-m-Y H:i:s';

	protected $casts = [
		'anio' => 'int',
		'pcje_iva' => 'float'
	];

	protected $fillable = [
		'anio',
		'pcje_iva'
	];
}
