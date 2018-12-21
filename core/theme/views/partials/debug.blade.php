@if (config('debugging.debug'))
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ __('You are in debug mode. Set the environment to `production` and debug to `off` if deployed on a live server.') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif
