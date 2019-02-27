<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Helpers\Fechas;
use App\Helpers\Users;
use App\Models\Pedido as Pedidos;
use App\Models\PedidosDt ;
use App\Rules\IdTerceroMayorQueCero;

use  Carbon\Carbon;
use DB;

class PedidosController extends Controller
{

    public function Grabar ( Request $FormData) {

        $this->validate($FormData ,
                [ 'id_terc'    => ['required', new IdTerceroMayorQueCero],
                  'fcha_dspcho'=>'required'
                ]);

        try{
          DB::beginTransaction();
            $Pedido              = new Pedidos ;
            $Pedido->fcha_dspcho = Fechas::pedidosFechaDspachoValidar( $FormData->fcha_dspcho );
            $Pedido->id_terc_cli = $FormData->id_terc;
            $Pedido->id_terc_usu = Users::User()->id_terc;
            $Pedido->fcha_ped    = Carbon::now();
            $Pedido->id_stdo     = 0;
            //$Pedido->num_ord_cpra = $FormData->num_ord_cpra ? !empty($FormData->num_ord_cpra) : '';
            $Pedido->num_ord_cpra = $FormData->input('num_ord_cpra','');
            $Pedido->save();
            $DetallePedido =  $FormData->get('detalle');

            foreach($DetallePedido as $ep=>$datos)    {
                  $ItemDt = new PedidosDt();
                  $ItemDt->id_ped          = $Pedido->id_ped;
                  $ItemDt->id_prd          = $datos['id_prd'];
                  $ItemDt->cant            = $datos['cant'];
                  $ItemDt->vr_precio_lista = $datos['vr_precio_lista'];
                  $ItemDt->vr_flete        = $datos['vr_flete'];
                  $ItemDt->vr_fnacion      = $datos['vr_fnacion'];
                  $ItemDt->vr_precio_adic  = $datos['vr_precio_adic'];
                  $ItemDt->vr_dscto        = $datos['vr_dscto'];
                  $ItemDt->pcje_iva        = $datos['pcje_iva'];
                  $ItemDt->vr_iva          = $datos['vr_iva'];
                  $ItemDt->vr_unit_real    = $datos['vr_unit_real']/$datos['cant'];
                  $ItemDt->vt_tot_item     = $ItemDt->vr_unit_real  * $ItemDt->cant ;
                  $ItemDt->save();
              }
            DB::commit();
            return  $Pedido ;
              } catch (Exception $e){
                  DB::rollBack();
                   return  '!OK' ;
              }

    }

}
