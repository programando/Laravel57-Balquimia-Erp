<?php
namespace App\Helpers;

use Carbon\Carbon;

class Fechas {

     /* ENERO 21 2019
        VALIDA QUE LA FECHA DE DESPACHO SEA VALIDA */
    public static function pedidosFechaDspachoValidar( $FechaDespacho ) {
        $FechaDespacho = Carbon::parse($FechaDespacho)->format('Y-m-d');
        $Hoy           = Carbon::now()->format('Y-m-d');
        if ( $FechaDespacho < $Hoy ){
            $FechaDespacho = $Hoy;
        }
        return Carbon::parse( $FechaDespacho );
    }


}


