<div class="card mb-3">
  <div class="card-body">
    <div class="card-value float-right text-primary">
      <i class="{{ $widget->icon }}"></i>
    </div>
    <h3 class="mb-1">{{ \User\Models\User::count() }}</h3>
    <a href="{{ route('users.index') }}" class="text-muted">{{ __('Registered users') }}</a>

    @if (\User\Models\User::onlyTrashed()->count())
      <a href="{{ route('users.trashed') }}" class="small text-muted">{{ \User\Models\User::onlyTrashed()->count() }} {{ __('deactived users') }}</a>
    @endif

    <div class="mt-6 d-flex justify-content-end border-0">
      {{-- <a href="{{ route('users.index') }}" role="button" class="ml-3 btn btn-outline-secondary">{{ __('View All') }}</a> --}}
      <a href="{{ route('users.create') }}" role="button" class="btn ml-3 btn-secondary">{{ __('Add New') }}</a>
    </div>
  </div>
  <div class="card-chart-bg">
    <div id="user-chart" data-toggle="chart" data-type="bar"></div>
  </div>
</div>
