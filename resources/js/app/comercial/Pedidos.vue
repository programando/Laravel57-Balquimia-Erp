<template>
  <div class="container">
    <div class="card" >
      <strong>
      <div class="card-header" style="background-color: #dbdce0;">
        <h4><i class="la la-bars"></i>&nbsp;&nbsp;Registro de Pedidos</h4>
      </div>
      </strong>
      <div class="card-content ">
        <div class="card-body">
              <div class="row">
                <div class="col-md-3">
                  <label>Cliente</label>
                  <div class="form-group form-inline">
                    <button class="btn btn-primary btn-xs" data-target="#ModalClientesBuscar"  data-toggle="modal"
                      @click="NuevaBusqueda">
                      <i class="la la-search"></i></button>
                    &nbsp; <input   class="form-control border-primary campo-form" v-model="NombreCliente" placeholder="Nombre del cliente" disabled="disabled">
                  </div>
                </div>
                <div class="col-md-3">
                  <label>Sucursal</label>
                  <div class="form-group">
                    <input   class="form-control border-primary campo-form" v-model ='nom_suc' placeholder="Sucursal" disabled="disabled">
                  </div>
                </div>
                <div class="col-md-3">
                  <label>Vendedor</label>
                  <input   class="form-control border-primary campo-form" v-model="nom_vend_ppal" placeholder="Vendedor" disabled="disabled">
                </div>
                <div class="col-md-3">
                  <label>Fecha Despacho</label>
                  <datetime class="theme-orange "
                  input-class="my-vdatetime"
                  :phrases="{ok: 'Seleccionar', cancel: 'Salir'}" ></datetime>
                </div>
              </div>   <!-- /Row 1-->

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
                  <a class="nav-link active" id="base-tab41" data-toggle="tab" aria-controls="tab41" href="#ComprasCliente" aria-expanded="true">Últimas Ventas</a>
                </li>

                <li class="nav-item">
                  <a class="nav-link" id="base-tab42" data-toggle="tab" aria-controls="tab42" href="#PedidoGenerado" aria-expanded="false">Pedido Generado</a>
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
                <li class="nav-item">
                  <a class="nav-link" id="base-tab42" data-toggle="tab" aria-controls="tab42" href="#Contactos" aria-expanded="false">Contactos</a>
                </li>
              </ul>

              <div class="tab-content px-1 pt-1">

                <div role="tabpanel" class="tab-pane active" id="ComprasCliente" aria-expanded="true" aria-labelledby="base-tab41">
                      <!-- Componete para mostrar las últimas compras de un cliente-->
                    <ProductosComprados :IdTercero="id_terc"></ProductosComprados>
                </div>

                <div class="tab-pane" id="PedidoGenerado" aria-labelledby="base-tab42">

                </div>

                <div class="tab-pane" id="EstadoCuenta" aria-labelledby="base-tab42">
                      <CarteraCliente :IdTercero="id_terc"></CarteraCliente>
                </div>
                <div class="tab-pane" id="ObservVentas" aria-labelledby="base-tab42">
                    <NotasVenta :IdTercero="id_terc"></NotasVenta>
                </div>

                <div class="tab-pane" id="ObservCartera" aria-labelledby="base-tab42">
                  <NotasCartera :Idtercero = "id_terc"></NotasCartera>
                </div>

                <div class="tab-pane" id="Contactos" aria-labelledby="base-tab42">
                  <Contactos :IdTercero="id_terc"></Contactos>
                </div>

             </div>

        </div>
      </div>
    </div>   <!-- / Card-->

        <!-- Modal para buscar terceros -->
      <ClientesBuscar @SeleccionarTercero="SeleccionarTercero" UrlBusqueda='/clientes/buscar/'>
         <template slot='SearchTitle'>Puede realizar la búsqueda por: Nombre/Razón social, Nit, Sucursal, Nombre Comercial</template>
         <template slot='ModalTitle'>Búsqueda de Clientes</template>
      </ClientesBuscar>

  </div>

</template>

<script>
  import ProductosComprados  from '../../components/terceros/productos_comprados';
  import ClientesBuscar      from '../../components/modals/TercerosClientesBuscar';
  import Contactos           from '../../components/terceros/contactos'
  import NotasCartera        from '../../components/terceros/notas_cartera'
  import NotasVenta          from '../../components/terceros/notas_ventas'
  import CarteraCliente      from '../../components/terceros/cliente_cartera'

  import { Datetime } from 'vue-datetime';

// You need a specific loader for CSS files
import 'vue-datetime/dist/vue-datetime.css'
    export default {
        data() {
            return {
                nom_suc : '',
                 NombreCliente : '',
                 id_terc       : 0,
                 nom_vend_ppal :'',
            }
        },
     components: { datetime: Datetime, ProductosComprados, ClientesBuscar, Contactos, NotasCartera, NotasVenta, CarteraCliente
        },
     methods: {
          SeleccionarTercero( DatosCliente ){
              this.id_terc       = DatosCliente.id_terc;
              this.nom_suc       = DatosCliente.nom_suc;
              this.NombreCliente = DatosCliente.nom_full;
              this.BuscarVendedores();
          },
         BuscarVendedores(){
              let Me  = this;
              let Url = '/clientes/vendedores/'+ '?id_terc='+this.id_terc;
              let DatosCliente ='';
              axios.get( Url )
                .then( response => {
                    DatosCliente     = response.data.Cliente;
                    Me.nom_vend_ppal = response.data.Vendedores[0].nom_vend_ppal;
                    Me.nom_suc       = DatosCliente.municipio.nom_mcpio.trim() + ' ' + DatosCliente.nom_suc.trim() ;
                })
          },
        NuevaBusqueda() {
            this.id_terc       = 0;
        },
     }
   }
</script>

