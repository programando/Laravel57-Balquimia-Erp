<?php

namespace App\Models;

use App\Helpers\Strings;
use Illuminate\Database\Eloquent\Model;

class MstroCargo extends Model
{
  protected $primaryKey = 'id_cargo';
  protected $table      = 'mstro_cargos';
  /*  $appends
        agrega un campo con el nombre que yo quiera para tenerlo disponible en el modelo
        sin modificar la tabla
  */
  protected $appends    =['id_reg','nom_reg'];
  public    $timestamps = false;

  protected $casts = [
    'inactivo' => 'bool'
  ];

  protected $fillable = [
    'cod_cargo',
    'nom_cargo',
    'inactivo'
  ];

    public function setNomCargoAttribute ( $value ){
        $this->attributes['nom_cargo'] = Strings::UpperTrim ( $value,49);
    }

/** ACCESORES
    Retornan el contenido del campo renombrando la variable de salida
**/
    public function getIdRegAttribute(){
        return $this->attributes['id_cargo'];
    }

    public function getNomRegAttribute(){
        return $this->attributes['nom_cargo'];
    }

}
