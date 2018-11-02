<template>
  <div class="modal fade text-left" id="ModalBorraReg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4" aria-hidden="true" data-backdrop="static" data-keyboard="false" >
    <div class="modal-dialog modal-danger" role="document">
      <div class="modal-content border-danger">
        <div class="modal-header bg-danger ">
          <h5 class="modal-title text-white" id="myModalLabel4">
          <slot name='ModalTitle'>Basic Modal</slot></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <p> <strong>{{ Registro.nom_reg }} ?  </strong></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn grey btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" @click="BorraRegDataBase( Registro )">Borrar</button>
        </div>
      </div>
    </div>
  </div>

</template>

<script >
    export default {
        props : [ 'Registro' ],
        methods:{
          BorraRegDataBase( Registro ){
              this.$emit( 'BorraRegDataBase',Registro );
          }
        }
    };
</script>
