<div data-dragdrop data-dragdrop-options="{{ json_encode($options ?? '{}') }}">
  @foreach ($items as $i => $menu)
    {{-- {{ dd($menu) }} --}}
    <div data-dragdrop-item class="my-3">
      <div class="card shadow-sm card-sm mb-0">
        <div data-dragdrop-handle class="card-header dragdrop-handle">
          <i class="mdi mdi-drag"></i>
        </div>
        <div class="card-body collapsed">
          <div class="row">
            <div class="col">
              @field('input', ['class' => 'form-control-sm', 'label' => __('Title'), 'value' => $menu->title, 'name' => "menus[$i][title]"])
            </div>
            <div class="col">
              @field('input', ['class' => 'form-control-sm', 'label' => __('URL'), 'value' => $menu->url, 'name' => "menus[$i][url]"])
            </div>
            <div class="col-auto mt-auto">
              <div class="dropdown mb-3">
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

        </div>
      </div>

      <div class="pl-6 p-2 border bg-white" style="min-height:120px;">
        @if ($menu->has_children)
          @field('dragdrop', ['items' => $menu->children, 'options' => $options ?? null])
        @endif
      </div>
    </div>

  @endforeach
</div>
