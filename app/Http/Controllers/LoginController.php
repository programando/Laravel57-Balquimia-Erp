<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;

use App\Events\LoginSendMailResetPassword;
/** MODELS **/
use \App\Models\Frase;
use \App\Models\TercerosUser        as Terceros;
use \App\Models\TercerosUsersToken  as UserToken;

use Carbon\Carbon;


/** FACADES **/
//***************//

use Auth;
use Cache;
use DB;
use Redirect;
use Session;



class LoginController extends Controller
{
    public function ShowLogin(){
          $Frases = DB::select(' call frases_qry_dia() ');
          $Frase   = $Frases[0]->nom_frase;
          $Autor   = $Frases[0]->autor;
          return view('login.login', compact('Frase','Autor'));
    }
//
  public function PostLogin(LoginRequest $FormData){
        $email    = $FormData->email;
        $password = $FormData->password;
        $remember = $FormData->remember_me;
         if (Auth::attempt( [
                  'email'    => $email,
                  'password' => $password,
                  'inactivo' => 0,
                  'empleado' => 1 ],
                  $remember ) ) {
                //return Redirect::intended();
           return Redirect('/');
              }
           //En caso de que no pueda loguearse
           return Redirect('/login')
                ->withInput( $FormData->only('email','remember_me'))
                ->withErrors( ['email' =>  trans('_app.email_pass_error') ] );
    }


    public function getLogOut() {
            /*Auth::logout();
            Session::flush();
            Cache::flush();
            return redirect('/login');*/
            //return "Mensaje de prueba";
            dd("Mensaje de salida");
    }

    public function PasswordRememberShowForm () {
        return view('login.passwors-reset-show-form');
      }


     public function PasswordResetSendMail ( LoginRequest $FormData ) {

         $email    = $FormData->input('email');
         $registro = Terceros::where('email', $email )->first();

        // Si no es empleado o no está activo... no puedo enviarle correo
         if ( ! $registro->empleado && ! $registro->activo ){
           return Redirect()->route('reset-password')
                ->withInput( $FormData->only('email','remember_me'))
                ->withErrors( ['email' =>  trans('_app.email_error') ] );
         }
         $token                 = str_random(100);

         //Iniciar Evento envio correo
         LoginSendMailResetPassword::dispatch( $email, $token );
          //Graba el Token en la base de datos
          $this->TokenSave(   $email , $token);
          //muestra mensaje confirmación de envío de correo
           return view('login.passwors-reset-show-msg-ok')->with('email',$email);
        }




      public function UpdatePasswordShowForm( $token ){
         $User = UserToken::where('token',$token)->first();
           if ( !$User )
              return Redirect('reset-password')->with('error',trans('_app.token_invalid'));

            $expira = $User->expira_en;
            $tiempo =  $expira->diffInMinutes();
            $email  = $User->email;

            if ( $tiempo > 15 ){
                $User->delete();
                return Redirect('reset-password')->with('error',trans('_app.token_expirado'));
              }
             return view('login.password-update', compact('token','email'));
      }


      public function UpdatePassword(   LoginRequest $FormData ){
             $User = Terceros::whereEmail( $FormData->email )->first();
             if ( !$User ){
                return abort(404);
             }
             $User->password = $FormData->password;
             $User->save();
             //--------------------------------------//
             $this->TokenDelete( $FormData->email );
             Auth::login( $User );
             return Redirect('/');
      }



        private function TokenSave( $email, $token ){
            $this->TokenDelete( $email );
           /** GRBAR EL TOKEN EN LA BASE DE DATOS **/
           $Token            = new UserToken;
           $Token->email     = $email;
           $Token->token     = $token;
           $Token->expira_en = Carbon::now()->addMinute(10) ;
           $Token->save();
        }



        private function TokenDelete( $email ) {
           /** BORRAR EL REGISTRO SI EXISTE **/
           $registro = UserToken::where('email',$email)->first();
           if ( $registro ) { $registro->delete(); }

        }



}
