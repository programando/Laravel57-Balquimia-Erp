<template>
  <div class="container">

      <mstro-3-columnas :DatosTabla='DatosTabla'
              @HijoEditarReg     ="ParentEditarReg"
              @BtnTablaBorrarReg ="ShowModalBorrar"
              @BtnTablaEditReg   ="ShowModalEdit"
              :Pagination        ="Pagination" >
            <template slot='CardTitle'>Cargos</template>
            <template slot='BtnAddcaption'>Agregar Nuevo Cargo</template>
            <template slot='Column1Caption'>Nombre/Descripción</template>
            <template slot='Column2Caption'>Estado</template>
            <template slot='Column3Caption'>Editar/Eliminar</template>
        </mstro-3-columnas>

        <delete-record  :Registro="DatosModal" @BorraRegDataBase="BorraRegDataBase"  >
                <template slot="ModalTitle">Confirma que desea borrar el cargo que se muestra en pantalla ?</template>
        </delete-record>

        <edit-record  :Registro="DatosModal" :ErrorsController="ErrorsController"
                  @ActualizarRegDataBase="ActualizarRegDataBase" @CierraModal="CierraModalEdit">
                <template slot="ModalTitle">Modificación del registro</template>
        </edit-record>



  </div>
</template>

<script>
    import FormValidation from '../../mixins/FormValidation';
    import { MSG }        from '../../files/messages.js';
    export default {
        mounted() {
            this.Listar();
            this.UrlBase = '/cargos/';
           },
        data() {
            return {
                 DatosModal     : [],
                 DatosTabla     : [],
                 UrlBase        : '',
                 //ErrorsController  : {},
                 Pagination        : {},
                 id_cargo          : 0,
                 nom_cargo         : '',
                 inactivo          : 0,
                 ErrorsController  : {},
              }
       },
       mixins: [FormValidation],
       methods: {
          Listar(){
            let Me = this
            axios.get(`/cargos?page=${this.$route.query.page || 1}`)
            .then( response =>{
               Me.DatosTabla =  response.data.data ;
               Me.Pagination = response.data;
               delete Me.Pagination.data;
               this.ErrorsController = {};
            })
            .catch ( this.ErrorOnFail ) ;
          },
          CierraModalEdit(){
            this.Listar();
          },

        ParentEditarReg ( Registro ) {
                alert ('Emitido desde hijo' + Registro );
            },

        ShowModalBorrar ( Registro ) {
                this.DatosModal = Registro;
            },

        ShowModalEdit ( Registro ){
              this.DatosModal = Registro;
         },

        GrabarRegDataBase( Registro ){
                let Me = this;
                var url = this.UrlBase + Registro.id_reg;
                axios.post(this.UrlBase,{'nom_cargo' : Registro.nom_cargo
                }).then( response => {
                    Me.ModalClose();
                    Me.Listar();
                    toastr.success( "Registro grabado con éxito !!!");
                })
                //.catch(this.ErrorOnFail );
            },
            ActualizarRegDataBase( Registro ){
                let Me   = this;
                let URL  = this.UrlBase + Registro.id_reg;
                axios.put( URL,{'nom_cargo' : Registro.nom_reg, 'id_cargo' : Registro.id_cargo, 'inactivo' : Registro.inactivo
                }).then(  response => {
                    Me.Listar();
                    $('#ModalEditReg').modal('hide');
                    toastr.success( MSG.DbUpdOk );
                })
                .catch( this.ErrorOnFail );
            },

          BorraRegDataBase( Registro){
                let Me = this;
                var url = this.UrlBase + Registro.id_reg;
                axios.delete(url).then(response => {
                  Me.Listar();
                  toastr.success( MSG.DbDelOk);
                }).catch( error => {
                    toastr.error( MSG.DbIntegridad);
                  });
             },

       }, // Methods

    };
</script>




