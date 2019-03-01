
import Vue       from 'vue';
import Router    from 'vue-router';
Vue.use(Router);
Vue.config.devtools = true;


export default new Router({
   routes : [
        { component :
              require('../app/inicio/DashBoard'),                   name: 'DashBoard',             path: '/das'     },
        { component :
              require('../app/maestros/Cargos'),                    name: 'cargos',                path: '/cargos'     },
        { component :
              require('../app/comercial/Pedidos'),                  name: 'pedidos',               path: '/pedidos'     },
        { component :
              require('../app/comercial/ProductosPrecios'),       name: 'prdprecios',            path: '/'     },



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
  linkExactActiveClass: 'link-active',
  linkActiveClass:      'link-exact-active',
   mode:              'history',
   scrollBehavior(){
      return { x:0, y:0 };
   }
});
