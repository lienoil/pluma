@extends('Theme::layouts.admin')

@section('head-title', $resource->fullname)

@section('main-title')
  <header class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <a role="button" href="{{ route('users.index') }}" class="btn btn-secondary btn-sm"><i class="fe fe-arrow-left"></i> {{ __('Back') }}</a>
      </div>
    </div>
  </header>
@endsection

@section('page-content')
  <div class="container-fluid mt-6">

    <div class="row">

      @section('user.sidebar')
        <div class="col-lg-3 col-md-3 col-sm-5">
          @section('user.avatar')
            <div class="card bg-light" data-avatar>
              <div class="card-body p-1 border-0 text-center">
                <div class="p-4">
                  <img data-avatar-img class="rounded-circle" width="100%" height="auto" src="{{ $resource->photo }}" alt="{{ $resource->alt }}">
                </div>
              </div>
            </div>
          @show

          @section('user.sidemenu')
          @show
        </div>
      @show

      @section('user.main')
        <div class="col-lg-9 col-md-9 col-sm-7">
          <div class="card mb-3">
            <div class="card-body">
              <h1 class="display-6">{{ $resource->fullname }}</h1>
              <div>
                @if ($resource->email)
                  <div class="mb-1">
                    <i class="fe fe-mail"></i>
                    <span>{{ $resource->email }}</span>
                  </div>
                @endif
                @if ($resource->displayrole)
                  <div class="mb-1">
                    <i class="fe fe-user"></i>
                    <span>{{ $resource->displayrole }}</span>
                  </div>
                @endif
              </div>

              <div class="mt-6">
                <h3 class="h4">{{ __('About') }}</h3>
              </div>
              <div class="row">
                <div class="col">{{ __('Phone') }}</div>
                <div class="col-auto">{{ $resource->detail('phone') }}</div>
              </div>
              <div class="row">
                <div class="col">{{ __('Address') }}</div>
                <div class="col-auto">{{ $resource->detail('address') }}</div>
              </div>

              {{-- @section('user.activity')
                <div class="mt-6">
                  <h3 class="h3">{{ __('Activity') }}</h3>
                </div>
              @show --}}
            </div>
          </div>

          @section('user.activity')
            <div class="card mb-3">
              <div class="card-body">
                <h3 class="h4">{{ __('Activity') }}</h3>
              </div>
            </div>
          @show
        </div>
      @show

    </div>
  </div>
@endsection
