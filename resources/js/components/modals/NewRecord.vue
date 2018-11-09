<template>
  <div class="modal fade text-left" id="ModalNewReg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4" aria-hidden="true" data-backdrop="static" data-keyboard="false" >
    <div class="modal-dialog modal-danger" role="document">
      <div class="modal-content border-info">
        <div class="modal-header bg-info ">
          <h5 class="modal-title text-white" id="myModalLabel4">
          <slot name='ModalTitle'>Basic Modal</slot></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <br>
      <form class="form-horizontal form-simple" novalidate method="POST" enctype="multipart/form-data"
              @keydown="ErrorsClearLocal($event.target.name)">

        <fieldset class="form-group position-relative" :class="{ 'error' : ErrorValidacion}">
               <div :class="{ 'error' : ErrorValidacion}"> Descripción del cargo </div>
               <input type="text" class="form-control form-control-lg input-lg"
                  v-model="Registro_Nom" >
          <div class="invalid-data" v-if="ErrorValidacion"> <i class="ft-x-square"></i>&nbsp;<span class="invalid-data"> Cargo o perfil es un dato obligatorio. </span></div>
        </fieldset>


      </form>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn grey btn-secondary btn-sm" data-dismiss="modal" @click="CierraModal" >Cancelar</button>
          <button type="button" class="btn btn-success btn-sm"  @click="GrabarRegDataBase( Registro_Nom )">Grabar</button>
        </div>
      </div>
    </div>
  </div>

</template>

<script >

    export default {
       data(){
          return {
                ErrorValidacion   : false,
                Registro_Nom      : '',
                Registro_Inactivo : false,
          }
       },
        methods:{
          GrabarRegDataBase( Registro  ){
              if ( this.Registro_Nom.length == 0){
                  this.ErrorValidacion =  true
              } else {
                this.$emit( 'GrabarRegDataBase', this.Registro_Nom );
                this.Registro_Nom = '';
              }
          },
          ErrorsClearLocal(){
                  this.ErrorValidacion = false;
           },
          QuitarClaseError ( Control ) {
              this.$emit( 'QuitarClaseError',Control );
          },
          CierraModal(){
            this.$emit( 'CierraModal');
          }
        }
    };

</script>
