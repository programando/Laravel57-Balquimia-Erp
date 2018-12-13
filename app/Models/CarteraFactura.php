<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 05 Dec 2018 20:19:26 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\DB;

class CarteraFactura extends Eloquent
{
	protected $primaryKey = 'id_crtra';
	public $timestamps = false;


	protected $casts = [ 'id_terc' => 'int',   'id_fact' => 'int',   'plazo_fact' => 'int',    'id_terc_usu' => 'int',
		                    'vr_saldo' => 'float',  'pgar_provee' => 'bool',    'factoring' => 'bool'
	];

	protected $dates = [ 'fcha_fact', 'created_at'
	];

	protected $fillable = [ 'tp_crtra',  'id_terc',  'id_fact',  'fcha_fact',  'plazo_fact',
		                      'id_terc_usu',  'vr_saldo',   'pgar_provee',    'nro_remis',  'factoring'
	];


	public function CarteraDt()	{
		return $this->hasMany(\App\Models\CarteraFacturasDt::class, 'id_crtra');
	}

