<template>
  <div class="container">
    <button type="button" class="btn btn-sm btn-success" style="margin: 2px;">
        <i class="icon-list"></i> Agregar Productos
    </button>

    <button v-if="NuevoPedido.length > 0" type="button"       class="btn btn-sm btn-primary pull-right" style="margin: 2px;"    @click="GrabarPedido()">
      <i class="icon-basket" ></i> Grabar Pedido
    </button>

    <div v-if="NuevoPedido.length > 0">
      <table class="table table-responsive-sm table-bordered table-striped table-sm">
        <thead>
          <tr>
            <th></th>
            <th> Producto</th>
            <th> Present.</th>
            <th> Cant</th>
            <th> $ Base</th>
            <th> Flete</th>
            <th> Mayor Vr.</th>
            <th> Vr.Unit.</th>
            <th> Vr.Unit.</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(Pedido, index) in NuevoPedido" :key="Pedido.id_fact_dt">
            <td class="text-center">
              <button type="button" class="btn btn-danger btn-sm"  @click="ProductoBorrar(index)" title="Eliminar producto">
               <i class="icon-trash"></i>
              </button> &nbsp;

            </td>
            <td v-text="Pedido.nom_prd"> </td>
            <td> {{ Pedido.descrip  }} </td>

            <td class="text-right ">
              <input class="text-center" type="number" min="1" step="1" v-model="Pedido.cant" style="width: 40px;"
              @blur="ValidarCantidad(Pedido)">
            </td>

            <td class="text-right"> {{ Pedido.vr_precio_lista | NumeroEntero  }} </td>

            <td class="text-right ">
              <input class="text-center"  v-model="Pedido.vr_flete" style="width: 70px;" @blur="ValidarFlete(Pedido)">
            </td>


            <td class="text-right ">
              <input class="text-center"   v-model="Pedido.vr_precio_adic" style="width: 70px;" >
            </td>


            <td class="text-right"> {{ Pedido.vr_unit_real/ Pedido.cant   | NumeroEntero  }} </td>
            <td class="text-right">
              {{ Pedido.vr_unit_real= ( Pedido.vr_precio_lista * Pedido.cant) +
                ( parseFloat(Pedido.vr_flete       * Pedido.cant)) +        parseFloat(Pedido.vr_fnacion * Pedido.cant) +
                parseFloat(Pedido.vr_precio_adic * Pedido.cant)  -        parseFloat(Pedido.vr_dscto   * Pedido.cant)
                | NumeroEntero }}
              </td>


            </tr>
          </tbody>
          <tr>
            <td colspan="7"></td>
            <td class="text-right">   <strong> Sub-Total </strong> </td>
            <td class="text-right">   <strong> {{ PedVrSubtotal=CalcularSubTotal  | NumeroEntero }} </strong> </td>
          </tr>
          <tr>
            <td colspan="7"></td>
            <td class="text-right">   <strong> Descuento:
              <input class="text-center" type="number" min="1"  step="1" v-model="PedPcjeDscto" style="width: 30px;" @blur="ValidarDsctoGlobal()">&nbsp;%
            </strong>
          </td>
          <td class="text-right">   <strong> {{ PedVrDscto=CalcularDescuento  | NumeroEntero }} </strong> </td>
        </tr>
        <tr>
          <td colspan="7"></td>
          <td class="text-right">   <strong> Fletes </strong> </td>
          <td class="text-right" style="width: 25px;">   <strong>
            <input class="text-right"   v-model="PedVrFletes" style="width: 80px;" @blur="ValidarFleteGlobal()"> </strong> </td>
          </tr>
          <tr>
            <td colspan="7"></td>
            <td class="text-right">   <strong> Iva </strong> </td>
            <td class="text-right">   <strong> {{ PedVrIva=CalcularIva  | NumeroEntero }}  </strong> </td>
          </tr>
          <tr>
            <td colspan="7"></td>
            <td class="text-right">   <strong> Total Pedido </strong> </td>
            <td class="text-right">   <strong> {{ PedVrTotPed=CalcularTotalPedido  | NumeroEntero }} </strong> </td>
          </tr>

        </table>
      </div>
      <div class="col-sm-12 text-center" v-else>
        <br><br>
        <h4>No se han seleccionado productos para incluir en el pedido</h4><br><br>
      </div>


    </div>
  </template>

<script >
  export default {
    props : [ 'NuevoPedido', 'id_terc', 'PedPcjeIva'],
    data(){
        return {
              PedVrSubtotal   : 0,
              PedPcjeDscto    : 0.00,
              PedVrDscto      : 0.0,
              PedVrFletes     : 0.0,
              PedVrIva        : 0.0,
              PedVrTotPed     : 0.0,
        }
    },

      computed:{
        CalcularSubTotal() {
            var SubTotal     = 0;
            this.NuevoPedido.forEach((item) => {
                    SubTotal += parseFloat(item.cant * item.vr_precio_lista)   +
                                ( parseFloat(item.vr_flete       * item.cant) ) +
                                ( parseFloat(item.vr_precio_adic * item.cant) ) ;
             });
             return SubTotal;
          },
        CalcularDescuento(){
          return parseFloat(this.PedVrSubtotal * ( parseFloat(this.PedPcjeDscto)/100));
          },
        CalcularIva(){
          return ((parseFloat(this.PedVrSubtotal) + parseFloat(this.PedVrFletes))) * parseFloat(this.PedPcjeIva /100);
          },
        CalcularTotalPedido(){
            return parseFloat(this.PedVrSubtotal) - parseFloat(this.PedVrDscto) + parseFloat(this.PedVrFletes) + parseFloat(this.PedVrIva);
          },

      },

    methods:{
          GrabarPedido(){
                  this.$emit('GrabarPedido','Datos del pedido');
          },
            ValidarDatos(){
            if ( this.id_terc == 0 ){
                toastr.error(MSG.Sel_Cliente);
                return false;
            }
          },
           ValidarCantidad( data=[]){
            if ( data.cant <= 0 )            { data.cant = 1;    }
          },
           ValidarFlete( data=[]){
            if ( data.vr_flete <= 0 )        { data.vr_flete = 0; }
          },
           ValidarDsctoGlobal( ){
            if ( this.PedPcjeDscto < 0 )        { this.PedPcjeDscto = 0; }
          },
           ValidarFleteGlobal( ){
            if ( this.PedVrFletes < 0  || !(isNaN(this.PedVrFletes)) )        {
                this.PedVrFletes = 0;
              }
          },
          ValidarDetalle(){
            if (this.NuevoPedido.length== 0 ){
              this.$swal(MSG.Det_Null_Tit, MSG.Det_Null, 'info')
              return false;
            }else{
              return true;
            }
          },

          ProductoBorrar( index ) {
              this.NuevoPedido.splice(index,1);
      },

    }

  }

</script>
