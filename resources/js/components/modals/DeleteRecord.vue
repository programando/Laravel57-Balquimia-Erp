<template>
  <div class="modal fade text-left" :id="IdModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4" aria-hidden="true" >
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel4">
          <slot name='ModalTitle'>Basic Modal</slot></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <h5>Check First Paragraph</h5>
          <p>Sweet roll biscuit donut cake gingerbread. Chocolate
            cupcake chocolate bar ice cream. Danish candy
            cake.
          </p>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn grey btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>

</template>

<script >
    export default {
        props : [ 'IdModal' ],
        methods:{

        }

    };

</script>
