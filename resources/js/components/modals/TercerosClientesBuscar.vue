<template>
  <div class="modal fade text-left" id="ModalClientesBuscar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4"
          aria-hidden="true" data-backdrop="static" data-keyboard="false" >
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content border-success">
        <div class="modal-header bg-info ">
          <h5 class="modal-title text-white" id="myModalLabel4">
            <strong><slot name='ModalTitle'>Búsqueda</slot></strong>
          </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">

            <div class="row">
              <div class="col-sm-12">
                <label>
                  <strong>
                    <slot name='SearchTitle'> Puede realizar la búsqueda por Nit, nombre o sucursal... </slot>
                  </strong>
                 </label>

                  <div class="form-group">
                    <input   class="form-control border-primary campo-form"
                      @change     ="BuscarTercero()"
                      @input      ="BuscarTercero()"
                      autofocus   = "autofocus"
                      placeholder="Digite para iniciar la búsqueda..."
                      type="text"
                      v-model     ='TextoBsqda'  >
                  </div>

              </div>  <!-- /Col - Campo búsqueda v-if="ClientesEncontrados.length"-->

              <div class="col-sm-12" v-if="TerceroEncontrado.length">
                <div class="table-responsive">
                  <table class="table table-bordered table-striped table-hover table-sm" >
                    <thead>
                      <tr>
                          <th> Nit</th>
                          <th> Nombre/Razón Soc.</th>
                          <th> Sucursal</th>
                          <th></th>
                      </tr>
                    </thead>
                        <tbody>
                        <tr v-for="Tercero in TerceroEncontrado" :key="Tercero.id_terc">
                            <td v-text="Tercero.nro_identif"></td>
                            <td v-text="Tercero.nom_sys"></td>
                            <td v-text="Tercero.nom_suc"> </td>
                            <td class="text-center">
                             <button type="button" class="btn btn-success btn-xs"
                             title="Seleccionar cliente" @click="SeleccionarTercero(Tercero)"><i class="la la-arrow-left" ></i>
                             </button>
                           </td>
                         </tr>

                       </tbody>

                  </table>
                </div>
              </div>

            </div>   <!-- /Row-->


          </div>

        </div>
      </div>
    </div>

  </template>

<script >
    export default {
        props :[ 'UrlBusqueda'],
        data(){
            return {
                  TextoBsqda : '',
                  TerceroEncontrado :[],
            }
        },
        methods:{
              BuscarTercero(){
                let Me = this;
                if ( Me.TextoBsqda.length<3){
                  return ;
                }
                let Url  = this.UrlBusqueda + '?filtro='+Me.TextoBsqda;
                axios.get(Url)
                .then( response=>{
                   this.TerceroEncontrado = response.data;
                });
              },

            SeleccionarTercero( Tercero ){
                this.TextoBsqda         = '',
                this.TerceroEncontrado  = [];
                $('#ModalClientesBuscar').modal('hide');
                this.$emit('SeleccionarTercero', Tercero);
            },
          }
    }
</script>
