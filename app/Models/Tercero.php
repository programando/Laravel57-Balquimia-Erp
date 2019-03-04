<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 27 Nov 2018 22:09:11 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use App\Helpers\Strings;

class Tercero extends Eloquent
{
  //protected $dateFormat = 'd-m-Y H:i:s';
  protected $primaryKey = 'id_terc';
  public    $timestamps = false;

	protected $casts = [
    'id_tp_doc'         => 'int',             'id_mcipio'         => 'int',             'cliente'           => 'bool',
    'id_zn_vta'         => 'int',             'id_linea_cli'      => 'int',             'id_sub_linea_cli'  => 'int',
    'plazo_fact'        => 'int',             'cupo'              => 'float',           'dia_max_fact'      => 'bool',
    'auto_rete'         => 'bool',            'gran_cbuye'        => 'bool',            'id_terc_vend_ppal' => 'int',
    'id_terc_vend_secd' => 'int',             'excento_iva'       => 'bool',            'rte_fte'           => 'bool',
    'rte_iva'           => 'bool',            'rte_ica'           => 'bool',            'rte_cree'          => 'bool',
    'terc_web'          => 'bool',            'id_terc_padre'     => 'int',             'proveedor'         => 'bool',
    'transpdor'         => 'bool',            'prov_eps'          => 'bool',            'prov_arp'          => 'bool',
    'prov_afp'          => 'bool',            'prov_csant'        => 'bool',            'prov_caja'         => 'bool',
    'empleado'          => 'bool',            'id_cargo'          => 'int',             'liq_nomi'          => 'bool',
    'usuario'           => 'bool',            'vend'              => 'bool',            'vend_free'         => 'bool',
    'vend_listados'     => 'bool',            'vend_id_linea'     => 'int',             'transp_prd'        => 'bool',
    'vr_sueldo'         => 'float',           'vr_aux_alim'       => 'float',           'vr_aux_cel'        => 'float',
    'vr_aux_vehic'      => 'float',           'vr_aux_transp'     => 'float',           'id_terc_eps'       => 'int',
    'id_terc_afp'       => 'int',             'id_terc_arp'       => 'int',             'id_terc_csant'     => 'int',
    'id_terc_caja'      => 'int',             'id_nv_rsgo'        => 'int',             'inactivo'          => 'bool',
    'id_cls_pyg'        => 'int',             'revisado'          => 'bool'
	];

	protected $dates = [  'fcha_ing', 'fcha_cupo',   'fcha_nace',  'fcha_contrato',    'fcha_retiro',  'fcha_rut_upd'  	];

	protected $fillable = ['nro_identif',  'dv',   'id_tp_doc',    'pnombre',    'snombre',    'papellido',    'sapellido',
  	                     'razon_soc',    'nom_ccial',    'nom_suc',    'nom_fact',      'email',    'direcc',
		                     'id_mcipio',   'nro_tel',    'nro_cel',    'cliente',    'id_zn_vta',  'id_linea_cli',   'id_sub_linea_cli',
		                     'fcha_ing',    'plazo_fact',   'cupo', 'fcha_cupo',  'dia_max_fact', 'tp_persona', 'auto_rete',  'gran_cbuye',
		                      'regimen',  'id_terc_vend_ppal',  'id_terc_vend_secd',  'cod_ciiu', 'actv_ica', 'excento_iva',  'rte_fte',
		                      'rte_iva',    'rte_ica',  'rte_cree',   'terc_web',   'terc_web_cod',   'id_terc_padre',    'proveedor',
		                      'transpdor',  'prov_eps',   'prov_arp',   'prov_afp',   'prov_csant',   'prov_caja',  'empleado',
		                      'id_cargo',   'liq_nomi',   'usuario',    'vend',     'vend_free',      'vend_cod',   'vend_listados',
		                      'vend_nom_fact',  'vend_id_linea',    'transp_prd',   'fcha_nace',      'vr_sueldo',    'vr_aux_alim',
		                      'vr_aux_cel', 'vr_aux_vehic',   'vr_aux_transp',    'id_terc_eps',    'id_terc_afp',    'id_terc_arp',
		                      'id_terc_csant',	'id_terc_caja',  'id_nv_rsgo',   'fcha_contrato',    'fcha_retiro',    'inactivo',
		                      'id_cls_pyg', 'fcha_rut_upd',   'revisado'
	];
/***************/
/* MUTATORS */
/***************/
  public function setPnombreAttribute( $value ){
        $this->attribute ['pnombre'] = Strings::UpperTrim ($value , 30);
  }
  public function setSnombreAttribute( $value ){
        $this->attribute ['snombre'] = Strings::UpperTrim ($value , 30);
  }
  public function setPapellidoAttribute( $value ){
        $this->attribute ['papellido'] = Strings::UpperTrim ($value , 30);
  }
  public function setSapellidoAttribute( $value ){
        $this->attribute ['sapellido'] = Strings::UpperTrim ($value , 30);
  }
    public function setRazonSocAttribute( $value ){
        $this->attribute ['razon_soc'] = Strings::UpperTrim ($value , 100);
  }

/*********************/
/* RELACIONES  */
/*******************/
	public function Cargo()	{
		return $this->belongsTo(\App\Models\MstroCargo::class, 'id_cargo');
	   }

	public function ClaseEmpleadoPyg()	{
		return $this->belongsTo(\App\Models\MstroNominaPygClase::class, 'id_cls_pyg');
	   }

	public function Linea()	{
		return $this->belongsTo(\App\Models\MstroLinea::class, 'vend_id_linea');
	   }
  public function ZonaVentas()  {
      return $this->belongsTo(\App\Models\MstroMunicipio::class, 'id_zn_vta');
      }

	public function NivelRiesgo()	{
		return $this->belongsTo(\App\Models\MstroNvsRiesgo::class, 'id_nv_rsgo');
	   }

	public function SubLinea()	{
		return $this->belongsTo(\App\Models\MstroLineasSubLinea::class, 'id_sub_linea_cli');
	   }

	public function TipoDocumento()	{
		return $this->belongsTo(\App\Models\MstroTpsDoc::class, 'id_tp_doc');
	   }

	public function Municipio()	{
		return $this->belongsTo(\App\Models\MstroMunicipio::class, 'id_mcipio');
	   }

	public function Contactos()	{
		return $this->hasMany(\App\Models\TercerosContacto::class, 'id_terc');
	   }

	public function Notas()	{
		return $this->hasMany(\App\Models\TercerosNota::class, 'id_terc');
	   }

	public function Usuario()	{
		return $this->hasOne(\App\Models\TercerosUser::class, 'id_terc');
	   }
    public function Vendedor() {
    return $this->hasOne(\App\Models\Tercero::class, 'id_terc_vend_ppal');
    }



    public function Cartera(){
      return $this->hasMany(\App\Models\CarteraFactura::class, 'id_terc');
    }

    public function Facturas() {
        return $this->hasMany(\App\Models\Factura::class, 'id_terc_usu_inactvo');
      }

      public function FacturasDt()
      {
        return $this->hasMany(\App\Models\FacturasDt::class, 'id_terc_vend');
      }

      public function Pedidos() {
        return $this->hasMany(\App\Models\Pedido::class, 'id_terc_usu');
      }

      public function LineasAsociadas() {
        return $this->hasMany(\App\Models\TercerosLineasAsoc::class, 'id_terc');
      }





   /*//////////////////////////////////////
        SCOPES
   *//////////////////////////////////////
       public function scopeClientes($query){
            return $query->Where('cliente','=','1');
        }

        public function scopeClientesActivos($query){
            return $query->Where('cliente','1')
                  ->Where('inactivo','0')
                  ->Where('terc_web', '0');
        }

        public function scopeNomFullSucNitNomCcial ( $query, $Filtro){
           return $query
                    ->Where('nom_full'         ,'LIKE'   , "%$Filtro%")
                    ->orWhere('nom_suc'       ,'LIKE'   , "%$Filtro%")
                    ->orWhere('nro_identif'   ,'LIKE'   , "%$Filtro%")
                    ->orWhere('nom_ccial'     ,'LIKE'   , "%$Filtro%");
        }

        public function scopePorLineas ( $query, $Lineas ){
            return $query->whereIn('id_linea_cli', $Lineas );

        }



}
