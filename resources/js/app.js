
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

//window.Vue = require('vue');

import Vue              from 'vue';
import router           from './routes';

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.component('pagination-links'                ,require( './components/PaginationLinks' ));
Vue.component('mstro-3-columnas'                ,require( './components/MstroDescripActivoEditDel' ));
Vue.component('delete-record'                   ,require( './components/modals/DeleteRecord' ));

const VueApp = new Vue({
    el: '#VueApp',
    router,
});
