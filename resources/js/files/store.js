import Vue      from 'vue';
import Vuex     from 'vuex';

Vue.use( Vuex );
export const store = new Vuex.Store ({
    state :{
        algo : 'algo que se esta almancenando en el store',
    }
});
