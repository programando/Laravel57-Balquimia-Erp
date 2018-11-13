  <li class="dropdown dropdown-user nav-item">
             <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                <span class="mr-1">Hola,
                  <span class="user-name text-bold-700"> {{ $nom_user }} </span>
                </span>
                <span class="avatar avatar-online">
                  <img src="{{ $avatar }}" alt="avatar"><i></i></span>
              </a>

              <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="#"><i class="ft-user"></i> Mis Datos</a>

                <a class="dropdown-item" href="#"><i class="ft-check-square"></i> Tareas</a>

                <div class="dropdown-divider"> </div>
                  <router-link :to="{name:'logout'}" class="dropdown-item"><i class="ft-power"></i>Cerrar Sistema   </router-link>
              </div>
            </li>
 <li>       </li>
