<template>
  <div class="container">

    <div v-if="DetallePedido.length ">
      <div class="col-sm-12 text-center negro mb-05" >
         <strong>
          <slot name="DatosCliente">
            <h5></h5>
         </slot>
         </strong>
      </div>
      <table class="table table-responsive-sm table-bordered table-striped table-sm" >
        <thead>
          <tr>
            <th> Producto</th>
            <th> Present.</th>
            <th> Cant</th>
            <th> $ Base</th>
            <th> Flete</th>
            <th> Mayor Vr.</th>
            <th> Vr.Unit.</th>
            <th> Vr.Total.</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(Pedido, index) in DetallePedido" :key="Pedido.id_ped_dt">
              <td > {{ Pedido.nom_prd  }}  </td>
              <td> {{ Pedido.nom_present  }}   </td>
              <td> {{ Pedido.cant | NumeroEntero  }}   </td>
              <td class="text-right"> {{ Pedido.vr_precio_lista | NumeroEntero  }} </td>
              <td class="text-right"> {{ Pedido.vr_flete        | NumeroEntero  }} </td>
              <td class="text-right"> {{ Pedido.vr_precio_adic  | NumeroEntero  }} </td>
              <td class="text-right"> {{ Pedido.vr_unit_real    | NumeroEntero  }} </td>
              <td class="text-right"> {{ Pedido.vt_tot_item     | NumeroEntero }}</td>
            </tr>
          </tbody>
         </table>
      </div>



    </div>
  </template>

<script >
  export default {
    props : [ 'DetallePedido'],
    data(){
        return {

        }
    },
  }

</script>
