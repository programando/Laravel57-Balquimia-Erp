<?php
//app/Helpers/Envato/User.php
namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class Users {
    /**
     * @param int $user_id User-id
     *
     * @return string
     */
    public static function Name( $Id_Terc) {
        $user = DB::table('terceros')->where('id_terc', $Id_Terc)->first();
        return (isset($user->pnombre) ? $user->pnombre : 'No reconocido');
    }
}
