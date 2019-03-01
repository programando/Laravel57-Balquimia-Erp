<template>

  <div class="modal fade text-left" id="ModalLiquidarFletes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4"
  aria-hidden="true" data-backdrop="static" data-keyboard="false" >
  <div class="modal-dialog" role="document">
    <div class="modal-content border-success">
      <div class="modal-header bg-info ">
        <h5 class="modal-title text-white" id="myModalLabel4">
          <i class="la la-calculator"></i> <strong><slot name='ModalTitle'>Búsqueda / Datos del despacho</slot></strong>
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">

        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
              </div>
              <div class="card-content collpase show">
                <div class="card-body">
                  <div class="card-text">   </div>
                  <form class="form form-horizontal">
                    <div class="form-body">

                      <div class="form-group row">
                        <label class="col-md-3 label-control">Municipio :</label>
                        <div class="col-md-9">
                          <Municipios @seleccionarMcipio="seleccionarMcipio"></Municipios>
                        </div>
                      </div>


                      <div class="form-group row">
                        <label class="col-md-3 label-control">Unidades: </label>
                        <div class="col-md-5">
                          <input type="text" class="form-control campo-form text-right" v-model="ped_unidades" >
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-md-3 label-control">Peso Total : </label>
                        <div class="col-md-5">
                          <input type="text" class="form-control campo-form text-right" v-model="ped_peso_kg">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-md-3 label-control">$ Declarado:</label>
                        <div class="col-md-5">
                          <input type="text " class="form-control campo-form text-right" v-model="ped_vr_dclrdo">
                        </div>
                        <div class="col-md-4">
                          <button type="button" class="btn btn-success btn-sm" @click="calcularFlete()">
                            <i class="la la-calculator"></i> Calcular Flete
                          </button>
                        </div>
                      </div>
                    </div>


                  </form>
                  <hr>


                  <div class="row">
                    <div class="col-md-4 "></div>
                    <div class="col-md-4  text-center">
                      <strong> REDRETRANS</strong>
                    </div>
                    <div class="col-md-4 text-center">
                      <strong> TRANSPRENSA</strong>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4 "> Valor Kilo :</div>
                    <div class="col-md-4 ">
                      <input type="text " class="form-control campo-form text-right mb-05"  disabled="disabled"
                       v-model ='vr_kg_rdtrans'>
                    </div>
                    <div class="col-md-4 ">
                      <input type="text " class="form-control campo-form text-right mb-05" disabled="disabled"
                      v-model="vr_kg_transprensa">
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-4 "> Costo Flete :</div>
                    <div class="col-md-4 ">
                      <input type="text " class="form-control campo-form text-right mb-05" disabled="disabled"
                        :value ='vr_flete_rdtrans | NumeroEntero'>
                    </div>
                    <div class="col-md-4 ">
                      <input type="text " class="form-control campo-form text-right mb-05" disabled="disabled"
                      :value ='laprensa_vr_flete | NumeroEntero' >
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-4 "> Seguro :</div>
                    <div class="col-md-4 ">
                      <input type="text " class="form-control campo-form text-right mb-05" disabled="disabled"
                        :value='vr_seguro_rdtrans | NumeroEntero '>
                    </div>
                    <div class="col-md-4 ">
                      <input type="text " class="form-control campo-form text-right mb-05" disabled="disabled"
                       :value='laprensa_vr_seguro | NumeroEntero '>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-4 "> Costo total :</div>
                    <div class="col-md-4 ">
                      <input type="text " class="form-control campo-form text-right mb-05" disabled="disabled"
                          :value="vr_totalflete_rdtrans | NumeroEntero">
                    </div>
                    <div class="col-md-4 ">
                      <input type="text " class="form-control campo-form text-right mb-05" disabled="disabled"
                      :value="laprensa_vr_flete_total | NumeroEntero ">
                    </div>
                  </div>


                  <div class="row">
                    <div class="col-md-4 "> Valor a cobrar :</div>
                    <div class="col-md-4 ">
                      <input type="text " class="form-control campo-form text-right"
                      :value="flete_cobrar | NumeroEntero">
                    </div>
                    <div class="col-md-4 ">
                      <input type="text " class="form-control campo-form text-right"
                      :value="laprensa_flete_cobrar | NumeroEntero">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

</template>

<script>
  import Municipios from '../../components/maestros/municipios';
  export default {
     data(){
        return {
             ped_id_dpto          :  0 ,
             ped_id_mcpio         :  0 ,
             ped_peso_kg          :  0 ,
             ped_unidades         :  0 ,
             ped_vr_dclrdo        :  0 ,
             vr_kg_rdtrans        :  0 ,
             vr_kg_rdtrans_rexped :  0 ,
             vr_flete_rdtrans     :  0 ,
             vr_seguro_rdtrans    :  0,
             vr_totalflete_rdtrans : 0 ,
             flete_cobrar          : 0 ,
             vr_kg_transprensa     : 0,
             vr_kg_transprensa_rexped : 0,
             laprensa_vr_flete        : 0,
             laprensa_vr_seguro       : 0,
             laprensa_vr_flete_total  : 0,
             laprensa_flete_cobrar    : 0,
        }
       },

      components: { Municipios },

      methods:{
          seleccionarMcipio( McipioSeleccionado ){
              this.ped_id_dpto              = McipioSeleccionado.id_dpto;
              this.ped_id_mcpio             = McipioSeleccionado.id_mcpio;
              this.vr_kg_rdtrans_rexped     = McipioSeleccionado.vr_kg_rdtrans_rexped;
              this.vr_kg_rdtrans            = Math.max( McipioSeleccionado.vr_kg_rdtrans, this.vr_kg_rdtrans_rexped ) ;
              this.vr_kg_transprensa_rexped = McipioSeleccionado.vr_kg_transprensa_rexped;
              this.vr_kg_transprensa        = Math.max( McipioSeleccionado.vr_kg_transprensa, this.vr_kg_transprensa_rexped ) ;
          },
          calcularFlete() {
            let Me = this;
            let Param = { 'ped_unidades': this.ped_unidades, 'ped_peso_kg': this.ped_peso_kg, 'ped_vr_dclrdo': this.ped_vr_dclrdo,
                          'ped_id_dpto': this.ped_id_dpto, 'ped_id_mcpio': this.ped_id_mcpio, 'vr_kg_rdtrans': this.vr_kg_rdtrans,
                           'vr_kg_rdtrans_rexped':this.vr_kg_rdtrans_rexped, 'vr_kg_transprensa_rexped': this.vr_kg_transprensa_rexped,'vr_kg_transprensa': this.vr_kg_transprensa };
             axios.post('/fletes/calcular', Param )
              .then( response => {
                  Me.vr_kg_rdtrans         = response.data.rdtrans_vr_kg;
                  Me.vr_flete_rdtrans      = response.data.rdtrans_vr_flete;
                  Me.vr_seguro_rdtrans     = response.data.rdtrans_vr_seguro;
                  Me.flete_cobrar          = response.data.rdtrans_flete_cobrar;

                  Me.laprensa_vr_seguro    = response.data.laprensa_vr_seguro;
                  Me.laprensa_vr_flete     = response.data.laprensa_vr_flete;
                  Me.laprensa_flete_cobrar = response.data.laprensa_flete_cobrar;

                  this.costoTotalFlete();
              });
          },
         costoTotalFlete(){
              this.vr_totalflete_rdtrans =  parseInt(this.vr_flete_rdtrans + this.vr_seguro_rdtrans);
              this.flete_cobrar          = parseInt( this.flete_cobrar );
              this.laprensa_vr_flete_total = parseInt( this.laprensa_vr_flete + this.laprensa_vr_seguro );
            }
      }

   };

</script>
