@push('after:css')
  <style>
    :root {
      --bg-primary: {{ get_active_theme()->colors->primary }};
      --bg-workspace: {{ get_active_theme()->colors->workspace }};
    };
  </style>
@endpush

@include('Default::partials.head')
