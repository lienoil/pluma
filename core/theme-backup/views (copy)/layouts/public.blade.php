@extends('Theme::layouts.master')

@section('app')
  <div data-app>
    @section('before:main')
      @include('Theme::partials.navigationbar')
    @show

    @section('main')
      <main id="main" data-main class="main">
        @stack('before:root')

        @section('root')
          <div class="page justify-content-start">
            @yield('content')
          </div>
        @show

        @stack('after:root')
      </main>
    @show

    @stack('after:main')
  </div>
@endsection
