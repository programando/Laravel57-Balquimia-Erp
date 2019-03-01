<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ParametrosFlete as Fletes ;
use Cache;

class FletesController extends Controller {

        private $dscto_ccial          = 0 ,   $es_Reexpedicion      = false  ,         $flete_min_vr         = 0 ;
        private $ped_id_dpto          = 0 ,   $ped_id_mcpio         = 0 ,              $ped_peso_kg          = 0 ;
        private $ped_unidades         = 0 ,   $ped_vr_dclrdo        = 0 ,              $peso_cobar           = 0 ;
        private $vr_flete             = 0 ,   $vr_flete_redetrans   = 0  ,             $vr_kg_rdtrans        = 0 ;
        private $vr_kg_rdtrans_rexped = 0 ,   $vr_seguro            = 0 ,              $vr_seguro_min        = 0 ;
        private $vr_kg_laPrensa       = 0 ,   $vr_kg_laPrensa_reex  = 0,               $vrFleteLaPrensa  = 0 ;
        private $cto_mnjo_laPrensa    = 0 ,   $vr_flete_laprensa    = 0;


      public function fletesRedeTrans( Request $FormData ){
            $this->parametrosFletes();
            /*======================== REDE-TRANS ================================================*/
            $this->redeTransAsignacionParametros( $FormData  );
            $this->redeTransVerificaReExpedicion();
            $this->redeTransUrbano();
            $this->redeTransRegional();
            $this->redeTransNacional();
            $this->redeTransReExpedicion();
            $this->redeTransVrFleteDescuentoComercial();
            $this->redeTransVrSeguro();
            $this->redeTransAplicaUtilidadEmpresa();
            /*======================== TRANSPORTES LA PRESA =====================================*/
            $this->laPrensaVerificarReExpedicion();
            $this->laPrensaCalcularVrFlete();
            $this->laPrensaUrbano();
            //$this->laPrensaRegional();
            //$this->laPrensaNacional();
            //$this->laPrensaReExpedicion();
            $this->laPrensaCostoManejo();

            $response = $this->valoresTotalesFletes();
            return $response ;
      }



      private function parametrosFletes(){
          $this->redeTrans = Cache::tags('FletesRedeTrans')->rememberForever('FletesRedeTrans', function() {
                  $redeTransParamFletes = Fletes::RedeTrans()->get();
                  return $redeTransParamFletes[0];
          });
          $this->laPrensa = Cache::tags('LaPrensa')->rememberForever('LaPrensa', function() {
                  $laPrensaParamFletes = Fletes::LaPrensa()->get();
                  return $laPrensaParamFletes[0];
          });
      }

      private function laPrensaVerificarReExpedicion(){
          if ( $this->vr_kg_laPrensa_reex > 0 ){
              $this->es_Reexpedicion = true;
              $this->vr_kg_laPrensa  = $this->vr_kg_laPrensa_reex ;
          }
      }

      private function laPrensaCalcularVrFlete(){
         if (  $this->es_Reexpedicion == true ) {
            $this->vrFleteLaPrensa = $this->laPrensa['reex_peso_min'] * $this->ped_unidades;
            $this->vrFleteLaPrensa = $this->vrFleteLaPrensa * ( $this->vr_kg_laPrensa  - ( $this->vr_kg_laPrensa * (  $this->laPrensa['cto_mnjo_reex'] /100) ) ) ;
         }else {
            $this->vrFleteLaPrensa = $this->laPrensa['urb_peso_min'] * $this->ped_unidades;
            $this->vrFleteLaPrensa = $this->vrFleteLaPrensa * ( $this->vr_kg_laPrensa  - ( $this->vr_kg_laPrensa * (  $this->laPrensa['dscto_ccial'] /100) ) ) ;
         }
      }

      private function laPrensaUrbano() {
         if  ( $this->es_Reexpedicion == true )                        return ;
         if  ( $this->ped_id_dpto != 32 || $this->ped_id_mcpio <> 153  ) return ;
         if  ( $this->vrFleteLaPrensa < $this->laPrensa['urb_flete_min_vr'] ) {
               $this->vrFleteLaPrensa = $this->laPrensa['urb_flete_min_vr'];
         }
      }

      private function laPrensaRegional() {
          if  ( $this->es_Reexpedicion == true  ) return ;
          if ($this->ped_id_dpto == 32 && $this->ped_id_mcpio != 153  ) {
              if ( $this->vrFleteLaPrensa < $this->laPrensa['reg_flete_min_vr'] ) {
                  $this->vrFleteLaPrensa = $this->laPrensa['reg_flete_min_vr'];
              }
          }
      }

      private function laPrensaNacional() {
          if  ( $this->es_Reexpedicion  == true ) return ;
          if ( $this->ped_id_dpto != 32 ) {
               if ( $this->vrFleteLaPrensa < $this->laPrensa['nac_flete_min_vr'] ) {
                  $this->vrFleteLaPrensa = $this->laPrensa['nac_flete_min_vr'];
              }
          }
      }

      private function laPrensaReExpedicion() {
          if  ( $this->es_Reexpedicion  == true ) {
              if ( $this->vrFleteLaPrensa < $this->laPrensa['reex_flete_min_vr'] ) {
                  $this->vrFleteLaPrensa = $this->laPrensa['reex_flete_min_vr'];
              }
          }
      }

      private function laPrensaCostoManejo(){
        $cto_mnjo          = $this->laPrensa['cto_mnjo']/100;
        $cto_mnjo_reex     = $this->laPrensa['cto_mnjo_reex']/100;
        $cto_mnjo_und      = $this->laPrensa['cto_mnjo_und'];
        $cto_mnjo_und_reex = $this->laPrensa['cto_mnjo_und_reex'];

        if ( $this->es_Reexpedicion == true ){
            if ( ($this->ped_vr_dclrdo *  $cto_mnjo_reex ) > ( $this->ped_unidades * $cto_mnjo_und_reex ) ){
                $this->cto_mnjo_laPrensa = $this->ped_vr_dclrdo  *  $cto_mnjo_reex;
            }else {
                $this->cto_mnjo_laPrensa = $this->ped_unidades  * $cto_mnjo_und_reex;
              }
           }

       if ( $this->es_Reexpedicion == false ){
          if ( ($this->ped_vr_dclrdo *  $cto_mnjo ) > ( $this->ped_unidades * $cto_mnjo_und ) ){
               $this->cto_mnjo_laPrensa = $this->ped_vr_dclrdo  *  $cto_mnjo;
              }else {
                 $this->cto_mnjo_laPrensa = $this->ped_unidades  * $cto_mnjo_und;
              }
            }
            $pcte_utilidad              = ( 100 - $this->redeTrans['pcje_utldad_bq'] ) / 100;
            $this->vr_flete_laprensa    = ( $this->vrFleteLaPrensa + $this->cto_mnjo_laPrensa ) / $pcte_utilidad ;
      }


      private function redeTransAplicaUtilidadEmpresa(){
            $pcte_utilidad              = ( 100 - $this->redeTrans['pcje_utldad_bq'] ) / 100;
            $this->vr_flete_redetrans   =  ( $this->vr_flete + $this->vr_seguro )   /  $pcte_utilidad ;
      }


      private function redeTransAsignacionParametros( $Parametros ){
           /*======================== DATOS DEL PEDIDO  =================================*/
           $this->ped_id_dpto          = $Parametros->ped_id_dpto;
           $this->ped_id_mcpio         = $Parametros->ped_id_mcpio;
           $this->ped_peso_kg          = $Parametros->ped_peso_kg;
           $this->ped_unidades         = $Parametros->ped_unidades;
           $this->ped_vr_dclrdo        = $Parametros->ped_vr_dclrdo;
           /*======================== REDE-TRANS ================================================*/
           $this->vr_kg_rdtrans        = $Parametros->vr_kg_rdtrans;
           $this->vr_kg_rdtrans_rexped = $Parametros->vr_kg_rdtrans_rexped;
           /*======================== TRANSPORTES LA PRESA =====================================*/
           $this->vr_kg_laPrensa       = $Parametros->vr_kg_transprensa;
           $this->vr_kg_laPrensa_reex  = $Parametros->vr_kg_transprensa_rexped;

      }

      private function redeTransVerificaReExpedicion(){
          $this->es_Reexpedicion = false;
          if ( $this->vr_kg_rdtrans_rexped > 0 ){
                 $this->es_Reexpedicion = true ;
                 $this->vr_kg_rdtrans   = $this->vr_kg_rdtrans_rexped;
            }
      }

      private function redeTransUrbano() {
         if  ( $this->es_Reexpedicion == true )               return ;
         if ($this->ped_id_dpto != 32 || $this->ped_id_mcpio <> 153  ) return ;

         if ( $this->ped_unidades < 2 ){
              $this->peso_cobar = $this->redeTrans['urb_peso_min'];
         }else {
            $this->peso_cobar = $this->redeTrans['urb_peso_min_cajas'] * $this->ped_unidades;
         }
         $this->redeTransEvaluarPesoMinimo();
         $this->redeTransFleteMinFleteVariable('urb');

      }

      private function redeTransRegional() {
          if  ( $this->es_Reexpedicion == true  ) return ;

          if ($this->ped_id_dpto == 32 && $this->ped_id_mcpio != 153  ) {
              if ( $this->ped_unidades < 2 ){
                  $this->peso_cobar = $this->redeTrans['reg_peso_min'];
             }else {
                $this->peso_cobar = $this->redeTrans['reg_peso_min_cajas'] * $this->ped_unidades;
             }
             $this->redeTransEvaluarPesoMinimo();
             $this->redeTransFleteMinFleteVariable('reg');
          }
      }


      private function redeTransNacional() {
          if  ( $this->es_Reexpedicion  == true ) return ;

          if ( $this->ped_id_dpto != 32 ) {

              if ( $this->ped_unidades < 2 ){
                  $this->peso_cobar = $this->redeTrans['nac_peso_min'];
             }else {
                $this->peso_cobar = $this->redeTrans['nac_peso_min_cajas'] * $this->ped_unidades;
             }

             $this->redeTransEvaluarPesoMinimo();
             $this->redeTransFleteMinFleteVariable('nac');
         }
      }

      private function redeTransReExpedicion() {
           if  ( $this->es_Reexpedicion == false ) return ;
           $this->peso_cobar       = $this->redeTrans['reex_peso_min'];
           $this->flete_min_vr     = $this->vr_kg_rdtrans *  $this->peso_cobar  * $this->ped_unidades ;
           $this->flete_vrble_pcje = $this->redeTrans['reex_flete_vrble_pcje'];
           $this->flete_vrble_vr   = $this->redeTrans['$this->flete_vrble_vr'];
      }

      private function redeTransEvaluarPesoMinimo() {
          if ( $this->peso_cobar < $this->ped_peso_kg ) {
              $this->peso_cobar = $this->ped_peso_kg;
          }
      }

      private function redeTransVrFleteDescuentoComercial(){
            $this->dscto_ccial = 0;
            $this->vr_flete    =  $this->vr_kg_rdtrans * $this->peso_cobar ;
            if  ( $this->es_Reexpedicion  == false ) {
              $this->dscto_ccial = $this->vr_flete * ( $this->redeTrans['dscto_ccial'] / 100);
            }
            $this->vr_flete = $this->vr_flete - $this->dscto_ccial ;
            if ( $this->vr_flete <  $this->flete_min_vr ){
                $this->vr_flete = $this->flete_min_vr;
            }
      }

      private function redeTransFleteMinFleteVariable( $sufijo ){
         $this->flete_min_vr     = $this->redeTrans["$sufijo".'_flete_min_vr'];
      }

      private function redeTransVrSeguro(){
           if  ( $this->es_Reexpedicion == false  ) {
              $this->vr_seguro = $this->ped_vr_dclrdo * $this->redeTrans['sgro_min_pcje']/100;
              if ( $this->vr_seguro < $this->redeTrans['sgro_min_vr'] ){
                  $this->vr_seguro = $this->redeTrans['sgro_min_vr'] ;
              }
              $this->vr_seguro_min = $this->ped_unidades *  $this->redeTrans['sgro_min_und'];
            }
            /*************************/
            if  ( $this->es_Reexpedicion == true  ) {
              $this->vr_seguro = $this->ped_vr_dclrdo * $this->redeTrans['sgro_min_rex_pcje']/100;
              if ( $this->vr_seguro < $this->redeTrans['sgro_min_rex_vr'] ){
                  $this->vr_seguro = $this->redeTrans['sgro_min_rex_vr'] ;
              }
              $this->vr_seguro_min = $this->ped_unidades *  $this->redeTrans['sgro_min_rex_und_vr'];
            }
            $this->vr_seguro = max( $this->vr_seguro,$this->vr_seguro_min);
      }

      public function valoresTotalesFletes(){
           /*=============== REDE TRANS =======================*/
            $rdtrans_vr_flete     = $this->vr_flete            ;
            $rdtrans_flete_cobrar = $this->vr_flete_redetrans  ;
            $rdtrans_vr_kg        = $this->vr_kg_rdtrans       ;
            $rdtrans_vr_seguro    = $this->vr_seguro           ;
            if ( $rdtrans_vr_flete == 0) {
                $rdtrans_flete_cobrar = 0  ;
                $rdtrans_vr_kg        = 0       ;
                $rdtrans_vr_seguro    = 0           ;
            }
            /*=============== TRANSPORTES LA PRENSA =======================*/
            $laprensa_vr_flete     = $this->vrFleteLaPrensa    ;
            $laprensa_flete_cobrar = $this->vr_flete_laprensa  ;
            $laprensa_vr_kg        = $this->vr_kg_laPrensa     ;
            $laprensa_vr_seguro    = $this->cto_mnjo_laPrensa  ;
            if ( $laprensa_vr_flete == 0 ) {
              $laprensa_flete_cobrar = 0  ;
              $laprensa_vr_kg        = 0    ;
              $laprensa_vr_seguro    = 0 ;
            }

            return  compact( 'rdtrans_vr_flete','rdtrans_vr_seguro','rdtrans_flete_cobrar','rdtrans_vr_kg', 'laprensa_flete_cobrar','laprensa_vr_flete','laprensa_vr_kg',  'laprensa_vr_seguro' );
      }


}
