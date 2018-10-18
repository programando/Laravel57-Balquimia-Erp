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
        <div class="col-md-6 CentrarCol">
          <div class="alert alert-success alert-dismissible">
            <h4><i class="icon fa fa-check"></i> {{ trans('_app.pass_remember_title_msg_ok') }}</h4>
            <p class="text-justify">{!! trans('_app.pass_remember_text_ok',['email'=>$email]) !!}</p>
          </div>
          <a  class ="btn btn-success pull-right" href="{{ route('login') }}"> {{ trans('_app.btn_go_to_home') }}</a>
        </div>
      </div>
    </div>
  @include('adminModern1.files.js')
</body>
</html>


