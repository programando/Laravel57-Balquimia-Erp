<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CarteraController extends Controller
{
      public function ClientesFacturasPdtePago ( Request $FormData){
           //$Id_Terc = $FormData->id_terc;
           $Id_Terc               = 4167;
           $Facturas              = DB::select(' call cartera_clientes_facturas_x_pago ( ? ) ', array( $Id_Terc ));
           $Acumulado             = 0;
           $TieneFacturasVencidas = 0;
            foreach ($Facturas as $Factura ) {
                if ( $Factura->dias_a_hoy > $Factura->plazo_fact){
                    $Acumulado = $Acumulado + $Factura->vr_tot_fact;
                    $Factura->vr_acum_vencido = $Acumulado ;
                  }
            }
           return  $Facturas;
  }
}

