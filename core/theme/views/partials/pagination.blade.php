@if ($resources->lastPage() > 1)
  <ul class="pagination m-0 justify-content-end">
    {{-- First Item Button --}}
    @if ($resources->currentPage() == 1)
      <li class="page-item disabled">
        <span class="page-link" aria-label="{{ __('First') }}">
          <span aria-hidden="true">&laquo;</span>
          <span class="sr-only">{{ __('First') }}</span>
        </span>
      </li>
    @else
      <li class="page-item">
        <a class="page-link" href="{{ $resources->url(1) }}{{ $section ?? '' }}" tabindex="-1" aria-label="{{ __('First') }}">
          <span aria-hidden="true">&laquo;</span>
          <span class="sr-only">{{ __('First') }}</span>
        </a>
      </li>
    @endif
    {{-- First Item Button --}}

    {{-- Previous Button --}}
    @if ($resources->currentPage() == 1)
      <li class="page-item disabled">
        <span class="page-link" aria-label="{{ __('Previous') }}">
          <span aria-hidden="true">&lsaquo;</span>
          <span class="sr-only">{{ __('Previous') }}</span>
        </span>
      </li>
    @else
      <li class="page-item">
        <a class="page-link" href="{{ $resources->url($resources->currentPage() - 1) }}{{ $section ?? '' }}" aria-label="{{ __('Previous') }}">
          <span aria-hidden="true">&lsaquo;</span>
          <span class="sr-only">{{ __('Previous') }}</span>
        </a>
      </li>
    @endif
    {{-- Previous Button --}}

    {{-- Page Loop --}}
    @for ($i = 1; $i <= $resources->lastPage(); $i++)
      <li class="page-item {{ $resources->currentPage() == $i ? 'active' : '' }}">
        <a class="page-link" href="{{ $resources->url($i) }}{{ $section ?? '' }}">
          {{ $i }}
          @if ($resources->currentPage() == $i)
            <span class="sr-only">({{ __('current') }})</span>
          @endif
        </a>
      </li>
    @endfor
    {{-- Page Loop --}}

    {{-- Next Button --}}
    @if ($resources->currentPage() == $resources->lastPage())
      <li class="page-item disabled">
        <span class="page-link" aria-label="{{ __('Next') }}">
          <span aria-hidden="true">&rsaquo;</span>
          <span class="sr-only">{{ __('Next') }}</span>
        </span>
      </li>
    @else
      <li class="page-item">
        <a class="page-link" href="{{ $resources->url($resources->currentPage() + 1) }}{{ $section ?? '' }}" aria-label="{{ __('Next') }}">
          <span aria-hidden="true">&rsaquo;</span>
          <span class="sr-only">{{ __('Next') }}</span>
        </a>
      </li>
    @endif
    {{-- Next Button --}}

    {{-- Last Item Button --}}
    @if ($resources->currentPage() == $resources->lastPage())
      <li class="page-item disabled">
        <span class="page-link" aria-label="{{ __('Last') }}">
          <span aria-hidden="true">&raquo;</span>
          <span class="sr-only">{{ __('Last') }}</span>
        </span>
      </li>
    @else
      <li class="page-item">
        <a class="page-link" href="{{ $resources->url($resources->lastPage()) }}{{ $section ?? '' }}" aria-label="{{ __('Last') }}">
          <span aria-hidden="true">&raquo;</span>
          <span class="sr-only">{{ __('Last') }}</span>
        </a>
      </li>
    @endif
    {{-- Last Item Button --}}
@endif
