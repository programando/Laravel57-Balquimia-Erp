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
  <div class="container h-100">
    <div class="row h-100 justify-content-center align-items-center">
      <div class="col-sm-8 col-md-7">
        <div class="card text-white bg-info text-center">
          <div class="card-content ">
            <h4 class="card-title "> <h1 class="text-white"> <strong>{{ $APP_NAME }}</strong></h1> </h4>
            @include('alerts.errors')
            <img src="{{ Folders::Images(). "/login/hand-finger-with-a-ribbon.svg" }}"" alt="element 04" width="100"   class="float-left mt-3">
            <div class="card-body pt-3">
              <p class="card-text">
                A través de este proceso enviaremos las indicaciones para que, desde su cuenta de correo electrónico, pueda asignar una nueva contraseña.
              </p>
              <form class="form-horizontal form-simple" action="{{ route('reset-password') }}" novalidate method="POST">
                @csrf <!-- la anterior reemplaza a esta csrf_field() -->
                <fieldset class="form-group position-relative has-icon-left  {{ $errors->has('email') ? "error" : '' }}"">
                  <input
                      class       ="form-control form-control-lg input-lg"
                      id          ="email"
                      name        ='email'
                      placeholder ="Correo electrónico"
                      type        ="text"
                      value       ="{{ old('email') }}"
                  >
                  <div class="form-control-position">
                    <i class="icon-envelope warning font-medium-4"></i>
                  </div>
                  {!! $errors->first('email', '<div class="invalid-data-white text-left "> <i class="ft-x-square "></i>&nbsp;:message</div>')  !!}
                </fieldset>
                <button type="submit" class="btn btn-success btn-darken-3 float-right mt-3">Enviar correo electrónico</button> <br><br>
              </form>
              <br>
              <br>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @include('adminModern1.files.js')
</body>
</html>


