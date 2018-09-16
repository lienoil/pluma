<!-- start search form -->
<form class="form-row" method="GET">
  {{ csrf_field() }}
  <div class="col-auto">
    <div class="input-group mb-0">
      <label for="page-search" class="sr-only">Password</label>
      <input id="page-search" tabindex="0" type="text" name="search" class="form-control" aria-describedby="search" placeholder="{{ __('Search') }}" value="{{ request()->get('search') }}">

      @if (request()->get('search'))
        <div class="input-group-append">
          <a role="button" href="{{ request()->url() }}" class="btn btn-outline-secondary py-1"><i class="fe fe-x"></i></a>
        </div>
      @endif
    </div>
  </div>
  <div class="col">
    <button type="submit" class="btn btn-secondary py-1"><i class="fe fe-search"></i></button>
  </div>
</form>
<!-- end search form -->
