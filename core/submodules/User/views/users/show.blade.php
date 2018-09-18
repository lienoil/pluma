@extends('Theme::layouts.admin')

@section('head-title', $resource->fullname)

@section('main-title')
  <header class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <a title="{{ __('Return to all users') }}" role="button" href="{{ route('users.index') }}" class="btn btn-secondary btn-sm"><i class="fe fe-arrow-left"></i> {{ __('Back') }}</a>
        <a role="button" href="{{ route('users.edit', $resource->id) }}" class="btn btn-secondary btn-sm"><i class="fe fe-edit-2"></i> {{ __('Edit') }}</a>
        <a role="button" href="{{ route('users.edit', $resource->id) }}" class="btn btn-secondary btn-sm"><i class="fe fe-edit-2"></i> {{ __('Deactivate') }}</a>
      </div>
    </div>
  </header>
@endsection

@section('page-content')
  <div class="container-fluid mt-6">

    <div class="row">

      @section('user.sidebar')
        <div class="col-auto">
          @section('user.avatar')
            <div class="card bg-light shadow-none mb-3" data-avatar>
              <div class="card-body p-1 border-0 text-center">
                <div class="p-4">
                  <img data-avatar-img class="rounded-circle" width="180px" height="auto" src="{{ $resource->photo }}" alt="{{ $resource->alt }}">
                </div>
              </div>
            </div>
          @show

          @section('user.sidemenu')
          @show
        </div>
      @show

      @section('user.main')
        <div class="col col-sm-7">
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

          @section('user.about')
            <div class="mt-6">
              <h3 class="h4">{{ __('About') }}</h3>
            </div>
            @foreach ($resource->info as $detail)
              <div class="row mb-1">
                <div class="col-auto"><i class="{{ $detail->icon }}"></i></div>
                <div class="col-auto">{{ __($detail->keyword) }}</div>
                <div class="col"><em>{{ $detail->value }}</em></div>
              </div>
            @endforeach
          @show

          @section('user.activity')
            <div class="mt-6">
              <h3 class="h4">{{ __('Activity') }}</h3>
            </div>
          @show
        </div>
      @show

    </div>
  </div>
@endsection
