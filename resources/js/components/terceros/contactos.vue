<template>
   <div>
    <div class="table-responsive" v-if="Contactos.length">
        <table class="table table-responsive-sm table-bordered table-striped table-sm table-hover" >
          <thead>
              <tr>
                <th> </th>
                <th> Nombre Contacto</th>
                <th> Área Empresa</th>
                <th> Email</th>
                <th> Nro.Teléfono</th>
              </tr>
          </thead>
          <tbody>
            <tr v-for="Contacto in Contactos"  :key="Contacto.id_contacto">
               <td v-text="Contacto.nom_titulo"> </td>
               <td v-text="Contacto.nom_contacto"> </td>
               <td v-text="Contacto.nom_area_empsa"> </td>
               <td v-text="Contacto.email"> </td>
               <td v-text="Contacto.nro_tel"> </td>
            </tr>
          </tbody>
      </table>
    </div>
    <div class="col-sm-12 text-center" v-else>
       <br><br>
       <strong> <h4>No se han registrado contactos en la ficha del cliente </h4></strong><br><br>
    </div>

    </div>
</template>

<script>
import FormValidation from '../../mixins/FormValidation';
  export default{

      props :['IdTercero'],
      data(){
          return {
              Contactos : [],
              ErrorsController  : {},
          }
      },
      mixins: [FormValidation],
      watch:{
            IdTercero : function(){
                this.Contactos = this.BuscarContactos() ? this.IdTercero >0 : [];
            },
      },

      methods:{
        BuscarContactos(){
             let Me = this;
            let Url = '/terceros/contactos' + '?id_terc='+this.IdTercero;
            axios.get( Url )
              .then( response =>{
                  Me.Contactos = response.data;
              })
              .catch( this.ErrorOnFail );
          },
      },

  };
</script>
