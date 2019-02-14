<template>
  <div class="modal fade text-left" id="ModalProductosBusqueda" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4"
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
                    <slot name='SearchTitle'> Puede realizar la búsqueda por nombre producto... </slot>
                  </strong>
                 </label>

                  <div class="form-group">
                    <input   class="form-control border-primary campo-form"
                      @change     ="BuscarProducto()"
                      @input      ="BuscarProducto()"
                      autofocus   = "autofocus"
                      placeholder="Digite para iniciar la búsqueda..."
                      type="text"
                      v-model     ='TextoBsqda'  >
                  </div>

              </div>  <!-- /Col - Campo búsqueda v-if="ClientesEncontrados.length"-->

              <div class="col-sm-12" v-if="ProductoEncontrado.length">
                <div class="table-responsive">
                  <table class="table table-bordered table-striped table-hover table-sm" >
                    <thead>
                      <tr>
                          <th> Producto</th>
                          <th> Presentación</th>
                          <th></th>
                      </tr>
                    </thead>
                        <tbody>
                        <tr v-for="Producto in ProductoEncontrado" :key="Producto.id_terc">
                            <td v-text="Producto.nom_prd"></td>
                            <td v-text="Producto.nom_present"> </td>
                            <td class="text-center">
                             <button type="button" class="btn btn-success btn-xs"
                             title="Seleccionar cliente" @click="SeleccionarProducto(Producto)"><i class="la la-arrow-left" ></i>
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
                  ProductoEncontrado :[],
            }
        },
        methods:{
              BuscarProducto(){
                let Me = this;
                if ( Me.TextoBsqda.length<3){
                  return ;
                }
                let Url  = this.UrlBusqueda + '?filtro='+Me.TextoBsqda;
                axios.get(Url)
                .then( response=>{
                   this.ProductoEncontrado = response.data;

                });
              },

            SeleccionarProducto( Producto ){
                this.TextoBsqda         = '',
                this.ProductoEncontrado  = [];
                $('#ModalProductosBusqueda').modal('hide');
                this.$emit('SeleccionarProducto', Producto);
            },
          }
    }
</script>
