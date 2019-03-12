<template>

  <div class="container">
    <div class="card" >
      <strong>
      <div class="card-header card-header-bg" >
        <h4><i class="la la-bars"></i>&nbsp;&nbsp;Autorización de Pedidos</h4>
      </div>
      </strong>
      <div class="card-content ">
        <div class="card-body">
      <div class="table-responsive" v-if="ProductosComprados.length" >
        <table class="table table-bordered table-striped table-hover table-sm" >
          <thead>
            <tr>
              <th> Fecha</th>
              <th> Factura</th>
              <th> Producto</th>
              <th> Present.</th>
              <th> Cant</th>
              <th> $ Base</th>
              <th> Flete</th>
              <th> Mayor Vr.</th>
              <th> Vr.Unit.</th>
              <th> </th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="Producto in ProductosComprados"  :key="Producto.id_fact_dt">
              <td> {{ Producto.fcha_fact | FormatoFecha }} </td>

              <td>
                <button   title="Agregar Producto"
                type="button" class="btn btn-success btn-xs"
                <i class="la la-shopping-cart" ></i>
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>


              <ul class="nav nav-tabs nav-linetriangle no-hover-bg">
                <li class="nav-item">
                  <a class="nav-link active" id="base-tab41" data-toggle="tab" aria-controls="tab41" href="#ComprasCliente" aria-expanded="true">Histórico de ventas</a>
                </li>

                <li class="nav-item">
                  <a class="nav-link" id="base-tab42" data-toggle="tab" aria-controls="tab42" href="#PedidoGenerado" aria-expanded="false">Estado de cuenta</a>
                </li>

                <li class="nav-item">
                  <a class="nav-link" id="base-tab42" data-toggle="tab" aria-controls="tab42" href="#EstadoCuenta" aria-expanded="false">Estado de Cuenta</a>
                </li>

                <li class="nav-item">
                  <a class="nav-link" id="base-tab42" data-toggle="tab" aria-controls="tab42" href="#ObservVentas" aria-expanded="false">Observ. Ventas</a>
                </li>

                <li class="nav-item">
                  <a class="nav-link" id="base-tab42" data-toggle="tab" aria-controls="tab42" href="#ObservCartera" aria-expanded="false">Notas Cartera</a>
                </li>

              </ul> <!-- / ULS-->

              <div class="tab-content px-1 pt-1">

                  <div role="tabpanel" class="tab-pane active" id="ComprasCliente" aria-expanded="true" aria-labelledby="base-tab41">
                  </div>

                  <div class="tab-pane" id="PedidoGenerado" aria-labelledby="base-tab42">
                  </div>

                  <div class="tab-pane" id="EstadoCuenta" aria-labelledby="base-tab42">
                  </div>

                  <div class="tab-pane" id="ObservVentas" aria-labelledby="base-tab42">
                  </div>

                  <div class="tab-pane" id="ObservCartera" aria-labelledby="base-tab42">
                  </div>

             </div>  <!-- / Fin de Tabs-->

        </div>
      </div>
    </div>   <!-- / Card-->
  </div>


</template>
<script>
import Compras      from '../../components/terceros/prd_comprados_ultmimos_anios';

  export default {
    mounted(){
        this.pedidosPorAutorizar();
    },
    data(){
        return {
            ProductosComprados : [],
        }
    },
    components: { Compras },

    methods:{
        pedidosPorAutorizar(){
            axios.get('/cartera/pedidos/autorizar/')
              .then ( response => {
                 this.ProductosComprados = response.data;
              });
        },
    }
  }
</script>
