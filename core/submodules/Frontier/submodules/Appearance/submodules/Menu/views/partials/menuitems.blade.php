@foreach ($menus as $menu)
  <div {{ ($disabled ?? false) ? null : 'role=button' }} class="card mb-3">
    <div class="card-body border-0">
      <div class="d-flex justify-content-between">
        {{ $menu->title }}
        @if (! ($disabled ?? false))
          <button type="button" class="btn btn-secondary btn-sm"><i class="fe fe-x"></i></button>
        @endif
      </div>
      <span class="text-muted">/{{ $menu->slug }}</span>
    </div>
  </div>
  @if ($menu->has_children)
    <div class="pl-6 bg-workspace">
      @include('Menu::partials.menuitems', ['menus' => $menu->children])
    </div>
  @endif
@endforeach
