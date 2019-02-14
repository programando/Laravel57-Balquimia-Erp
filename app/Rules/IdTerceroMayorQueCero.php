<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class IdTerceroMayorQueCero implements Rule
{

    public function passes($attribute, $value) {
        return  $value > 0 ;
    }

    public function message()  {
        return 'No ha seleccionado un tercero (cliente, empleado o proveedor)';
    }
}
