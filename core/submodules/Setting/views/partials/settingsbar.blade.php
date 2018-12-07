<div class="sidebar-static">
  <div class="sidebar-nav">
    @foreach ($items ?? get_sidebar()->children ?? [] as $menu)
      <a href="{{ $menu->url ?? "?code={$menu->code}" }}" class="sidebar-item px-0 {{ $menu->active ? 'active' : null }}">
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

