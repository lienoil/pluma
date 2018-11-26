@foreach ($items as $i => $menu)
  <li data-dragdrop-item data-dragdrop-key="{{ $menu->{$code} }}" class="dragdrop-item p-1">
    <div class="card border mb-0">
      <div data-dragdrop-handle class="card-header dragdrop-handle d-flex justify-content-between">
        <h1 class="card-title mb-0">
          <i class="mdi mdi-drag"></i>
          <span>{{ __($menu->title) }}</span>
        </h1>
        <div>
          <button type="button" data-toggle="collapse" data-target="#accordion-item-{{ $i }}" class="btn btn-secondary btn-sm"><i class="mdi mdi-chevron-down"></i></button>
          <div class="dropdown">
            <button type="button" class="btn btn-secondary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="mdi mdi-close"></i></button>
            <div class="dropdown-menu dropdown-menu-right">
              <div class="card border-0 bg-transparent w-100 mb-0" style="width:250px!important;">
                <div class="card-body">
                  <p>{{ __('Are you sure you want to remove this card?') }}</p>
                  <button data-dragdrop-item-remove type="button" class="btn btn-secondary btn-sm">{{ __('Yes, Remove') }}</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div id="accordion-item-{{ $i }}" data-dragdrop-body class="card-body collapse">
        <div class="row">
          <div class="col-lg-12">
            @field('input', ['class' => 'form-control-sm', 'label' => __('Title'), 'value' => $menu->{$title}, 'name' => "menus[".$menu->{$code}."][title]"])

            @field('input', ['attr' => 'data-dragdrop-parent='.$menu->{$code}, 'type' => 'hidden', 'label' => false, 'value' => $menu->{$code}, 'name' => "menus[".$menu->{$code}."][code]"])

            <input data-dragdrop-sort type="hidden" name="menus[{{ $menu->{$code} }}][sort]" value="{{ $i }}">
            <input data-dragdrop-parent type="hidden" name="menus[{{ $menu->{$code} }}][parent]" value="{{ $parent ?? null }}">
          </div>
          <div class="col-lg-12">
            @field('input', ['class' => 'form-control-sm', 'label' => __('URL'), 'value' => $menu->{$url}, 'name' => "menus[".$menu->{$code}."][url]"])
          </div>
        </div>
      </div>
    </div>

    {{-- Children --}}
    {{-- <div class="p-1">
      <button type="button" class="btn btn-secondary btn-sm"><i class="mdi mdi-chevron-down"></i></button>
    </div> --}}
    <ol data-dragdrop-children class="dragdrop pl-4 border mt-2 rounded" style="min-height:2rem;">
      @if (isset($menu->has_children) && $menu->has_children)
        @field('dragdrop-item', [
          'items' => $menu->children,
          'title' => $title,
          'url' => $url,
          'parent' => $menu->{$code},
          'code' => $code ?? 'code',
          'options' => $options ?? null
        ])
      @endif
    </ol>
  </li>
@endforeach
