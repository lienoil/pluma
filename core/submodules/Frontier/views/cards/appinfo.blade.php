<div class="card card-aside mb-3">
  <div class="card-aside-column p-5 text-primary">
    @include('partials.brand')
  </div>
  <div class="card-body d-flex flex-column py-5">
    <div class="mb-1"><strong>{{ __('Name') }}</strong>: {{ $application->site->title }} <span>{{ $application->version }}</span></div>
    <div class="mb-1"><strong>{{ __('Author') }}</strong>: {{ $application->site->author }}</div>
    <div class="mb-1"><strong>{{ __('Copyright') }}</strong>: {!! $application->site->copyright !!}</div>
    <div title="{{ __('It is recommended to toggle the environment to `production` when deploying to a live server.') }}" class="mb-1 {{ app()->environment() === 'development' ? 'text-danger' : null }}"><strong>{{ __('Environment') }}</strong>: {{ app()->environment() }}</div>
    {{-- <div class="mb-1"><strong>{{ __('App Key') }}</strong>: {{ config('encryption.key') }}</div> --}}
  </div>
</div>
