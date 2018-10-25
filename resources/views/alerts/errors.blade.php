
@if(Session::has('error'))
  <div class="alert  alert-dismissible fade show bg-red bg-accent-4 " role="alert">
          {!! Session::get('error') !!}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">×</span>
          </button>
  </div>
@endif

