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
  <div id="VueApp">
      @include('adminModern1/navbar-top/main-nav-bar')
      @include('adminModern1/navbar-left/main-nav-left')
      <div class  ="app-content content" >
        <div class  ="content-wrapper">
          <div class  ="content-header row">
          </div>
          <div class  ="content-body">
           <router-view :key="$route.fullPath" >
              @yield('content')
            </router-view>
          </div>
        </div>
      </div>
   {{-- @include('adminModern1/footer/footer') --}}
    </div>
    @include('adminModern1.files.js')
</body>

</html>
