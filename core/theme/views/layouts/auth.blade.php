@extends('Theme::layouts.master')

@section('root')
  <div id="app" class="page" data-app>
    <main class="page-main page-single mt-3" data-main>
      @yield('content')
    </main>
  </div>
@endsection

@section('footer', '')
