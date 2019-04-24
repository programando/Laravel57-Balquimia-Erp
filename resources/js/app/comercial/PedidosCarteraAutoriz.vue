<template>

  <div class="container">
    <div class="card" >
      <strong>
        <div class="card-header card-header-bg" >
          <h4><i class="la la-bars"></i>&nbsp;&nbsp;Autorización de Pedidos</h4>
        </div>
      </strong>
      <div class="card-content ">
        <div class="card-body" v-if="PedidosPorAutorizar.length">
          <div class="col-sm-12 text-center" >
            <h4>Seleccione uno de los pedidos, presionando click en el número, para ver sus productos.</h4>

          </div>
          <div class="table-responsive"  style="max-height: 10%">
            <table class="table table-bordered table-striped table-hover table-sm"  >
              <thead>
                <tr>
                  <th> # Ped.</th>
                  <th> O.C.</th>
                  <th> Fecha</th>
                  <th> Despacho</th>
                  <th> Cliente</th>
                  <th> Destino</th>
                  <th> Vendedor</th>
                  <th> Registró</th>
                  <th> Observaciones</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="Pedido in PedidosPorAutorizar"  :key="Pedido.id_ped">
                <td class="text-center">
                  <a  @click="detallePedidoBuscar( Pedido )">
                    {{ Pedido.num_ped }}
                  </a>
                </td>

                <td> {{ Pedido.num_ord_cpra }} </td>
                <td> {{ Pedido.fcha_ped | FormatoFecha }} </td>
                <td> {{ Pedido.fcha_ped | FormatoFecha }} </td>
                <td> {{ Pedido.nom_full  }} </td>
                <td> {{ Pedido.nom_mcpio  }} </td>
                <td> {{ Pedido.nom_vend }} </td>
                <td> {{ Pedido.nom_usu }}</td>
                <td> <small>{{ Pedido.observ_ped }}</small></td>

              </tr>
            </tbody>
          </table>
        </div>

    </div>
    <div class="card-body" v-else>
      <div class="col-sm-12 text-center m-2"  >
        <h3>No tiene pedidos para autorizar.</h3>
      </div>
    </div>


  </div>
</div>   <!-- / Card-->

  <AprobarPedido
       :IdPedido="id_ped"
       :DatosClientePedido="DatosCliente"
       :IdTercero="id_terc"
        @autorizarPedido="autorizarPedido"
       ></AprobarPedido>
</div>


</template>


<script>
import AprobarPedido from '../../components/modals/PedidoAprobarCartera.vue';

  export default {
    mounted(){
        this.pedidosPorAutorizar();
    },
    data(){
        return {
            PedidosPorAutorizar : [],
            id_terc : 0,
            id_ped : 0,
            DetallePedido : [],
            DatosCliente :'',
        }
    },
    components : {  AprobarPedido },

    methods:{
        pedidosPorAutorizar(){
            axios.get('/cartera/pedidos/autorizar/')
              .then ( response => {
                 this.PedidosPorAutorizar = response.data;
              });
        },
        detallePedidoBuscar(Pedido ){
            this.id_terc      = Pedido.id_terc_cli;
            this.id_ped       = Pedido.id_ped;
            this.DatosCliente = "Pedido :  " + Pedido.num_ped + "     " + Pedido.nom_full ;
            $('#ModalPedCartAprobar').modal('show');

        },

        autorizarPedido ( idPedido ){
            var pos = this.getIndice ( idPedido );
            axios.post('/pedidos/autorizar', {'id_ped': idPedido})
            .then( response => {;
                this.eliminarElemento ( pos );

                $('#ModalPedCartAprobar').modal('hide');
            });
        },
        getIndice(  idPedido ){
          var Indice = -1;
          this.PedidosPorAutorizar.filter (function (Pedido, i) {
              if ( Pedido.id_ped === idPedido ) {
                  Indice = i;
              }
          });
          return Indice;
        },
        eliminarElemento( pos ){
            this.PedidosPorAutorizar.splice(pos,1);
        },
    } // Methods

  }
</script>
