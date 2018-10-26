@push('after:css')
  <style>
    :root {
      --bg-primary: {{ get_active_theme()->colors->_primary }};
      --bg-workspace: {{ get_active_theme()->colors->_workspace }};
    };
  </style>
@endpush

@include('Default::partials.head')
