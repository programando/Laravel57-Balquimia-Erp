<template>
  <div class="modal fade text-left" id="ModalPedCartAprobar"
        tabindex="-1" role="dialog" aria-labelledby="myModalLabel4"
        aria-hidden="true" data-backdrop="static" data-keyboard="false" >
    <div class="modal-dialog modal-danger modal-lg" role="document"   >
      <div class="modal-content border-info">
        <div class="modal-header bg-info ">
          <h4 class="modal-title text-white" id="myModalLabel4">
          <slot name='ModalTitle'>Aprobar Pedidos </slot></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body"  >
          <form class="form-horizontal form-simple" novalidate method="POST" enctype="multipart/form-data">
            <PedidoDetalle
                :DetallePedido="DetallePedido" >
                <template slot="DatosCliente">
                  <h3>{{ DatosClientePedido }}</h3>
                </template>
            </PedidoDetalle>
              <button type="button" class="btn grey btn-secondary btn-sm" data-dismiss="modal"  >Cancelar</button>
              <button type="button" class="btn btn-success btn-sm" @click="autorizarPedido()"  >Aprobar Pedido</button>
          </form>

       <ul class="nav nav-tabs nav-linetriangle no-hover-bg" >
          <li class="nav-item ">
            <a class="nav-link active"  data-toggle="tab" href="#HistoricoVentas" aria-expanded="false">Histórico ventas</a>
          </li>

          <li class="nav-item">
            <a class="nav-link"  data-toggle="tab" href="#EstadoCuenta" aria-expanded="false">Estado de cuenta</a>
          </li>

          <li class="nav-item">
            <a class="nav-link"  data-toggle="tab" href="#ObservVentas" aria-expanded="false">Notas ventas</a>
          </li>
          <li class="nav-item">
            <a class="nav-link"  data-toggle="tab" href="#ObservCartera" aria-expanded="false">Notas cartera</a>
          </li>
       </ul> <!-- / ULS-->

       <div class="tab-content px-1 pt-1">

              <div role="tabpanel" class="tab-pane active"  id="HistoricoVentas"  >
                <HistorialVentas :IdTercero="IdTercero"></HistorialVentas>
              </div>

              <div class="tab-pane" id="EstadoCuenta" aria-labelledby="base-tab42">
                <CarteraCliente :IdTercero="IdTercero"></CarteraCliente>
              </div>

             <div class="tab-pane" id="ObservVentas" aria-labelledby="base-tab42">
               <NotasVenta :IdTercero="IdTercero"></NotasVenta>
            </div>

           <div class="tab-pane" id="ObservCartera" aria-labelledby="base-tab42">
              <NotasCartera :IdTercero="IdTercero"></NotasCartera>
            </div>

        </div>

     </div>   <!-- /modal-body -->


      </div>
    </div>
  </div>

</template>

<script >

import PedidoDetalle       from '../comercial/pedido_detalles.vue';
import HistorialVentas     from '../terceros/prd_comprados_ultmimos_anios.vue';
import CarteraCliente      from '../terceros/cliente_cartera';
import NotasVenta          from '../terceros/notas_ventas';
import NotasCartera        from '../terceros/notas_cartera';
import Message             from '../../mixins/ToastrMessages.js';

export default {
        props : [ 'IdPedido', 'IdTercero', 'DatosClientePedido' ],

       data(){
          return {
            DetallePedido : [],
            DatosCliente : '',
            DatosDetalle : [],
            VariableEjmplo : 'Esta es una variable de ejemplo desde el componente',
          }
       },

       components : { PedidoDetalle, HistorialVentas, CarteraCliente, NotasVenta, NotasCartera },
       mixins : [  Message ],

       watch :{
            IdPedido : function(){
                this.DetallePedido = this.detallePedidoBuscar() ? this.IdPedido > 0 : [];
            }
       },



       methods:{

          detallePedidoBuscar () {
            axios.post('/pedidos/detalle', {'id_ped': this.IdPedido })
            .then( response => {
                this.DetallePedido = response.data;
            });
          },

          autorizarPedido( ) {
              let IdPedido = this.IdPedido ;
              this.$emit('autorizarPedido', IdPedido);
              this.Success('Pedidos', 'Autorización finalizada con éxito !!!');
          },

        }// Methods
    }

</script>
