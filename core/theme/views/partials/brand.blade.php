@section('brand:logo')
  <div class="d-flex justify-content-start align-items-center mb-3 {{ $color ?? '' }}">
    <div class="brand-logo">{!! logo(core_path('theme/dist/img/logo.svg')) !!}</div>
    <div class="brand-title">{{ $application->site->title }}</div>
  </div>
@show
