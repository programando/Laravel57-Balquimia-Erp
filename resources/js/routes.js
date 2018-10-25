
import Vue       from 'vue';
import Router    from 'vue-router';
Vue.use(Router);
Vue.config.devtools = true;


export default new Router({
   routes : [
        { component : require('./components/maestros/Cargos'),
          name      : 'inicio',
          path      : '/'     },

        { component : require('./components/maestros/Cargos'),
          name      : 'cargos',
          path      : '/cargos'     },

   /*     { component : require('./views/maestros/UndsMedida') ,
          name      : 'medidas',
          path      : '/medidas'     },

        { component : require('./views/maestros/Lineas') ,
          name      : 'lineas',
          path      : '/lineas'     },

        { component : require('./views/maestros/LineasSubLineas') ,
          name      : 'sublineas',
          path      : '/sublineas'     },

       { component : require('./views/app/Pedidos') ,
          name      : 'pedidos',
          path      : '/pedidos'     },


        { path      : '*' ,
          component : require('./components/errors/404')
        }*/

      ],
   linkExactActiveClass: 'active',
   //linkActiveClass:   'active',
   mode:              'history',
   scrollBehavior(){
      return { x:0, y:0 };
   }
});
