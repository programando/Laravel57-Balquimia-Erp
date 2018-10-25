<template>
    <!--
    <mstro-3-columnas :DatosTabla='DatosTabla' @HijoEditarReg="ParentEditarReg">
        <template slot='CardTitle'>Cargos</template>
        <template slot='BtnAddcaption'>Agregar Nuevo Cargo</template>
        <template slot='Column1Caption'>Nombre/Descripción</template>
        <template slot='Column2Caption'>Estado</template>
        <template slot='Column3Caption'>Editar/Eliminar</template>
    </mstro-3-columnas>
-->
<div class="container">
  <button type="button" class="btn btn-outline-primary block btn-lg" data-toggle="modal" data-backdrop="false" data-target="#backdrop1">
                            Launch Modal
                          </button>

<delete-record  IdModal='backdrop1' >
  <template slot="ModalTitle"> Confirma que dese aborrar el registro que se muestra en pantalla ?</template>
</delete-record>
</div>
</template>

<script>
   /* import FormValidation from '../../mixins/FormValidation';
   <pagination-links :Pagination="Pagination"> </pagination-links>
    import Modals         from '../../mixins/Modals';
    import { CONFIG }     from '../../config.js';
    */


    //return axios.get( CONFIG.API_URL + '/cafes' );
    //https://serversideup.net/build-vuex-module/

    export default {
        mounted() {
            this.Listar();
            //console.log( CONFIG.ERROR_MSG)
           },
        data() {
            return {
                 DatosTabla        : [],
                 //ErrorsController  : {},
                 Pagination        : {},
                 id_cargo          : 0,
                 nom_cargo         : '',
                 inactivo          : 0,
              }
       },


       //mixins: [ FormValidation, Modals ],



       methods: {
          Listar(){
            let Me = this
            axios.get(`/cargos?page=${this.$route.query.page || 1}`)
            .then( response =>{
               Me.DatosTabla =  response.data.data ;
               Me.Pagination = response.data;
               delete Me.Pagination.data;
            })
            .catch ( this.ErrorOnFail ) ;
          },
       ParentEditarReg ( Registro ) {
              alert ('Emitido desde hijo' + Registro );
          },


          Grabar(){
                let Me = this;
                axios.post('/cargos',{'nom_cargo' : Me.nom_cargo
                }).then( response => {
                    Me.ModalClose();
                    Me.Listar();
                    toastr.success( "Registro grabado con éxito !!!");
                })
                //.catch(this.ErrorOnFail );
            },
            Actualizar(){
                let Me   = this;
                let URL  = '/cargos/'+Me.id_cargo;
                axios.put( URL,{'nom_cargo' : Me.nom_cargo, 'id_cargo' : Me.id_cargo, 'inactivo' : Me.inactivo
                }).then(  response => {
                    Me.ModalClose();
                    Me.Listar();
                    toastr.success( 'Registro actualizado con éxito !!!!' );
                })
                //.catch( this.ErrorOnFail );
            },
          Borrar(){
                let Me = this;
                var url = '/cargos'   + '/'+this.id_cargo;
                axios.delete(url).then(response => {
                  Me.ModalClose();
                  Me.Listar();
                  toastr.success( "Registro borrado con éxito !!!!");
                }).catch( error => {
                    toastr.error( "El registro no pudo ser eliminado porque causaría inconsistencias en su base de datos.");
                  });
             },

          ClearFields(){
              this.nom_cargo  = '';
              this.id_cargo   = 0;
          },

          DataFields( data ){
            this.nom_cargo  = data.nom_cargo;
            this.id_cargo   = data.id_cargo;
            this.inactivo   = data.inactivo;
          },
       }, // Methods

    };
</script>




