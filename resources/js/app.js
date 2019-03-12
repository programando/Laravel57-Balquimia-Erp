
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./files/bootstrap');
var Moment = require('moment');
var Numeral = require('numeral');

Moment.locale("es");


import Vue              from 'vue';
import router           from './files/routes';
import {store}          from './files/store'
import VueSweetalert2   from 'vue-sweetalert2';


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.component('pagination-links'                ,require( './components/user_interface/PaginationLinks' ));
Vue.component('btn-load-modal-del'              ,require( './components/user_interface/btn-load-modal-delreg' ));
Vue.component('mstro-3-columnas'                ,require( './components/views/MstroDescripActivoEditDel' ));
Vue.component('delete-record'                   ,require( './components/modals/DeleteRecord' ));
Vue.component('edit-record'                     ,require( './components/modals/EditRecord' ));
Vue.component('new-record'                      ,require( './components/modals/NewRecord' ));

Vue.filter('FormatoFecha', (value) => {  return Moment(value).format('DD-MMM-YYYY');     });
Vue.filter('FechaCorta', (value) => {  return Moment(value).format('DD-MM-YY');     });
Vue.filter('NumeroEntero', (value) => {  return Numeral(value).format('0,0');             });
Vue.filter('Capitalize', (value) => {
   if (!value) return ''
    value = value.toString()
    return value.charAt(0).toUpperCase() + value.slice(1)
   });

Vue.use(VueSweetalert2);



const VueApp = new Vue({
    el: '#VueApp',
    router,
    store,
});

/*
  librerias usadas
  ----------------------------------------------------------------------------------------------------------------
  NOMBRE            USO                             URL
  ----------------------------------------------------------------------------------------------------------------
                   Componentes hechos con vue       https://madewithvuejs.com
 vue-datetime       Manejo de fechas y horas        https://github.com/mariomka/vue-datetime?ref=madewithvuejs.com
                    Demo                            https://mariomka.github.io/vue-datetime/


*/
