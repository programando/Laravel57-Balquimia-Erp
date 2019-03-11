<template>
  <div class="row">
    <div class="col-sm-12" >
      <div class="table-responsive" v-if="ProductosComprados.length" >
        <table class="table table-bordered table-striped table-hover table-sm" >
          <thead>
            <tr>
              <th> O.C.</th>
              <th> Fecha</th>
              <th> Plazo</th>
              <th> Factura</th>
              <th> Producto</th>
              <th> Present.</th>
              <th> Descrip.</th>
              <th> Cant.</th>
              <th> $ Unit</th>
              <th> Flete </th>
              <th> My.Valor</th>
              <th> Dscto</th>
              <th> $ Item</th>
              <th> $ SubTotal</th>

            </tr>
          </thead>
          <tbody>
            {{ ProductosComprados.id_btcra }}
            <tr v-for="Producto in ProductosComprados"  :key="Producto.id_btcra">
              <td> {{ Producto.num_ord_cpra}} </td>
              <td> {{ Producto.fcha_fact | FormatoFecha }} </td>
              <td> {{ Producto.plazo_fact   }} </td>
              <td> {{ Producto.prfjo_rslcion   }} {{ Producto.num_fact   }}</td>
              <td v-text="Producto.nom_prd"> </td>
              <td v-text="Producto.nom_present"> </td>
              <td> {{ Producto.descrip  }} </td>
              <td class="text-right"> {{ Producto.cant            | NumeroEntero  }} </td>
              <td class="text-right"> {{ Producto.vr_precio_lista | NumeroEntero  }} </td>
              <td class="text-right"> {{ Producto.vr_flete        | NumeroEntero     }} </td>
              <td class="text-right"> {{ Producto.vr_precio_adic  | NumeroEntero   }} </td>
              <td class="text-right"> {{ Producto.vr_unit_real    | NumeroEntero  }} </td>
              <td class="text-right"> {{ Producto.vt_tot_item    | NumeroEntero  }} </td>
              <td>

            </td>
          </tr>
        </tbody>
      </table>
    </div>

      <div class="col-sm-12 text-center" v-else>
        <br><br>
        <strong><h4>No se han encontrado registros en ventas</h4></strong><br><br>
      </div>

  </div>
</div><!-- Row-->
</template>


<script>

  export default{
    props : ['IdTercero'],
    mounted(){
        this.BuscarCompras()
    },
     data() {
        return {
            ProductosComprados : [],
            ErrorsController  : {},
        }
      },

       watch: {
            IdTercero : function(){
              this.ProductosComprados = this.BuscarCompras() ? this.IdTercero > 0 : [];
            }
        },

    methods: {

        BuscarCompras(){
           let Me = this;
           let Url = '/clientes/compras/ultimos-anios'  ;
           let reporInfo = {
                id_terc :this.IdTercero,
                anios   : 3
              }
            axios.get( Url,  { params: reporInfo })
              .then( response =>{
                  Me.ProductosComprados = response.data;
              })
              .catch( this.ErrorOnFail );
          },
        }
  };

</script>


