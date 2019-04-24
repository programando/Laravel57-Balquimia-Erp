
<template>
   <div>
      <div v-if="NotasCartera.length">
        <table class="table table-responsive-sm table-bordered table-striped table-sm table-hover">
          <thead>
            <tr>
              <th>Fecha</th>
              <th>Observaciones</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="NotaCartera in NotasCartera" :key="NotaCartera.id_terc_nota">
                <td>{{ NotaCartera.fcha_nota | FormatoFecha }}</td>
                <td>{{ NotaCartera.cartera  }}</td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="col-sm-12 text-center" v-else>
        <br><br>
        <strong> <h4>No se han registrado observaciones de cartera</h4><br><br></strong>
      </div>

    </div>
</template>

<script>

  export default{
      props :['IdTercero'],
      data(){
          return {
               NotasCartera :[],
               ErrorsController  : {},
          }
      },

      watch: {
          IdTercero : function(){
             this.NotasCartera = this.BuscarNotasCartera ? this.IdTercero>0 : [];
            },

      methods :{
          BuscarNotasCartera (){
             let Me = this;
            let Url = '/terceros/notas/cartera' + '?id_terc='+this.IdTercero;
            axios.get( Url )
              .then( response =>{
                  Me.NotasCarteras = response.data;
              })
          },
        }
      }

  };
</script>





