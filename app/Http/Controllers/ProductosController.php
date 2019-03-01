<?php

namespace App\Http\Controllers;
use App\Models\Producto as Productos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Cache;
class ProductosController extends Controller
{

    public function ProductosPresentacionesActivos( Request $FormData ){
        $DatoAbuscar = $FormData->filtro;
        $Productos   = DB::select(' call prd_activos_precios_x_nom_prd  (?)', array($DatoAbuscar));
        return $Productos;
    }

    public function PrecioProductos(){
        $ProductosPrecios = Cache::tags('ProductosPrecios')->rememberForever('ProductosPrecios', function()  {
              return     DB::select(' call prd_activos_precios_x_lista_gral ()');
        });
        return $ProductosPrecios;
    }

}
