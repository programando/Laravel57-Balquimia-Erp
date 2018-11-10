<?php
namespace App\Helpers;

class Images {

    public static function UserAvatar( $Id_Terc) {
        $path   = asset('storage/images/users/');
        $avatar = $path . '/user_id_terc_'. $Id_Terc.'.png';
        return $avatar;
    }
}
