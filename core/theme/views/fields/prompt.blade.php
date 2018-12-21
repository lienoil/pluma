<div class="dropdown">
  <button type="button" class="{{ $class ?? 'btn btn-secondary' }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="{{ $icon ?? 'mdi mdi-close' }}"></i></button>
  @section('prompt:content')
    <div class="dropdown-menu dropdown-menu-right my-2">
      <div class="card border-0 bg-transparent w-100 mb-0" style="width:250px!important;">
        <div class="card-body">
          <p>{{ $text ?? __('Are you sure you want to remove this item?') }}</p>
          <div class="d-flex justify-content-end">
            <button {{ $action['attr'] ?? null }} type="button" class="{{ $action['class'] ?? 'btn btn-secondary btn-sm' }}">{{ $action['label'] ?? __('Yes, Remove') }}</button>
          </div>
        </div>
      </div>
    </div>
  @show
</div>
