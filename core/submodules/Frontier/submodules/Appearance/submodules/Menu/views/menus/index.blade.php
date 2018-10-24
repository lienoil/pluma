@extends('Theme::layouts.admin')

@section('head:title', __('Menus'))
@section('page:title', __('Menus'))

@section('page:content')
  <div class="container-fluid">
    <div class="row">

        @foreach ($locations as $menu)
      <div class="col-lg-4 order-lg-1 order-sm-3">
          <div role="panel" class="card border mb-3 flex-column align-items-start {{ @$menu['active'] ? 'active' : null }} {{ request()->get('code') == @$menu['code'] ?? '' ? 'active' : null }}">
            <div class="card-header border-0 justify-content-between">
              <a href="{{ @$menu['url'] ?? '?code='.$menu['code'] }}"><strong>{{ $menu['name'] }}</strong></a>
              @isset ($menu['icon'])
                <i class="{{ $menu['icon'] }}"></i>
              @endisset
            </div>
            @isset ($menu['description'])
              <div class="card-body">
                <p class="small text-truncate">{{ $menu['description'] }}</p>
              </div>
            @endisset
            <div class="card-footer border-0 d-flex justify-content-end">
              <a tole="button" href="{{ route('menus.edit', $menu['code']) }}" class="btn btn-secondary btn-sm">
                <i class="fe fe-edit">&nbsp;</i>
                {{ __('Edit') }}
              </a>
            </div>
          </div>
      </div>
        @endforeach

      {{-- <div class="col-lg-6 order-lg-2 order-sm-1">

        @empty (!$resource)
          <div class="card">
            <div class="card-header justify-content-between border-0">
              <strong>
                @isset ($resource->icon)
                  <i class="{{ $resource->icon }}"></i>
                @endisset
                {{ $resource->name }}
              </strong>
            </div>
            <div class="card-body bg-workspace pt-2">
              <p class="text-muted">{{ $resource->description }}</p>
              <p class="text-muted"><strong>{{ __('Menu Structure') }}</strong></p>

              @empty ($resource->menus)
                <div class="text-center text-muted">
                  <div class="p-4"><i class="mdi mdi-calendar-edit display-4"></i></div>
                  <a tole="button" href="{{ route('menus.edit', $resource->code) }}" class="btn btn-primary btn-lg shadow-sm">
                    <i class="fe fe-edit">&nbsp;</i>
                    {{ __('Edit') }}
                  </a>
                </div>
              @endempty

              @include('Menu::partials.menuitems', [
                'menus' => $resource->menus,
                'disabled' => true,
              ])
            </div>
            <div class="card-footer bg-workspace border-0 text-right">
              <a tole="button" href="{{ route('menus.edit', $resource->code) }}" class="btn btn-secondary">
                <i class="fe fe-edit">&nbsp;</i>
                {{ __('Edit') }}
              </a>
            </div>
          </div>
        @endempty

        @empty ($resource)
          <div class="card bg-transparent border-0 shadow-none">
            <div class="card-body text-muted text-center">
              <i class="mdi mdi-magnify display-4"></i>
              <p>{{ __('Select one of the menus to view details.') }}</p>
            </div>
          </div>
        @endempty

      </div> --}}
    </div>
  </div>
@endsection
