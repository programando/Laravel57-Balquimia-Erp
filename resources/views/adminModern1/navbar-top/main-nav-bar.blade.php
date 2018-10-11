<nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-dark navbar-shadow">
    <div class="navbar-wrapper">
        @include('adminModern1.navbar-top.title-empresa')

      <div class="navbar-container content">
        <div class="collapse navbar-collapse" id="navbar-mobile">

          <ul class="nav navbar-nav mr-auto float-left">
          @include('adminModern1/navbar-top/icon-maximizar')
          <!--  @include('adminModern1/navbar-top/menu-mega') -->
          <!--  @include('adminModern1/navbar-top/busqueda') -->
          </ul>

          <ul class="nav navbar-nav float-right">
                @include('adminModern1/navbar-top/user-info')
                 <!-- @include('adminModern1/navbar-top/flags') -->
                @include('adminModern1/navbar-top/notifications')
                @include('adminModern1/navbar-top/email')
          </ul>
        </div>
      </div>
    </div>
  </nav>
