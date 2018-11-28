<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tercero as Terceros;

use DB;

class TercerosController extends Controller {

  public function ClientesFacturas(){
      //$Cliente = Terceros::with('Notas')->with('Contactos')->where('id_terc','4167')->get();
      //$Cliente = Terceros::with('Facturas.Detalle.Productos')->where('id_terc','4167')->get();
     // $Cliente = Terceros:.whereHas('factura', function($factura)){
     //       aqui el código
     // }->find($id_cliente)
    //->select('nro_identif','id_terc','nom_sys','nom_suc', DB::raw('CONCAT(nro_identif, " " , nom_sys) as status'))

      return 'Ok';
  }

    public function ClientesBusqueda(Request $FormData ){
        $Filtro =  $FormData->filtro;
        if ( !$Filtro ){
                      $Clientes = Terceros::Clientes()
                    ->select('nro_identif','id_terc','nom_sys','nom_suc')
                    ->orderBy('nom_sys')->take(10)->get();
        }else {
          $Clientes = Terceros::Clientes()
                      ->Where('nom_sys','like', '%'.$Filtro .'%')
                      ->orWhere('nom_suc','like', '%'.$Filtro .'%')
                      ->orWhere('nro_identif','like', '%'.$Filtro .'%')
                      ->select('nro_identif','id_terc','nom_sys','nom_suc')
                      ->orderBy('nom_sys')->get();
            }
        return  $Clientes;
    }

    public function VendedoresCliente ( Request $FormData ){
        $id_terc      = $FormData->id_terc;
        $DatosCliente = Terceros::with('Municipio')->findOrFail( $id_terc );
        $Vendedores   = DB::select(' call clientes_busca_vendedores (?)', array($id_terc));
        $Vendedores   = collect($Vendedores);
        return ['Vendedores' => $Vendedores, 'Cliente' => $DatosCliente];
    }

    public function Compras ( Request $FormData ){
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
