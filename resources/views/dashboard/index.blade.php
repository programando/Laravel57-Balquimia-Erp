<!DOCTYPE html>
<html class ="loading" lang="es" data-textdirection="ltr">
<head>
  @include('adminModern1.files.metas')
  @include('adminModern1.files.title')
  @include('adminModern1.files.favicon')
  @include('adminModern1.files.fonts-awesome')
  @include('adminModern1.files.css')
</head>

<body class ="vertical-layout vertical-menu-modern 2-columns   menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
  <!-- fixed-top-->
  @include('adminModern1/navbar-top/main-nav-bar')
  @include('adminModern1/navbar-left/main-nav-left')

  <div class  ="app-content content">
    <div class  ="content-wrapper">
      <div class  ="content-header row">
      </div>
      <div class  ="content-body">
        CONTENIDO
        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
      </div>
    </div>
  </div>

  @include('adminModern1/footer/footer')
  @include('adminModern1.files.js')
</body>

</html>
