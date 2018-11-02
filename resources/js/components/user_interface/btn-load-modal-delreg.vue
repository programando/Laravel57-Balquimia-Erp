<template>
   <div class="container">
      <button type="button"
              class="btn btn-success  btn-sm float-md-right"
                     data-toggle="modal"
                     data-backdrop="false"
                     data-target="#backdrop1">
                      <slot name="BtnCaption"> Cargar Modal </slot>
        </button>
  </div>
 </template>
 <script >
    export default {
        props : [ 'data-target'],
    };
</script>
