<fieldset class="form-group position-relative has-icon-left {{ $errors->has('password') ? "error" : '' }}">
  <input type="password"
          class="form-control form-control-lg input-lg"
          id="password"
          name="password"
          placeholder="Password o Contraseña">
 <div class="form-control-position"> <i class="la la-key warning"></i> </div>
  {!! $errors->first('password', '<div class="invalid-data-white text-left "> <i class="ft-x-square "></i>&nbsp;:message</div>')  !!}
</fieldset>
