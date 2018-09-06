@extends('Theme::layouts.auth')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="p-card">
          <h3 class="p-card__title">{{ $application->site->title }}</h3>
          <p class="p-card__content">Sign in</p>

          <form action="{{ route('login.login') }}" method="POST">
            {{ csrf_field() }}

            <div class="p-form-validation {{ $errors->has('username') ? 'is-error' : '' }}">
              <input
                id="username"
                type="text"
                class="p-form-validation__input"
                name="username"
                placeholder="{{ __('Username or email') }}"
              />
              @if ($errors->has('username'))
                <p class="p-form-validation__message is-error">
                  {{ $errors->first('username') }}
                </p>
              @endif
            </div>

            <input id="password" type="password" name="password" placeholder="{{ __('Password') }}">
            <p><button type="submit" class="p-button--brand">{{ __('Sign in') }}</button></p>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
