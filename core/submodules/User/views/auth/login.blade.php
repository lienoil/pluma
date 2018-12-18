@extends('Theme::layouts.auth')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-lg-4 col-sm-12 col-login mx-auto">
        <div class="card-login">
          @include('Theme::partials.brand', ['color' => 'text-primary'])
        </div>
        <form class="card card-login" action="{{ route('login.login') }}" method="POST">
          {{ csrf_field() }}
          <div class="card-body p-6">
            <p class="lead mt-1">{{ __("Sign in with your {$application->site->title} account") }}</p>

            @field('input', ['name' => 'username', 'label' => __('Email or username')])

            @field('input', ['type' => 'password', 'name' => 'password', 'label' => __('Password')])

            <div class="form-footer">
              @field('submit', ['label' => __('Sign in'), 'class' => 'btn btn-primary btn-block'])
            </div>

            <div class="form-group mt-2 mb-5">
              @field('checkbox', ['name' => 'remember', 'checked' => true, 'value' => 1, 'label' => __('Remember me')])
            </div>

            <div class="text-left text-muted small">
              <small>{{ __("Don't have account yet?") }} <a href="{{ route('register.show') }}">{{ __('Sign up') }}</a></small>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
