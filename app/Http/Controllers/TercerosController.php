<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tercero as Terceros;
use App\Models\TercerosLineasAsoc as LineasAsoc;


use DB;

class TercerosController extends Controller {

   public function ClientesBusqueda(Request $FormData ){
          $BuscarDato =  $FormData->filtro;
          $Clientes = Terceros::ClientesActivos()
                      ->NomFullSucNitNomCcial( $BuscarDato )
                      ->select('nro_identif','id_terc','nom_full','nom_suc')
                      ->orderBy('nom_full')->get();
        return  $Clientes;
    }

    public function Lineas(){
        $LineasAsociadas =  LineasAsoc::LineasAsociadas(76);
       // return LineasAsoc::all()->keyBy('id_linea');
        $Clientes = Terceros::PorLineas( $LineasAsociadas )->get();
        return $Clientes;
    }


    public function ClientesVendedorPrincipal ( Request $FormData ){
        $id_terc      = $FormData->id_terc;
        $DatosCliente = Terceros::with(['Municipio'])->findOrFail( $id_terc );
        $Vendedores   = DB::select(' call clientes_busca_vendedores (?)', array($id_terc));
        $Vendedores   = collect($Vendedores);
        return ['Vendedores' => $Vendedores, 'Cliente' => $DatosCliente];
    }

    public function ClientesProductosComprados ( Request $FormData ){
        $id_terc = $FormData->id_terc;
        $Ventas  = DB::select(' call clientes_productos_comprados (?)', array($id_terc));
        $Ventas  = collect($Ventas);
        return $Ventas;
    }

    public function NotasVenta ( Request $FormData ){
        $id_terc = $FormData->id_terc;
        $Notas   = DB::select(' call terceros_notas_ventas_x_id_terc (?)', array($id_terc));
        $Notas   = collect($Notas);
        return $Notas;
    }


    public function NotasCartera ( Request $FormData ){
        $id_terc = $FormData->id_terc;
        $Notas   = DB::select(' call terceros_notas_cartera_x_id_terc (?)', array($id_terc));
        $Notas   = collect($Notas);
        return $Notas;
    }

    public function Contactos(Request $FormData ){
        $id_terc   = $FormData->id_terc;
        $Contactos = DB::select(' call terceros_conctactos_x_id_terc (?)', array($id_terc));
        $Contactos = collect($Contactos);
        return $Contactos;
    }


}
