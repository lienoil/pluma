@section('brand:logo')
  <div class="brand-logo mb-3 {{ $color ?? '' }}">
    {!! logo(core_path('theme/dist/img/logo.svg')) !!}
    {{-- <img src="{!! theme('/dist/img/logo.png') !!}" alt="{{ @$application->site->title }}"> --}}
  </div>
@show
