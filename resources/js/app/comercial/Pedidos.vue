<template>
  <div class="container">
    <div class="card" >
      <div class="card-header" style="background-color: #dbdce0;">
        <h4><i class="la la-bars"></i>&nbsp;&nbsp;Registro de Pedidos</h4>

      </div>
      <div class="card-content ">
        <div class="card-body">
              <div class="row">
                <div class="col-md-3">
                  <label>Cliente</label>
                  <div class="form-group form-inline">
                    <button class="btn btn-primary btn-xs" data-target="#ModalClientesBuscar"  data-toggle="modal">
                      <i class="la la-search"></i></button>
                    &nbsp; <input   class="form-control border-primary campo-form" placeholder="Nombre del cliente" disabled="disabled">
                  </div>
                </div>
                <div class="col-md-3">
                  <label>Sucursal</label>
                  <div class="form-group">
                    <input   class="form-control border-primary campo-form" placeholder="Sucursal" disabled="disabled">
                  </div>
                </div>
                <div class="col-md-3">
                  <label>Vendedor</label>
                  <input   class="form-control border-primary campo-form" placeholder="Vendedor" disabled="disabled">
                </div>
                <div class="col-md-3">
                  <label>Fecha Despacho</label>
                  <datetime class="theme-orange "
                  input-class="my-vdatetime"
                  :phrases="{ok: 'Seleccionar', cancel: 'Salir'}" ></datetime>
                </div>
              </div>   <!-- /Row 1-->
              <br>
              <div class="row">
                <div class="col-sm-3">
                  <label>Orden Compra</label>
                  <input   class="form-control border-primary campo-form" placeholder="Número orden compra"  >
                </div>
                <div class="col-sm-9">
                  <label>Observaciones del pedido</label>
                  <input   class="form-control border-primary campo-form" placeholder="Observaciones del pedido"  >
                </div>
              </div>


              <ul class="nav nav-tabs nav-linetriangle no-hover-bg">
                <li class="nav-item">
                  <a class="nav-link active" id="base-tab41" data-toggle="tab" aria-controls="tab41" href="#tab41" aria-expanded="true">Últimas Ventas</a>
                </li>

                <li class="nav-item">
                  <a class="nav-link" id="base-tab42" data-toggle="tab" aria-controls="tab42" href="#tab42" aria-expanded="false">Pedido Generado</a>
                </li>

              </ul>

              <div class="tab-content px-1 pt-1">

                <div role="tabpanel" class="tab-pane active" id="tab41" aria-expanded="true" aria-labelledby="base-tab41">
                    <ProductosComprados></ProductosComprados>
                </div>

                <div class="tab-pane" id="tab42" aria-labelledby="base-tab42">
                  <p>Tab 2.</p>
                </div>

             </div>

        </div>
      </div>
    </div>   <!-- / Card-->
  <ClientesBuscar></ClientesBuscar>

  </div>

</template>

<script>
  import ProductosComprados from '../../components/clientes/productos_comprados';
  import ClientesBuscar     from '../../components/modals/TercerosClientesBuscar';
  import { Datetime } from 'vue-datetime';

// You need a specific loader for CSS files
import 'vue-datetime/dist/vue-datetime.css'
    export default {
        mounted() {
            console.log('Component mounted.')
        },

     components: {
          datetime: Datetime, ProductosComprados, ClientesBuscar
  }
    }
</script>

