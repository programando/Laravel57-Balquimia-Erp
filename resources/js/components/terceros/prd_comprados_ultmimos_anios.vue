<template>
  <div class="row">
    <div class="col-sm-12" >
      <div class="table-responsive" v-if="Compras.length" >
        <table class="table table-bordered table-striped table-hover table-sm" >
          <thead>
            <tr>
              <th> Factura</th>
              <th> Fecha</th>
              <th> Plazo</th>
              <th> O.C.</th>
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
          <tr v-for="Producto in tableFacturas" :id="Producto.id_btcra" v-if="Producto.num_fact">
              <td> {{ Producto.prfjo_rslcion   }} {{ Producto.num_fact  }}</td>
              <td> {{ Producto.fcha_fact | FechaCorta }} </td>
              <td> {{ Producto.plazo_fact   }} </td>
              <td> {{ Producto.num_ord_cpra}} </td>
              <td v-text="Producto.nom_prd"> </td>
              <td v-text="Producto.nom_present"> </td>
              <td> <small>{{ Producto.descrip  }} </small></td>
              <td class="text-right"> {{ Producto.cant            | NumeroEntero  }} </td>
              <td class="text-right"> {{ Producto.vr_precio_lista | NumeroEntero  }} </td>
              <td class="text-right"> {{ Producto.vr_flete        | NumeroEntero     }} </td>
              <td class="text-right"> {{ Producto.vr_precio_adic  | NumeroEntero   }} </td>
              <td class="text-right"> {{ Producto.vr_dscto  | NumeroEntero   }} </td>
              <td class="text-right"> {{ Producto.vr_unit_real    | NumeroEntero  }} </td>
              <td class="text-right"> {{ Producto.vt_tot_item    | NumeroEntero  }} </td>
          </tr>
          <tr v-else>
            <td colspan="14"></td>
          </tr>
  <!--
 {{  }}

             <tr v-for="(Producto, index)   in Compras">
              <template v-if="Compras[index-1].num_fact != Compras[index].num_fact && index>0">
                   {{ Producto.nom_prd }}
              </template>
          </tr>
 Lo que yo haría es:
     en el tr agregar v-for="(Producto,Index) in Compras"
     después del tr agregar un
     <template v-if='Producto[index -1].num_fact !== Producto [Index]'> .
          .. Código para agregar nueva fila ...
     <template />

            <tr v-for="Producto in Compras"  :key="Producto.id_btcra">

          </tr>
-->
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
            Compras : [],
            ErrorsController  : {},
        }
      },

       watch: {
            IdTercero : function(){
              this.Compras = this.BuscarCompras() ? this.IdTercero > 0 : [];
            }
        },

      computed: {
        tableFacturas: function () {
          var newArray = []
          var tempID = this.Compras[0].num_fact
          for(var i = 0; i < this.Compras.length; i++) {
            var factura = this.Compras[i]
            if (tempID != factura.num_fact) {
              newArray.push({ id: factura.id_btcra + 'b' }); // Empty & Unique ID
              newArray.push(factura)
              tempID = factura.num_fact
            } else {
              newArray.push(factura)
            }
          }
          return newArray
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
                  Me.Compras = response.data;
              })
              .catch( this.ErrorOnFail );
          },
        }
  };

</script>


