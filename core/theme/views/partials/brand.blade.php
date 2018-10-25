@section('brand:logo')
  <div class="brand-logo mb-3 {{ $color ?? '' }}">
    {!! logo(public_path('logo.svg')) !!}
  </div>
@show
