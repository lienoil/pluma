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
                  <img data-avatar-img class="avatar-fit rounded-circle" width="150px" height="150px" src="{{ $resource->photo }}" alt="{{ $resource->alt }}">
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
            @if ($resource->username)
              <div class="mb-1" title="{{ __('Username') }}">
                <i class="fe fe-at-sign"></i>
                <span>{{ $resource->username }}</span>
              </div>
            @endif
            @if ($resource->email)
              <div class="mb-1" title="{{ __('Email') }}">
                <i class="fe fe-mail"></i>
                <span>{{ $resource->email }}</span>
              </div>
            @endif
            @if ($resource->displayrole)
              <div class="mb-1" title="{{ __('Role group') }}">
                <i class="fe fe-user"></i>
                <span>{{ $resource->displayrole }}</span>
              </div>
            @endif
          </div>

          @section('user.about')
            <div class="mt-6">
              <h3 class="h4">{{ __('About') }}</h3>
            </div>
            @empty($resource->info->toArray())
              <div class="row mb-1">
                <p class="col text-muted"><em>{{ __('No additional information available.') }}</em></p>
              </div>
            @endempty
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
            {{-- {{ activity()->log("Pluma CMS visited Ma. Claycie Torres's user profile. Again.", [user()->id, 'User\Models\User']) }} --}}
            {{-- @can('activities.show') --}}
              <div class="row mb-1">
                @empty ($resource->activities)
                  <p class="col text-muted"><em>{{ __('Either no activity available or this feed is hidden.') }}</em></p>
                @else
                  <div class="col">
                    @include('Theme::partials.timeline', ['activities' => $resource->activities])
                  </div>
                @endempty
              </div>
            {{-- @endcan --}}
          @show
        </div>
      @show

    </div>
  </div>
@endsection
