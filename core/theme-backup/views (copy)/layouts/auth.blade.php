@extends('Theme::layouts.master')

@section('main')
  <main id="main" class="main" data-main>
    <div class="authentication-page pt-4">
      @yield('content')
    </div>
  </main>
@endsection

@section('footer', '')
