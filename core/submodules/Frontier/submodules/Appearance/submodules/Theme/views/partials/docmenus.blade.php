<div class="sidebar-static">
  <div id="sidebar-search" data-toggle="search" class="sidebar-nav nav-pills">
    <input data-searchbar type="text" class="search form-control mb-3" placeholder="{{ __('Search components...') }}">
    <div class="list">
      @foreach ($docs as $name => $menu)
        <a data-name="{{ __($name) }}" href="{{ route('documentations.show', [$resource->code, $name]) }}#top" class="sidebar-item nav-link name {{ request()->component === $name ? 'active' : null }}">{{ __($name) }}</a>
      @endforeach
    </div>
  </div>
</div>
