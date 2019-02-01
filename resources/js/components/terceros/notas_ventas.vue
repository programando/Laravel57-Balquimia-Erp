<template>
   <div>
      <div v-if="NotasVentas.length">
        <table class="table table-responsive-sm table-bordered table-striped table-sm table-hover">
            <thead>
            <tr>
            <th>Fecha</th>
            <th>Observaciones</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="NotaVenta in NotasVentas" :key="NotaVenta.id_terc_nota">
              <td>{{ NotaVenta.fcha_nota | FormatoFecha }}</td>
              <td>{{ NotaVenta.ventas  }}</td>
            </tr>
            </tbody>
        </table>
      </div>
      <div class="col-sm-12 text-center" v-else>
        <br><br>
        <strong><h4>No se han registrado observaciones de ventas</h4></strong><br><br>
      </div>

    </div>
</template>

<script>
  import FormValidation from '../../mixins/FormValidation';
  export default{
      props :['IdTercero'],
      data(){
          return {
              NotasVentas : [],
              ErrorsController  : {},
          }
      },
      minxins : [FormValidation ],

      watch: {
            IdTercero : function (){
                this.NotasVentas = this.BuscarNotasVenta() ? this.IdTercero > 0 : [];
            },
      },

      methods: {
          BuscarNotasVenta(){
             let Me = this;
            let Url = '/terceros/notas/ventas' + '?id_terc='+this.IdTercero;
            axios.get( Url )
              .then( response =>{
                  Me.NotasVentas = response.data;
              })
              .catch( this.ErrorOnFail );
          },
      }

  };
</script>
