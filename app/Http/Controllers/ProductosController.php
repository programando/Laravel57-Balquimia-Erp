<?php

namespace App\Http\Controllers;
use App\Models\Producto as Productos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductosController extends Controller
{

    public function ProductosPresentacionesActivos( Request $FormData ){
        $DatoAbuscar =  $FormData->filtro;
        //$Productos = Productos::with('Presentaciones')->ProductosActivos($BuscarDato)
         // ->orderBy('nom_prd')->get();
        $Productos   = DB::select(' call productos_activos_lista_precios (?)', array($DatoAbuscar));
        return $Productos;
    }

}
