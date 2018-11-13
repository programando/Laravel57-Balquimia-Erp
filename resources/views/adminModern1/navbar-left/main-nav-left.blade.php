  <!-- ////////////////////////////////////////////////////////////////////////////-->
  <div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
      <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
      <li>  <router-link :to="{name:'DashBoard'}" class="menu-item">Dashboard   </router-link>     </li>

        <li class=" nav-item">
         <i class="la la-home"></i><span class="menu-title" data-i18n="nav.dash.main">Configuración</span>
          <ul class="menu-content">
            <li>  <router-link :to="{name:'cargos'}" class="menu-item">Cargos   </router-link>     </li>
            <li>  <router-link :to="{name:'ejemplo'}" class="menu-item">Otro Menu   </router-link>     </li>
          </ul>
        </li>

      </ul>
    </div>
  </div>
