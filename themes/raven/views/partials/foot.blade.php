@section('js')
  <script src="{{ theme('default/dist/vendor.min.js', true) }}"></script>
  <script src="{{ theme('default/dist/app.min.js', true) }}"></script>
  {{-- TODO: remove these --}}
  <script src="{{ theme('raven/dist/vendor.min.js', true) }}"></script>
  <script src="{{ theme('raven/dist/app.min.js', true) }}"></script>
@endsection

@include('Default::partials.foot')
