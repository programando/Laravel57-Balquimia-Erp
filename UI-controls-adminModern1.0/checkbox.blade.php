
<fieldset>
  <input type="checkbox" id="remember_me" name="remember_me" class="chk-remember">
  <label for="remember-me"> No cerrar sesión</label>
</fieldset>
Notas:
    1.   Cargar los css necesarios (icheck.css, custom.css)
    2.   Cargar el Js necesario  ( icheck.min.js )
    3.   Iniciarlizar el control de la siguiente manera:
         <script type="text/javascript">
            $('input').iCheck({
              checkboxClass: 'icheckbox_square-blue',
            });
        </script>
