<!-- BEGIN VENDOR JS-->
<script src="{{asset('js/vendors.min.js')}}"></script>
<!-- BEGIN VENDOR JS-->

<!-- BEGIN PAGE VENDOR JS-->
<script src="{{asset('js/chart.min.js')}}"></script>
<script src="{{asset('js/raphael-min.js')}}"></script>
<script src="{{asset('js/morris.min.js')}}"></script>
<script src="{{asset('js/jquery-jvectormap-2.0.3.min.js')}}"></script>
<script src="{{asset('js/jquery-jvectormap-world-mill.js')}}"></script>
<script src="{{asset('js/visitor-data.js')}}"></script>
<!-- END PAGE VENDOR JS-->

<!-- BEGIN MODERN JS-->
<script src="{{asset('js/core/app-menu.js')}}"></script>
<script src="{{asset('js/core/app.js')}}"></script>
<script src="{{asset('js/customizer.js')}}"></script>
<script src="{{asset('js/icheck.min.js')}}"></script>
<!-- END MODERN JS-->


<!-- <script src="{{asset('js/dashboard-sales.js')}}"></script>-->


<script src="{{ mix('js/Vue-App.js') }}"></script>
<script src="{{asset('js/app-custom.js')}}"></script>

<script>
    //$('input').iCheck({
      //checkboxClass: 'icheckbox_square-blue' ,
    //});

    $('input').iCheck({
    checkboxClass: 'icheckbox_square-blue',
    radioClass: 'icheckbox_square-blue'
    }).on('ifChecked ifUnchecked', function(){
        $(this)[0].dispatchEvent(new Event("change"));
    });
</script>




