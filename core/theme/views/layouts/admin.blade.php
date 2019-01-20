@extends('Theme::layouts.master')

@push('before:main')
  @include('Theme::partials.sidebar')
@endpush

@section('main')
  @section('workspace')
    <div id="workspace" class="workspace justify-content-start">

      @include('Theme::partials.utilitybar')

      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            @include('Theme::partials.breadcrumbs')
          </div>
        </div>
      </div>

      <main id="main" class="main justify-content-start {{ settings('display.main.grid.class', false) ? 'container' : null }}" role="main">
        <div class="container">
          <div class="row">
            <div class="col-12">
              @stack('before:content')

              @section('content')
                @section('main:title')
                  <div data-sticky="#page-header"></div>
                  <nav id="page-header" data-sticky-class="sticky bg-workspace sticky-shadow" class="navbar px-3 mb-4">
                    @section('page:header')
                      <h1 class="page-title">
                        @yield('page:back')
                        @section('page:title')
                          {{ __($application->page->title) }}
                        @show
                      </h1>
                    @show
                  </nav>
                @show

                @section('main:content')
                  @yield('page:content')
                @show

                @yield('main:footer')
              @show

              @stack('after:content')
            </div>
          </div>
        </div>
      </main>

      @include('Theme::partials.snackbar')
      @include('Theme::partials.endnote')

    </div>
  @show
@endsection

@section('footer', '')
