<?php

namespace App\Http\Controllers;

use App\Helpers\Images;
use App\Helpers\Users;
use Auth;
use Cache;
use DB;
use Illuminate\Http\Request;
use Redirect;

class DashBoardController extends Controller
{
    public function __construct(){
          $this->middleware('auth');
    }

    public function Index(){

       $id_terc  = Users::getIdTercero();
       $nom_user = Users::Name( $id_terc);
       $avatar   = Images::UserAvatar ( $id_terc  ) ;

      return view('dashboard.index', compact ('nom_user','avatar'));
    }





}
