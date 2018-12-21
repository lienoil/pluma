@extends('Theme::layouts.settings')

@section('head:title', __('System Information'))
@section('page:title', __('System Information'))

@section('main:sidebar')
  <p class="lead text-muted">{{ __('Listed here are the system specific informations of your application.') }}</p>
  <p class="text-muted">{{ __('Some are configurable while others are either read-only or editable only on the server.') }}</p>
@endsection

@section('page:content')
  <div class="row">
    <div class="col-lg">
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
      <p class="form-label">{{ __('Server Setup') }}</p>
      <p><strong>{{ __('Timezone') }}</strong>: <span>{{ config('timezone.default') }}</span></p>
      {{-- <p><strong>{{ __('Timezone') }}</strong>: <span>{{ dd(config()) }}</span></p> --}}
    </div>
  </div>
@endsection
