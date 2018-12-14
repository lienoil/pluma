@extends('Theme::layouts.master')

@push('before:main')
  @include('Theme::partials.sidebar')
@endpush

@section('main')
  @section('workspace')
    <div id="workspace" class="workspace justify-content-start">
      @include('Theme::partials.utilitybar')
      @include('Theme::partials.breadcrumbs')

      <main id="main" class="main justify-content-start {{ settings('display.main.grid.class', false) ? 'container' : null }}" role="main">
        @stack('before:content')

        @section('content')

          @section('main:title')
            <nav id="page-header" class="navbar px-3">
              @section('page:header')
                <h1 class="page-title">
                  @section('page:title')
                    {{ __($application->page->title) }}
                  @show
                </h1>
              @show
            </nav>
          @show

          @section('main:content')
            <div class="container-fluid">
              <div class="row">
                <div class="col-lg-3">
                  @section('main:sidebar')
                    @include('Theme::partials.settingsbar')
                  @show
                </div>
                <div class="col-lg-9">
                  @section('page:content')
                    <form action="{{ route('settings.store') }}" method="POST">
                      @csrf
                      @yield('form:title')
                      @yield('form:content')
                      @yield('form:footer')
                    </form>
                  @show
                </div>
              </div>
            </div>
          @show

          @yield('main:footer')
        @show

        @stack('after:content')
      </main>

      @include('Theme::partials.snackbar')
      @include('Theme::partials.endnote')
    </div>
  @show
@endsection

@section('footer', '')
