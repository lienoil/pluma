@extends('Theme::layouts.admin')

@section('head-title', $resource->fullname)

@section('page-title')
  <a title="{{ __('Back') }}" href="{{ route('users.index') }}" role="button" class="btn btn-secondary">
    <i class="fe fe-arrow-left"></i>
    <span class="sr-only">{{ __('Back') }}</span>
  </a>
  <a href="{{ route('users.edit', $resource->id) }}" role="button" class="btn btn-secondary"><i class="fe fe-edit-2"></i> {{ __('Edit') }}</a>
  <a href="{{ route('users.edit', $resource->id) }}" role="button" class="btn btn-secondary"><i class="fe fe-trash-2"></i> {{ __('Deactivate') }}</a>
@endsection

@section('page-content')
  <div class="container-fluid">
    <div class="row">

      @section('user.sidebar')
        <div class="col-lg-3">
          @section('user.avatar')
            <div class="card p-1">
              <img src="{{ $resource->photo }}" width="100%" height="auto" class="rounded">
            </div>
          @show
        </div>
      @show

      @section('user.main')
        <div class="col-lg-9">
          <h1 class="display-6 m-0 p-0">{{ $resource->fullname }}</h1>
          <div class="page-subtitle">
            @if ($resource->email)
              <div class="mb-1">
                <i class="fe fe-mail"></i>
                <span>{{ $resource->email }}</span>
              </div>
            @endif
            @if ($resource->displayrole)
              <div class="mb-1">
                <i class="fe fe-user"></i>
                <strong>{{ $resource->displayrole }}</strong>
              </div>
            @endif
          </div>
          <div class="mt-6">
            <h3 class="h3">{{ __('About') }}</h3>
            {{-- <div class="row">
              <strong class="col-3">{{ __('Address') }}</strong>
              <div class="col">{{ 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatum laudantium distinctio quasi.' }}</div>
            </div>
            <div class="row">
              <strong class="col-3">{{ __('Phone Address') }}</strong>
              <div class="col">{{ '0987654322345' }}</div>
            </div> --}}
            @if ($resource->detail('phone'))
              <div class="col">{{ __('Phone') }}</div>
              <div class="col-auto">{{ $resource->detail('phone') }}</div>
            @endif

            @if ($resource->detail('address'))
              <div class="col">{{ __('Address') }}</div>
              <div class="col-auto">{{ $resource->detail('address') }}</div>
            @endif
          </div>

          @section('user.activity')
            <div class="mt-6">
              <h3 class="h3">{{ __('Activity') }}</h3>
            </div>
          @show
        </div>
      @show

    </div>
  </div>
@endsection
