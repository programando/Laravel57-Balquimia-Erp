  <li class="dropdown dropdown-user nav-item">

             <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                <span class="mr-1">Hello,
                  <span class="user-name text-bold-700">John Doe</span>
                </span>
                <span class="avatar avatar-online">
                  <img src="{{ FolderImagesUsers() .'/avatar-s-19.png' }}" alt="avatar"><i></i></span>
              </a>

              <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="#"><i class="ft-user"></i> Mis Datos</a>

                <a class="dropdown-item" href="#"><i class="ft-check-square"></i> Tareas</a>

                <div class="dropdown-divider"></div><a class="dropdown-item" href="{{ route('cerrar-sistema')}}"><i class="ft-power"></i> Cerrar Sistema</a>
              </div>
            </li>
