<template>
  <div class="modal fade text-left" id="ModalEditReg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4" aria-hidden="true" data-backdrop="static" data-keyboard="false" >
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
              @keydown="ErrorsClear($event.target.name)">
        <fieldset class="form-group position-relative" :class="{ 'error' : ErrorHas('nom_cargo')}">
               <input type="text"
                  v-model="Registro.nom_reg"
                  class="form-control form-control-lg input-lg"  >
          <div class="invalid-data" v-if="ErrorHas('nom_cargo')"> <i class="ft-x-square"></i>&nbsp;<span class="invalid-data" v-text="ErrorGet('nom_cargo')"> </span></div>
        </fieldset>


  <!--
                        <fieldset class="form-group position-relative has-icon-left mb-0 {{ $errors->has('email') ? "error" : '' }}" >
                          <input type="text"
                                  class="form-control form-control-lg input-lg"
                                  id="email"
                                  name="email"
                                  placeholder="Correo electrónico"
                                  value       ="{{ old('email') }}"  >
                          <div class="form-control-position"> <i class="ft-user"></i> </div>
                          {!! $errors->first('email', '<div class="invalid-data"> <i class="ft-x-square"></i>&nbsp;:message</div>')  !!}
                        </fieldset>

  -->



        <fieldset>
         <input type="checkbox" id="checkbox" v-model="Registro.inactivo" :checked="Registro.inactivo">
            <label for="checkbox" v-if="!Registro.inactivo"> Registro Activo</label>
            <label for="checkbox" v-else="Registro.inactivo"> Registro Inactivo</label>
        </fieldset>

      </form>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn grey btn-secondary btn-sm" data-dismiss="modal" @click="CierraModal" >Cancelar</button>
          <button type="button" class="btn btn-success btn-sm"  @click="ActualizarRegDataBase( Registro )">Grabar</button>
        </div>
      </div>
    </div>
  </div>

</template>

<script >
 import FormValidation from '../../mixins/FormValidation';
    export default {
        props : [ 'Registro', 'ErrorsController' ],
        mixins: [FormValidation],
        methods:{
          ActualizarRegDataBase( Registro ){
              this.$emit( 'ActualizarRegDataBase',Registro );
          },
          CierraModal(){
            this.$emit( 'CierraModal');
          }

        }
    };

</script>
