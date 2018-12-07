@extends('Theme::layouts.blank')

@section('head:title', '404 Page Not Found')

@section('page:content')
  <div class="page">
    <div class="page-content">
      <div class="container text-left">
        <h1 class="display-1 page-title-primary mb-3">{{ __('Oops!') }}</h1>
        <p class="h4 text-muted font-weight-normal">{{ __($error['description']) }}</p>
        <p class="text-muted">{{ __('Error Code: 404') }}</p>
        <p>{{ __("Here are some helpful links instead:") }}</p>
        <p class="mb-0"><a href="{{ home() }}">{{ __('Home') }}</a></p>
        <p class="mb-0"><a href="{{ route('login.show') }}">{{ __('Sign in') }}</a></p>

        @include('Theme::errors.superadminsonly')
      </div>
    </div>
  </div>
@endsection

