<template>
  <div class="modal fade text-left" id="ModalClientesBuscar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4" aria-hidden="true" data-backdrop="static" data-keyboard="false" >
    <div class="modal-dialog" role="document">
      <div class="modal-content border-success">
        <div class="modal-header bg-info ">
          <h5 class="modal-title text-white" id="myModalLabel4">
          <slot name='ModalTitle'>Basic Modal</slot></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <p> Muestro resultados</p>
        </div>

      </div>
    </div>
  </div>

</template>

<script >
    export default {



    };
</script>
