@stack('before-empty')

@section('empty')
  <section class="text-center justify-center">
    <h4 class="display-4 text-muted">{{ __('No resource found') }}</h4>
  </section>
@show

@stack('after-empty')
