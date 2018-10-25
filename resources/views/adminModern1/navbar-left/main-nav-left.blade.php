  <!-- ////////////////////////////////////////////////////////////////////////////-->
  <div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
      <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

        <li class=" nav-item">
          <router-link :to="{name:'inicio'}" >
            <i class="la la-home"></i><span class="menu-title" data-i18n="nav.dash.main">Dashboard</span><span class="badge badge badge-info badge-pill float-right mr-2">3</span>
          </router-link>
          <ul class="menu-content">
            <li>
                <router-link :to="{name:'cargos'}" class="menu-item">Cargos   </router-link>
            </li>

            <li><a class="menu-item" href="dashboard-crypto.html" data-i18n="nav.dash.crypto">Crypto</a>
            </li>
            <li class="active"><a class="menu-item" href="dashboard-sales.html" data-i18n="nav.dash.sales">Sales</a>
            </li>
          </ul>

        </li>

      </ul>
    </div>
  </div>
