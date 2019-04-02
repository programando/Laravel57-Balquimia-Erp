<template>

  <div class="card" >
    <strong>
      <div class="card-header card-header-bg" >
        <h4><i class="la la-bars"></i>&nbsp;&nbsp;Listado de Precios</h4>
      </div>
    </strong>
    <div class="card-content ">
      <div class="card-body align-content-center">
        <div class="row ">
          <div class="col-sm-12">
            <vue-good-table
                      :columns      ="columns"
                      :rows         ="rows"
                      :fixed-header ="true"
                      max-height    ="800px"
                      styleClass    ="vgt-table bordered condensed striped vgt-left-align"
                      :search-options="{
                            enabled: true,
                            placeholder: 'Buscar producto',
                            skipDiacritics: true,
                        }"
                      :pagination-options="{
                            allLabel:         'Todos',
                            enabled:          true,
                            mode:             'pages',
                            nextLabel:        'Siguiente',
                            ofLabel:          'de',
                            pageLabel:        'página',
                            prevLabel:        'Anterior',
                            rowsPerPageLabel: 'Registro por pág.',
                            perPage: 15,
                    }"
               >
            </vue-good-table>
      </div>
  </div>   <!-- /Row 1-->

</div>
</div>
</div>   <!-- / Card-->

</template>

<script>
  import { VueGoodTable } from 'vue-good-table';
  import Numeral from 'numeral';
  export default {
     mounted(){
        this.consultaPrecios();
     },
     data() {
        return {
              columns : [
                {  label: ' Producto',
                   field: 'nom_prd',  },
                {  label: ' Presentación',
                   field: 'nom_present',  },
                {  label: ' $ Precio ( Sin Iva )',
                   field: 'vr_vta',
                   type : 'number',
                   formatFn: this.formatFn,
                   sortable: false },

              ],
              rows    : []
        }
     },
     components :{ VueGoodTable },
     methods :{
          consultaPrecios(){
              axios.get('/productos/precios')
              .then ( response => {
                    this.rows = response.data;
              });
          },
          formatFn: function(value) {
            return Numeral(value).format('0,0');
          }
     }



  }

</script>
