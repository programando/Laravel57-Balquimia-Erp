      <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
          <li class="nav-item mobile-menu d-md-none mr-auto">
              <i class="ft-menu font-large-1"></i>
          </li>
          <li class="nav-item mr-auto">
            <a class="navbar-brand">
              <img class="brand-logo" alt="Logo" src="{{ Folders::ImagesApp().'/matraz.jpg' }}">
              <h3 class="brand-text">{{  config('_app.APP_NAME') }}</h3>
          </a>
          </li>
          <li class="nav-item d-none d-md-block float-right">
            <a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse">
          <i class="toggle-icon ft-toggle-right font-medium-3 white" data-ticon="ft-toggle-right"></i></a></li>
          <li class="nav-item d-md-none">
            <a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i class="la la-ellipsis-v"></i></a>
          </li>
        </ul>
      </div>
