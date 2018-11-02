
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./files/bootstrap');

//window.Vue = require('vue');

import Vue              from 'vue';
import router           from './files/routes';
import {store}          from './files/store'

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.component('pagination-links'                ,require( './components/user_interface/PaginationLinks' ));
Vue.component('btn-load-modal-del'              ,require( './components/user_interface/btn-load-modal-delreg' ));
Vue.component('mstro-3-columnas'                ,require( './components/views/MstroDescripActivoEditDel' ));
Vue.component('delete-record'                   ,require( './components/modals/DeleteRecord' ));
Vue.component('edit-record'                   ,require( './components/modals/EditRecord' ));

const VueApp = new Vue({
    el: '#VueApp',
    router,
    store,

});

