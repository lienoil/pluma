@extends('Theme::layouts.master')

@push('before-main')
  @include('Theme::partials.sidebar')
@endpush

@section('main')
  <div id="workspace" class="workspace page justify-content-start" data-workspace>

    @include('Theme::partials.utilitybar')
    @include('Theme::partials.breadcrumbs')

    <main id="main" class="main page-single flex-column justify-content-start" role="main">
      @stack('before-content')

      @section('content')
        @section('main-title')
          <header class="container-fluid">
            <div class="row">
              <div class="col-lg-12 mb-4">
                <h1 class="page-title">
                  @section('page-title')
                    {{ $application->page->title }}
                  @show
                </h1>
              </div>
            </div>
          </header>
        @show


        @section('main-content')
          @yield('page-content')
        @show

        @yield('main-footer')
      @show

      @stack('after-content')
    </main>

    @include('Theme::partials.endnote')

  </div>
@endsection

@push('after-content')
 {{--  @include('Theme::partials.rightsidebar')
  @include('Theme::partials.dialog') --}}
@endpush

@section('footer', '')
