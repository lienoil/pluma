<!-- start search form -->
<form class="form-row form-inline my-2" method="GET">
  @csrf
  <div class="col">
    @field('input', [
      'label' => false,
      'name' => 'search',
      'group_class' => 'mb-0',
      'attr' => 'data-hotkey=/ tabindex=0 aria-describedby=search',
      'class' => 'w-100',
      'input_class' => 'w-100',
      'placeholder' => __('Search'),
      'value' => request()->get('search'),
    ])
  </div>
  <div class="col-auto col-sm-auto">
    <button type="submit" class="btn btn-secondary"><i class="mdi mdi-magnify"></i></button>
    @if (request()->get('search'))
      <a role="button" href="{{ url()->route(request()->route()->getName(), url_filter(['search' => null])) }}" class="btn btn-secondary">
        @isset($close)
          {!! $close !!}
        @else
          <i class="mdi mdi-close"></i>
        @endisset
      </a>
    @endif
  </div>
</form>
<!-- end search form -->
