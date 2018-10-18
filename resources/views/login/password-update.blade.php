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

                <div class="card text-white bg-info text-center" style="width: 450px;">
                  <div class="card-content">
                    <div class="card-body">
                      <h4 class="card-title"> <h1 class="text-white"><strong>{{ $APP_NAME }}</strong></h1> <br></h4>
                      <p>Registre y confirme su contraseña para realizar los cambios en el sistema de información</p>
                      <form class="form-horizontal form-simple" action="{{ route('update-password') }}" novalidate method="POST">
                          @csrf <!-- la anterior reemplaza a esta csrf_field() -->
                          <input type="hidden" name="token" value="{{ $token }}">
                          <input type="hidden" name="email" value="{{ $email }}">

                        <fieldset class="form-group position-relative has-icon-left {{ $errors->has('password') ? "error" : '' }}">
                          <input type="password"
                                  class="form-control form-control-lg input-lg"
                                  id="password"
                                  name="password"
                                  placeholder="Password o Contraseña">
                         <div class="form-control-position"> <i class="la la-key warning"></i> </div>
                          {!! $errors->first('password', '<div class="invalid-data-white text-left "> <i class="ft-x-square "></i>&nbsp;:message</div>')  !!}
                        </fieldset>

                         <fieldset class="form-group position-relative has-icon-left {{ $errors->has('password_confirmation') ? "error" : '' }}">
                          <input    type ="password"
                                  class       ="form-control form-control-lg input-lg"
                                  id          ="password_confirmation"
                                  name        ="password_confirmation"
                                  placeholder ="Confirmar password o contraseña" >
                          <div class="form-control-position">
                            <i class="la la-key warning"></i>
                          </div>
                         {!! $errors->first('password_confirmation', '<div class="invalid-data-white text-left "> <i class="ft-x-square "></i>&nbsp;:message</div>')  !!}
                        </fieldset>

                          <br>
                        <button type="submit" class="btn btn-danger btn-lg"><i class="ft-unlock"></i> Actualizar Contreseña</button>
                      </form>
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


