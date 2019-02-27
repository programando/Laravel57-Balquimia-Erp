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
                <div class="col-md-3" :class = "{ 'invalid-data': ErrorHas('id_terc')}">
                  <label>Cliente</label>
                  <div class="form-group form-inline">

                    <button class="btn btn-primary btn-xs" data-target="#ModalLiquidarFletes"  data-toggle="modal"
                      @click="NuevaBusqueda">
                      <i class="la la-search"></i>
                    </button>



                    <button class="btn btn-primary btn-xs" data-target="#ModalClientesBuscar"  data-toggle="modal"
                      @click="NuevaBusqueda">
                      <i class="la la-search"></i>
                    </button>
                    &nbsp; <input   class="form-control border-primary campo-form" v-model="NombreCliente" placeholder="Nombre del cliente" disabled="disabled">

                  <div class="invalid-data" v-if="ErrorHas('id_terc')">
                    <i class="ft-x-square"></i>&nbsp;<span class="invalid-data" v-text="ErrorGet('id_terc')">  </span>
                  </div>

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
                <div class="col-md-3" :class = "{ 'invalid-data': ErrorHas('fcha_dspcho')}">
                  <label>Fecha Despacho</label>
                  <datetime class="theme-orange { 'invalid-data': ErrorHas('fcha_dspcho')}"
                  input-class="my-vdatetime"
                  value-zone ='America/bogota'
                  :phrases="{ok: 'Seleccionar', cancel: 'Salir'}" v-model="fcha_dspcho" @focus="fehcDspchoFocus()">
                  </datetime>
                  <div class="invalid-data" v-if="ErrorHas('fcha_dspcho')">
                    <i class="ft-x-square"></i>&nbsp;<span class="invalid-data" v-text="ErrorGet('fcha_dspcho')">  </span>
                  </div>
                </div>
              </div>   <!-- /Row 1-->

              <div class="row">
                <div class="col-sm-3">
                  <label>Orden Compra</label>
                  <input type="text"  class="form-control border-primary campo-form NroOrdenCompra" v-model="num_ord_cpra"
                   placeholder="Número orden compra" > </input>

                </div>
                <div class="col-sm-9">
                  <label>Observaciones del pedido</label>
                  <input   class="form-control border-primary campo-form" placeholder="Observaciones del pedido" v-model="observ_ped"  >
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
                    <ProductosComprados :IdTercero="id_terc" @AgregarProductoPedido="AgregarProductoPedido" ></ProductosComprados>
                </div>

                <div class="tab-pane" id="PedidoGenerado" aria-labelledby="base-tab42">
                        <PedidoNuevo :NuevoPedido="NuevoPedido" :id_terc="id_terc" :PedPcjeIva = 'PedPcjeIva' @GrabarPedido="GrabarPedido">  </PedidoNuevo>
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

        <!-- Modal para liquidar fletes-->
      <LiquidacionFletes >
         <template slot='SearchTitle'>Liquidación de fletes</template>
         <template slot='ModalTitle'>Liquidación de fletes</template>
      </LiquidacionFletes>

        <!-- Modal para buscar Productos Presentaciones Activos-->
      <ProductosBuscar @SeleccionarProducto="AgregarProductoPedido" UrlBusqueda='/productos/activos/'>
         <template slot='SearchTitle'>Puede realizar la búsqueda por: Nombre de producto</template>
         <template slot='ModalTitle'>Búsqueda de Productos</template>
      </ProductosBuscar>

  </div>

</template>

<script>
  import CarteraCliente      from '../../components/terceros/cliente_cartera';
  import LiquidacionFletes   from '../../components/modals/CcialLiquidaFletes';
  import Cleave              from 'vue-cleave'
  import ClientesBuscar      from '../../components/modals/TercerosBuscar';
  import Contactos           from '../../components/terceros/contactos';
  import FormValidation      from '../../mixins/FormValidation.js';
  import Message             from '../../mixins/ToastrMessages.js';
  import NotasCartera        from '../../components/terceros/notas_cartera';
  import NotasVenta          from '../../components/terceros/notas_ventas';
  import PedidoNuevo         from '../../components/comercial/pedido_nuevo_items';
  import ProductosBuscar      from '../../components/modals/ProductosBuscar';
  import ProductosComprados  from '../../components/terceros/productos_comprados';
  import { Datetime }        from 'vue-datetime';
  import { MSG }             from '../../files/messages.js';
  // You need a specific loader for CSS files
  import 'vue-datetime/dist/vue-datetime.css'


    export default {
        data() {
            return {
                 ErrorsController  : {},
                 nom_suc           : '',
                 NombreCliente     : '',
                 id_terc           : 0,
                 nom_vend_ppal     :'',
                 NuevoPedido       : [],
                 PedPcjeIva        : 0.00,
                 num_ord_cpra      : '',
                 fcha_dspcho       : '',
                 observ_ped        : '',
            }
        },
          components: { datetime: Datetime, ProductosComprados, ClientesBuscar,ProductosBuscar,
                        Contactos, NotasCartera, NotasVenta, CarteraCliente,PedidoNuevo, Cleave, LiquidacionFletes
        },
          mixins : [ FormValidation, Message ],

       computed: {

        },

     methods: {
        fehcDspchoFocus(){
                delete this.ErrorsController['fcha_dspcho'] ;
            },

        GrabarPedido ( data ) {
           let Me = this;
          let Pedido = {'id_terc' : Me.id_terc, 'fcha_dspcho': Me.fcha_dspcho,'num_ord_cpra': Me.num_ord_cpra, 'observ_ped':Me.observ_ped,
                        'detalle': Me.NuevoPedido };
          axios.post('/pedidos/grabar', Pedido)
          .then ( response => {
            this.Success('Pedidos', 'Pedido grabado con éxito !!!');
            this.RegistrarNuevoPedido();
          })
            .catch( this.ErrorOnFail );

        },


        RegistrarNuevoPedido() {
           this.fcha_dspcho   = '';
           this.id_terc       = 0;
           this.nom_suc       = '';
           this.nom_vend_ppal ='';
           this.NombreCliente = '';
           this.NuevoPedido   = [];
           this.num_ord_cpra  = '';
           this.observ_ped    = '';
           this.PedPcjeIva    = 0.00;
        },

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
          ProductoExisteEnPedido( id_prd ){
            var Existe = false;
            this.NuevoPedido.forEach((item) => {
                 if ( item.id_prd == id_prd ){
                   Existe = true;
                 }
             });
            if ( Existe == true ){
                 this.$swal(MSG.Reg_Doble_Tit, MSG.Ped_Prd_Doble, 'info')
                }
             return Existe;
          },

          AgregarProductoPedido( data ){
              if (this.ProductoExisteEnPedido( data.id_prd ) == true ){
                return 'ok';
              }
              this.PedPcjeIva = data.pcje_iva;
              var newItem = {
                  id_prd          : data.id_prd,
                  nom_prd         : data.nom_prd,
                  cant            : JSON.parse(data.cant).toFixed(0),
                  vr_precio_lista : data.vr_precio_lista,
                  descrip         : data.descrip,
                  id_fact_dt      : data.id_fact_dt,
                  vr_flete        : 0,
                  vr_fnacion      : 0,
                  vr_precio_adic  : 0,
                  vr_unit_real    : 0,
                  vr_dscto        : 0,
                  pcje_iva        : this.PedPcjeIva,
                  vr_iva          : 0,
                  fcha_ped        : '',
                  nom_present     : data.nom_present
              };
              this.NuevoPedido.push( newItem );
              toastr.success( MSG.Ped_Prd_Add);
              console.log( this.PedPcjeIva );
          },

        NuevaBusqueda() {
            this.id_terc       = 0;
            delete this.ErrorsController['id_terc'] ;
        },

     }
   }

</script>

