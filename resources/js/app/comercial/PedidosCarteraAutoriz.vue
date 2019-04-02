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
                  <th> Autoriza</th>
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
                    <button   title="Autorizar Pedido"
                    type="button" class="btn btn-success btn-xs"
                    @click="autorizarPedido ( Pedido.id_ped  )">
                    <i class="icon-check" ></i>
                  </button>


                </td>
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
        <ul class="nav nav-tabs nav-linetriangle no-hover-bg" v-if="PedidosPorAutorizar.length">
          <li class="nav-item">
            <a class="nav-link active" id="base-tab41" data-toggle="tab" aria-controls="tab41" href="#DetallePedido" aria-expanded="true">Detalles pedido seleccionado</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="base-tab42" data-toggle="tab" aria-controls="tab42" href="#HistoricoVentas" aria-expanded="false">Histórico ventas</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="base-tab42" data-toggle="tab" aria-controls="tab42" href="#EstadoCuenta" aria-expanded="false">Estado de cuenta</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="base-tab42" data-toggle="tab" aria-controls="tab42" href="#ObservVentas" aria-expanded="false">Notas ventas</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="base-tab42" data-toggle="tab" aria-controls="tab42" href="#ObservCartera" aria-expanded="false">Notas cartera</a>
          </li>
        </ul> <!-- / ULS-->

        <div class="tab-content px-1 pt-1">
          <div role="tabpanel" class="tab-pane active" id="DetallePedido"
          aria-expanded="true" aria-labelledby="base-tab41">
          <PedidoDetalle :DetallePedido="DetallePedido">
            <template slot="DatosCliente">{{ DatosCliente }}</template>
          </PedidoDetalle>
        </div>

        <div class="tab-pane" id="HistoricoVentas" aria-labelledby="base-tab42">
          <HistorialVentas :IdTercero="id_terc"></HistorialVentas>
        </div>

        <div class="tab-pane" id="EstadoCuenta" aria-labelledby="base-tab42">
          <CarteraCliente :IdTercero="id_terc"></CarteraCliente>
        </div>

        <div class="tab-pane" id="ObservVentas" aria-labelledby="base-tab42">
          <NotasVenta :IdTercero="id_terc"></NotasVenta>
        </div>

        <div class="tab-pane" id="ObservCartera" aria-labelledby="base-tab42">
          <NotasCartera :IdTercero="id_terc"></NotasCartera>
        </div>

      </div>  <!-- / Fin de Tabs-->

    </div>
    <div class="card-body" v-else>
      <div class="col-sm-12 text-center m-2"  >
        <h3>No tiene pedidos para autorizar.</h3>
      </div>
    </div>


  </div>
</div>   <!-- / Card-->
</div>


</template>

<script>
import Compras             from '../../components/terceros/prd_comprados_ultmimos_anios';
import PedidoDetalle       from '../../components/comercial/pedido_detalles.vue';
import CarteraCliente      from '../../components/terceros/cliente_cartera';
import NotasCartera        from '../../components/terceros/notas_cartera';
import NotasVenta          from '../../components/terceros/notas_ventas';
import HistorialVentas     from '../../components/terceros/prd_comprados_ultmimos_anios.vue';
import Message             from '../../mixins/ToastrMessages.js';


  export default {
    mounted(){
        this.pedidosPorAutorizar();
    },
    data(){
        return {
            PedidosPorAutorizar : [],
            id_terc : 0,
            DetallePedido : [],
            DatosCliente :'',
        }
    },
    components: { Compras, PedidoDetalle, NotasCartera, NotasVenta,  CarteraCliente, HistorialVentas },
    mixins : [  Message ],
    methods:{
        pedidosPorAutorizar(){
            axios.get('/cartera/pedidos/autorizar/')
              .then ( response => {
                 this.PedidosPorAutorizar = response.data;
              });
        },
        detallePedidoBuscar(Pedido ){
            this.id_terc    = Pedido.id_terc_cli;
            this.DatosCliente = "Pedido :  " + Pedido.num_ped + "     " + Pedido.nom_full ;
            axios.post('/pedidos/detalle', {'id_ped': Pedido.id_ped})
            .then( response => {
                this.DetallePedido = response.data;
            });
        },
        autorizarPedido ( idPedido ){
            var pos = this.getIndice ( idPedido );
            axios.post('/pedidos/autorizar', {'id_ped': idPedido})
            .then( response => {;
                this.eliminarElemento ( pos );
                this.Success('Pedidos', 'Pedido autorizado con éxito !!!');
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
