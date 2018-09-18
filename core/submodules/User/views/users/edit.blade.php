@extends('Theme::layouts.admin')

@section('head-title', $resource->fullname)

@section('page-title', $resource->fullname)

@section('page-content')
  <div class="container-fluid">
    <div class="row">

      @section('user.sidebar')
        <div class="col-lg-2 col-md-3 col-sm-5">
          @section('user.avatar')
            <div class="card bg-light" data-avatar>
              <div class="card-body p-1 border-0 text-center">
                <button class="btn btn-sm btn-light pull-right" data-avatar-close data-target="[data-avatar-img]"><i class="fe fe-x"></i></button>
                <div class="p-4">
                  <img data-avatar-img class="rounded-circle" width="100%" height="auto" src="{{ $resource->photo }}" alt="{{ $resource->alt }}">
                </div>

                {{-- <form action="" class="mt-4">
                  <button type="submit" class="btn btn-secondary btn-block">
                    <i class="fe fe-upload"></i>
                    {{ __('Upload') }}
                  </button>
                </form> --}}
              </div>
            </div>
            {{-- <div class="card p-1">
              <img src="{{ $resource->photo }}" width="100%" height="auto" class="rounded">
            </div> --}}
          @show
        </div>
      @show

      @section('user.main')
        <div class="col-lg-10 col-md-9 col-sm-7">
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
