<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ParametrosFlete as Fletes ;
use Cache;

class FletesController extends Controller {

        private $dscto_ccial          = 0 ,   $es_Reexpedicion      = false  ,         $flete_min_vr         = 0 ;
        private $ped_id_dpto          = 0 ,   $ped_id_mcpio         = 0 ,              $ped_peso_kg          = 0 ;
        private $ped_unidades         = 0 ,   $ped_vr_dclrdo        = 0 ,              $peso_cobar           = 0 ;
        private $vr_flete             = 0 ,   $vr_flete_cobrar      = 0  ,             $vr_kg_rdtrans        = 0 ;
        private $vr_kg_rdtrans_rexped = 0 ,   $vr_seguro            = 0 ,              $vr_seguro_min        = 0 ;


      public function fletesRedeTrans( Request $FormData ){
            $this->parametrosFletes();
            $this->redeTransAsignacionParametros( $FormData  );
            $this->redeTransVerificaReExpedicion();
            $this->redeTransUrbano();
            $this->redeTransRegional();
            $this->redeTransNacional();
            $this->redeTransReExpedicion();
            $this->redeTransVrFleteDescuentoComercial();
            $this->redeTransVrSeguro();
            $this->redeTransAplicaUtilidadEmpresa();
            $response = $this->redeTransTotales();
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

      private function redeTransAplicaUtilidadEmpresa(){
            $pcte_utilidad              = ( 100 - $this->redeTrans['pcje_utldad_bq'] ) / 100;
            $this->vr_flete_cobrar      =  ($this->vr_flete +$this->vr_seguro)   /  $pcte_utilidad ;
      }


      private function redeTransAsignacionParametros( $Parametros ){
           $this->ped_id_dpto          = $Parametros->ped_id_dpto;
           $this->ped_id_mcpio         = $Parametros->ped_id_mcpio;
           $this->ped_peso_kg          = $Parametros->ped_peso_kg;
           $this->ped_unidades         = $Parametros->ped_unidades;
           $this->ped_vr_dclrdo        = $Parametros->ped_vr_dclrdo;
           $this->vr_kg_rdtrans        = $Parametros->vr_kg_rdtrans;
           $this->vr_kg_rdtrans_rexped = $Parametros->vr_kg_rdtrans_rexped;

/*
            $this->ped_id_dpto         = 32;
           $this->ped_id_mcpio         = 153;
           $this->ped_peso_kg          = 45;
           $this->ped_unidades         = 12;
           $this->ped_vr_dclrdo        = 250000;
           $this->vr_kg_rdtrans        = 309;
           $this->vr_kg_rdtrans_rexped = 0;
           */

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

      public function redeTransTotales(){
            $vr_flete_rdtrans  = $this->vr_flete;
            $vr_seguro_rdtrans = $this->vr_seguro ;
            $flete_cobrar      =  $this->vr_flete_cobrar ;
            $vr_kg_rdtrans     = $this->vr_kg_rdtrans;

            return  compact( 'vr_flete_rdtrans','vr_seguro_rdtrans','flete_cobrar','vr_kg_rdtrans');
      }


}
