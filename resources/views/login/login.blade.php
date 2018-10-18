<!DOCTYPE html>
<html class ="loading" lang="es" data-textdirection="ltr">
<head>
  @include('adminModern1.files.metas')
  @include('adminModern1.files.title')
  @include('adminModern1.files.favicon')
  @include('adminModern1.files.fonts-awesome')
  @include('adminModern1.files.css')
</head>

<body class="vertical-layout vertical-menu-modern 1-column   menu-expanded blank-page" data-open="click" data-menu="vertical-menu-modern" data-col="1-column">
  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-body" >
        <section class="flexbox-container">
          <div class="col-12 d-flex align-items-center justify-content-center">
            <div class="card-group">

                <div class="card text-white bg-info text-center" style="width:  400px;">
                  <div class="card-content">
                    <div class="card-body">
                      <h4 class="card-title"> <h1 class="text-white"><strong>{{ $APP_NAME }}</strong></h1> <br> <br><br></h4>
                        <blockquote >
                          <div class="row">
                            <div class="col-xs-8">
                              <div class="frase text-justify">
                                <p> {{ $Frase }}</p>
                              </div>
                              <small class="frase font-bold pull-right"><b>{{ $Autor }}</b></small>
                            </div>
                            <div class="col-xs-4"></div>
                          </div>
                        </blockquote>
                    </div>
                  </div>
                </div>

                <div class="card"  style="width:  450px;">
                  <div class="card-content">
                    <div class="card-body">
                      <h4 class="card-title"> <h1 class="text-black"><strong>Login</strong></h1> <br>  </h4>
                      <form class="form-horizontal form-simple" action="{{ route('login') }}" novalidate method="POST">
                          @csrf <!-- la anterior reemplaza a esta csrf_field() -->
                        <fieldset class="form-group position-relative has-icon-left mb-0 {{ $errors->has('email') ? "error" : '' }}" >
                          <input type="text"
                                  class="form-control form-control-lg input-lg"
                                  id="email"
                                  name="email"
                                  placeholder="Correo electrónico"
                                  value       ="{{ old('email') }}"  >
                          <div class="form-control-position"> <i class="ft-user"></i> </div>
                          {!! $errors->first('email', '<div class="invalid-data"> <i class="ft-x-square"></i>&nbsp;:message</div>')  !!}
                        </fieldset>
                         <br>
                        <fieldset class="form-group position-relative has-icon-left {{ $errors->has('password') ? "error" : '' }}">
                          <input type="password"
                                  class="form-control form-control-lg input-lg"
                                  id="password"
                                  name="password"
                                  placeholder="Password o Contraseña" >
                          <div class="form-control-position"> <i class="la la-key"></i> </div>
                          {!! $errors->first('password', '<div class="invalid-data"> <i class="ft-x-square"></i>&nbsp;:message</div>')  !!}
                        </fieldset>
                        <div class="form-group row">
                          <div class="col-md-6 col-12 text-center text-md-left">
                            <fieldset>
                              <input type="checkbox" id="remember_me" name="remember_me" class="chk-remember">
                              <label for="remember-me"> No cerrar sesión</label>
                            </fieldset>
                          </div>
                          <div class="col-md-6 col-12 text-center text-md-right">
                           <small> <a href="{{ route( 'password.reset.show.form' )}}"
                            class="card-link">No tengo contraseña / olvidé la que tenía. Quiero asignar una para ingreso al sistema.
                           </a></small>
                         </div>
                        </div>
                        <button type="submit" class="btn btn-info btn-lg"><i class="ft-unlock"></i> Ingresar al sistema</button>
                      </form>
                    </div>
                  </div>
                </div>

            </div>
          </div>
        </section>
      </div>
    </div>
  </div>


  @include('adminModern1.files.js')
</body>

</html>
