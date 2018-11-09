<template>
    <div class="row justify-content-center">
      <div class="col-lg-8 col-md-12">
        <div class="card border-info">
          <div class="card-header">
            <div class="row">
              <div class="col-md-8 d-flex align-items-center">
                <h4><i class="la la-bars"></i><span class="menu-title card-title text-dark" data-i18n="nav.dash.main" >&nbsp;<strong >
                  <slot name='CardTitle'> Título </slot> </strong></span></h4>
              </div>
              <div class="col-lg-4">

                <button class="btn btn-success  btn-sm float-md-right"  data-target="#ModalNewReg"  data-toggle="modal" >
                    <i class="ft-folder"></i>
                    <slot name='BtnAddcaption'> Agregar nuevo cargo        </slot>
                </button>


              </div>
            </div>
          </div>
          <div class="card-content" aria-expanded="true">
            <div class="card-body">
              <div class="card-text">
                <div class="table-responsive table-sm">
                  <table class="table table-striped table-bordered table-hover">
                    <thead >
                      <tr>
                        <th><slot name='Column1Caption'> Descripción </slot> </th>
                        <th><slot name='Column2Caption'> Activo ? </slot></th>
                        <th><slot name='Column3Caption'> Editar/Eliminar </slot></th>
                      </tr>
                    </thead>
                    <tbody >

                      <tr v-for="Registro in DatosTabla">
                        <td v-text="Registro.nom_reg"></td>
                        <td class="text-center">
                            <span v-if="Registro.inactivo" class="badge badge-danger">Inactivo</span>
                            <span v-else class="badge badge-success">Activo</span>
                          </td>
                        <td class="text-center" width="15%">
                            <button type="button" class="btn btn-icon btn-info  btn-xs"
                                      data-target="#ModalEditReg" data-toggle="modal" data-original-title="Modificar registro" @click="BtnTablaEditReg ( Registro )" >
                                      <i class="icon-pencil"></i>
                             </button>

                             <button type="button" class="btn btn-icon btn-danger  btn-xs"
                                      data-target="#ModalBorraReg" data-toggle="modal" data-original-title="Eliminar registro" @click="BtnTablaBorrarReg ( Registro )" >
                                      <i class="icon-trash"></i>
                             </button>

                        </td>
                      </tr>
                    </tbody>
                  </table>
                   <pagination-links :Pagination="Pagination"> </pagination-links>
                </div>
              </div>
            </div>
          </div>
         </div>
      </div>

    </div>
</template>

<script >
    export default {
        props : [ 'DatosTabla', 'Pagination'],
        methods:{
              BtnTablaEditReg (Registro){
                  this.$emit( 'BtnTablaEditReg',Registro );
              },
              BtnTablaBorrarReg (Registro){
                  this.$emit( 'BtnTablaBorrarReg',Registro );
              },
        }
    };
</script>
