<!-- start search form -->
<form class="form-row" method="GET">
  {{ csrf_field() }}
  <div class="col-auto">
    <div class="form-group mb-0">
      <label for="page-search" class="sr-only">Password</label>
      <input id="page-search" tabindex="0" type="text" name="search" class="form-control" aria-describedby="search" placeholder="{{ __('Search') }}" value="{{ request()->get('search') }}">

    </div>
  </div>
  <div class="col">
    @if (request()->get('search'))
      <a role="button" href="{{ request()->url() }}" class="btn btn-secondary"><i class="fe fe-x"></i></a>
    @endif
    <button type="submit" class="btn btn-secondary"><i class="fe fe-search"></i></button>
  </div>
</form>
<!-- end search form -->
