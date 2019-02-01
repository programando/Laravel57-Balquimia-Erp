<template>
   <div>
      <div v-if="FacturasCartera.length">
        <strong>
          <div v-if="TotalVencido" class="text-right negro p-1" >TOTAL CARTERA VENCIDA  : {{ TotalVencido | NumeroEntero }}</div>
        </strong>
        <table class="table table-responsive-sm table-bordered table-striped table-sm table-hover">
          <thead>
              <tr>
              <th>Fecha</th>
              <th>Factura</th>
              <th>Vr.Factura</th>
              <th>Plazo</th>
              <th>Días hoy</th>
              <th>Acum.Vencido</th>
              </tr>
           </thead>
            <tbody>
            <tr v-for="Factura in FacturasCartera" :key="Factura.id_reg">
              <td :class="{'alerta' : AplicaAlerta(Factura)  }">{{ Factura.fcha_fact | FormatoFecha }}</td>
              <td class="text-right" :class="{'alerta' : AplicaAlerta(Factura)  }" >{{ Factura.num_fact  }}</td>
              <td class="text-right" :class="{'alerta' : AplicaAlerta(Factura)  }">{{ Factura.vr_tot_fact | NumeroEntero }}</td>
              <td class="text-right" :class="{'alerta' : AplicaAlerta(Factura)  }">{{ Factura.plazo_fact  }}</td>
              <td class="text-right" :class="{'alerta' : AplicaAlerta(Factura)  }">{{ Factura.dias_a_hoy  }}</td>
              <td class="text-right" :class="{'alerta' : AplicaAlerta(Factura)  }"> {{ Factura.vr_acum_vencido | NumeroEntero }}</td>
            </tr>
            </tbody>
        </table>
      </div>
      <div class="col-sm-12 text-center" v-else>
        <br><br>
        <strong><h4>No se han encontrado facturas asociadas al cliente o no tiene facturas pendientes de pago</h4></strong><br><br>
      </div>

    </div>
</template>

<script>
  import FormValidation from '../../mixins/FormValidation';
  export default{
      props :['IdTercero'],
      data(){
          return {
              FacturasCartera : [],
              ErrorsController      : {},
              VrAcumuladoVencido    : 0,
              ExisteCarteraVencida  : false,
          }
      },
      minxins : [FormValidation ],
      watch: {
            IdTercero : function (){
                this.FacturasCartera = this.BuscarFacturasPorPago() ? this.IdTercero > 0 : [];
            },
      },

      computed:{

        TotalVencido (){
            var $AcumuladoVencido     = 0.0;
            this.ExisteCarteraVencida = false;
            this.FacturasCartera.forEach(( item ) =>{
            if ( item.dias_a_hoy > item.plazo_fact ){
                  $AcumuladoVencido += parseFloat( item.vr_tot_fact );
              }
            });
            return  $AcumuladoVencido;
        },
    }, // Computeds


     methods: {
       // Returna true para aplicar clase css ( fondo rojo)
        AplicaAlerta( item ){
            return item.dias_a_hoy > item.plazo_fact
        },

       BuscarFacturasPorPago(){
             let Me = this;
            let Url = '/terceros/clientes/cartera' + '?id_terc='+this.IdTercero;
            axios.get( Url )
              .then( response =>{
                  this.FacturasCartera = response.data;
              })
              .catch( this.ErrorOnFail );
          },

          MensajeCarteraVencida(){
                this.ExisteCarteraVencida = false;
                this.FacturasCartera.forEach(( item ) =>{
                if ( item.vr_acum_vencido > 0 ){
                     this.ExisteCarteraVencida = true;
                  }
            });
            if ( this.ExisteCarteraVencida ){
                toastr.success( "Mensaje de Cartera" );
            }
          },

      }, // Methods


  };
</script>
