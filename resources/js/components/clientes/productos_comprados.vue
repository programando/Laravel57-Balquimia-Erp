<template>
  <div class="row">
    <div class="col-sm-12" >
      <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover" >
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
              <th> Dscto</th>
              <th> Vr.Unit.</th>
              <th> </th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="Producto in ProductosComprados"  :key="Producto.id_fact_dt">
              <td> {{ Producto.fcha_fact | FormatoFecha }} </td>
              <td> {{ Producto.num_fact   }} </td>
              <td v-text="Producto.nom_prd"> </td>
              <td> {{ Producto.descrip  }} </td>
              <td class="text-right"> {{ Producto.cant            | NumeroEntero  }} </td>
              <td class="text-right"> {{ Producto.vr_precio_lista | NumeroEntero  }} </td>
              <td class="text-right"> {{ Producto.vr_flete        | NumeroEntero     }} </td>
              <td class="text-right"> {{ Producto.vr_precio_adic  | NumeroEntero   }} </td>
              <td class="text-right"> {{ Producto.vr_dscto        | NumeroEntero   }} </td>
              <td class="text-right"> {{ Producto.vr_unit_real    | NumeroEntero  }} </td>
              <td>
                <button   title="Agregar Producto"
                type="button" class="btn btn-success btn-xs" @click="AgregarProductoPedido( Producto )">
                <i class="la la-shopping-cart" ></i>
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div><!-- Row-->
</template>


<script>

  export default{
    props : ['IdCliente'],
     data() {
        return {
            ProductosComprados : [],
        }
      },
    watch: {
            IdCliente : function(){
              if ( this.IdCliente == 0 ){
                  this.ProductosComprados = [];
              }else{
                this.BuscarCompras();
              }
            }
        },
    methods: {
        AgregarProductoPedido(){

        },
        BuscarCompras(){
            let Me = this;
            let Url = '/clientes/compras' + '?id_terc='+this.IdCliente;
            axios.get( Url )
              .then( response =>{
                  Me.ProductosComprados = response.data;
              });
              //.catch( this.ErrorOnFail );
          },
        }
  };

</script>


