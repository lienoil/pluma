@extends('Theme::layouts.admin')

@section('head:title', __('System Information'))
@section('page:title', __('System Information'))

@section('page:content')
  <div class="container">
    <div class="row">
      <div class="col-lg">
        <p class="lead text-muted">{{ __('Listed here are the system specific informations of your application.') }}</p>
        <p class="text-muted">{{ __('Some are configurable while others are either read-only or editable only on the server.') }}</p>

        @include('Theme::partials.debug')

        <p class="form-label">{{ __('Application Details') }}</p>
        @card('appinfo')

        <p class="form-label">{{ __('Theme') }}</p>
        @card('theme')
      </div>
    </div>

    <div class="row">
      <div class="col-lg-12">
        <p class="form-label">{{ __('Currently signed in as') }}</p>
        @card('profile')
      </div>
    </div>

    <div class="row">
      <div class="col-lg-12">
        <p class="form-label">{{ __('Server Information') }}</p>
        <div class="card">
          <div class="card-header">
            <div class="card-title">{{ __('System Setup') }}</div>
          </div>
          <div class="table-responsive">
            <table class="table table-borderless table-sm card-table table-striped">
              <tbody>
                @foreach ([
                  __('Server Software') => $_SERVER['SERVER_SOFTWARE'] ?? __('Not available'),
                  __('Server Protocol') => $_SERVER['SERVER_PROTOCOL'] ?? __('Not available'),
                  __('Server Name') => $_SERVER['SERVER_NAME'] ?? __('Not available'),
                  __('Server Port') => $_SERVER['SERVER_PORT'] ?? __('Not available'),
                  __('Timezone') => config('timezone.default'),
                  __('Database Connection') => config('database.default', __('Not available')),
                ] as $name => $text)
                  <tr>
                    <td><strong>{{ $name }}</strong></td>
                    <td>{{ $text }}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
