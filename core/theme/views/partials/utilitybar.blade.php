@stack('before-utilitybar')

@section('utilitybar')
  <nav class="navbar navbar-expand-lg bg-transparent">
    <button type="button" class="btn btn-secondary shadow-none mr-sm-2 py-1" aria-expanded="true" data-sidebar-toggle data-target="[data-sidebar]" aria-controls="sidebar" aria-label="{{ __('Toggle sidebar') }}">
      <i class="fe fe-menu"></i>
      <span class="sr-only">{{ __('Toggle Sidebar') }}</span>
    </button>

    @section('utilitysearch')
      @include('Theme::partials.search')
    @show
  </nav>
@show

@stack('after-utilitybar')
