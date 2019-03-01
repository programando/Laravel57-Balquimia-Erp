  <!-- ////////////////////////////////////////////////////////////////////////////-->

  <div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">

      <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
       <li>  <router-link
                 :to="{name:'DashBoard'}" class="menu-title">
                 <i class="la la-home"></i> Dashboard
             </router-link>
        </li>

        <li class=" nav-item nav-item-app">
         <i class="la la-group"></i><span class="menu-title" data-i18n="nav.dash.main">Comercial</span>
          <ul class="menu-content">
            <li>  <router-link :to="{name:'pedidos'}" class="menu-item-op">Registro de Pedidos   </router-link>     </li>
            <li>  <router-link :to="{name:'prdprecios'}" class="menu-item-op">Listado de Precios  </router-link>     </li>
          </ul>
        </li>

        <li class=" nav-item nav-item-app">
         <i class="la la-gear"></i><span class="menu-title" data-i18n="nav.dash.main">Configuración</span>
          <ul class="menu-content">
            <li>  <router-link :to="{name:'cargos'}" class="menu-item-op">Cargos   </router-link>     </li>
            <li>  <router-link :to="{name:'ejemplo'}" class="menu-item-op">Otro Menu   </router-link>     </li>
          </ul>
        </li>

      </ul>
    </div>
  </div>


