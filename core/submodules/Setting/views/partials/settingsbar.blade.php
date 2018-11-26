{{-- <div class="list-group list-group-transparent">
  @foreach (get_sidebar()->children as $menu)
    <a role="panel" href="{{ @$menu->url ?? '?code='.$menu->code }}" class="list-group-item list-group-item-action flex-column align-items-start {{ @$menu->active ? 'active' : null }}">
      <div>
        @isset ($menu->icon)
          <i class="{{ $menu->icon }}"></i>
        @endisset
        @isset ($menu->labels->title)
          <strong>{!! $menu->labels->title !!}</strong>
        @endisset
      </div>
      @isset ($menu->description)
        <p class="small text-truncate">{{ $menu->description }}</p>
      @endisset
    </a>
  @endforeach
</div> --}}

<div class="sidebar-static">
  <div class="sidebar-nav">
    @foreach (get_sidebar()->children as $menu)
      <a href="{{ $menu->url ?? "?code={$menu->code}" }}" class="px-0 sidebar-item {{ url(request()->route()->uri()) === $menu->url ? 'active' : null }} {{ $menu->active ? 'active' : null }}">
        @isset ($menu->icon)
          <i class="{{ $menu->icon }}">&nbsp;</i>
        @endisset

        @isset ($menu->labels->title)
          <span>{!! $menu->labels->title !!}</span>
        @endisset
      </a>
    @endforeach
  </div>
</div>
