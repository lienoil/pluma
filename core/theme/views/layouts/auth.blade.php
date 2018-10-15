@extends('Theme::layouts.master')

@section('root')
  <div id="app" class="page gradient-primary" data-app>
    @stack('auth:before-content')

    <main class="page-main page-single mt-3" data-main>
      @yield('content')
    </main>

    @stack('auth:after-content')
  </div>
@endsection

@section('footer', '')
