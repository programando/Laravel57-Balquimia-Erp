<template>
     <div>
          <multiselect
                :clear-on-select ="false"
                :close-on-select ="true"
                :multiple        ="false"
                :options         ="municipios"
                :preselect-first ="true"
                :preserve-search ="false"
                @remove          ="seleccionarMcipio"
                @select          ="seleccionarMcipio"
                deselectLabel    = "Presione enter para borrar"
                label            ="nom_mcpio"
                placeholder      = 'Seleccione municipio'
                selectLabel      ="Presione enter para seleccionar"
                track-by         ="nom_mcpio"
                v-model          = 'mcipioSeleccionado'
            >
              <template slot="noResult">No se han encontrado registros</template>
            </multiselect>


    </div>
</template>


<script >
  import Multiselect from 'vue-multiselect'
  export default {
    mounted(){
        this.listadoGeneral();
    },
    data(){
        return {
            municipios : [],
            mcipioSeleccionado : [],
        }
    },
    components :{ Multiselect },
    methods:{
        listadoGeneral(){
         axios.get('/municipios/listado')
          .then( response => {
              this.municipios = response.data;
          });
        },
        seleccionarMcipio( mcipioSeleccionado ){
            this.$emit('seleccionarMcipio',mcipioSeleccionado );
        }
    }
  }
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css">


</style>
