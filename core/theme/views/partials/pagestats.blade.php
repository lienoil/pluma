@if ($resources->hasPages())
  <span class="pull-left mt-2 text-muted">{{ __('Showing') }} <strong>{{ ((($resources->currentPage() -1) * $resources->perPage()) + 1) }}</strong> - <strong>{{ ((($resources->currentPage() -1) * $resources->perPage()) + $resources->count()) }}</strong> {{ __('of') }} <strong>{{ $resources->total() }}</strong> {{ __('entries') }}. {{ __('Page') }} <strong>{{ $resources->currentPage() }}</strong> / <strong>{{ $resources->lastPage() }}</strong></span>
@endif
