@section('js')
  <script src="{{ theme('default/dist/vendor.min.js', true) }}"></script>
  <script src="{{ theme('default/dist/app.min.js', true) }}"></script>

  {{-- TODO: remove these --}}
  {{-- <script src="{{ theme('dist/vendor.min.js', true) }}"></script> --}}
  <script src="{{ theme('dist/app.min.js') }}"></script>
@endsection

@include('Default::partials.foot')
