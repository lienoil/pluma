<div id="{{ $resource->code }}" class="card card-theme justify-content-between d-flex mb-3">
  @if ($resource->active)
    <div class="card-status bg-accent"></div>
  @endif

  @isset ($resource->preview->hintpath)
    @include($resource->preview->hintpath, ['theme' => $resource, 'item' => $resource])
  @else

    <img src="{{ $resource->thumbnail }}" class="card-theme-thumbnail">
    <div class="card-body text-light bg-overlay text-light m-3 rounded">
      <div class="mb-5">
        <h5 class="card-title">{{ $resource->name }}</h5>
        <p class="card-text">{{ $resource->description }}</p>
      </div>
      <div class="card-text">
        @isset ($resource->author->name)
          <div class="theme-author small">
            {{ __('Theme by') }}
            {{ $resource->author->name }}
          </div>
        @endisset

        @isset ($resource->preview->url)
          <a href="{{ $resource->preview->url }}" target="_blank" class="text-light small">{{ $resource->preview->credit }}</a>
        @else
          <span class="small">{{ $resource->preview->credit }}</span>
        @endisset
      </div>
    </div>

  @endisset

  <div class="card-footer {{ isset($resource->preview->hintpath) ?: 'bg-light' }} border-0">
    <div class="row">

      <div class="col d-flex justify-content-start">
        <div>
          <span title="{{ __('Primary') }}" class="mx-1 colorinput-color colorinput-sm rounded-circle" style="vertical-align:middle;background-color:{{ $resource->colors->primary }}"></span>
          <span title="{{ __('Accent') }}" class="mx-1 colorinput-color colorinput-sm rounded-circle" style="vertical-align:middle;background-color:{{ $resource->colors->accent }}"></span>
          <span title="{{ __('Secondary') }}" class="mx-1 colorinput-color colorinput-sm rounded-circle" style="vertical-align:middle;background-color:{{ $resource->colors->secondary }}"></span>
        </div>
      </div>
      <div class="col">
        <div class="card-action d-flex justify-content-end">
          @if ($resource->active)
            <button type="button" disabled class="btn btn-link btn-sm active">{{ __('Currently Active') }}</button>
          @else
            <form action="{{ route('settings.store') }}" method="POST">
              @csrf
              <input type="hidden" name="active_theme" value="{{ $resource->code }}">
              <button type="submit" class="btn btn-primary btn-sm">{{ __('Activate') }}</button>
            </form>
          @endif
          <a role="button" href="{{ route('documentations.themes', $resource->code) }}#top" class="btn btn-link btn-sm"><i class="mdi mdi-image-search">&nbsp;</i>{{ __('Details...') }}</a>
        </div>
      </div>

    </div>
  </div>
</div>
