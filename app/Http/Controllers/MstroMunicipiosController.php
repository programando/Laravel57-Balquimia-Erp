<?php


namespace App\Http\Controllers;

use App\Models\MstroMunicipio as Municipios;
use Cache;
use Illuminate\Http\Request;

class MstroMunicipiosController extends Controller{


    public function listadoGeneral(){
        $Municipios = Cache::tags('Municipios.All')->rememberForever('Municipios.All', function(){
            return   $Municipios = Municipios::with('Departamentos')
              ->where([
                        ['id_mcpio' , '>'  , '0'],
                        ['nom_mcpio', '<>' ,  ''],
                      ])
              ->orderBy('nom_mcpio')
              ->get();
        });
        return $Municipios;
    }


}
