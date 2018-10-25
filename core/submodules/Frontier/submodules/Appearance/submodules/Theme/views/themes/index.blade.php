@extends('Theme::layouts.admin')

@section('head:title', __('Themes / Appearance'))
@section('page:title', __('Themes'))

@section('page:content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <div class="card-deck">
          {{-- {{ dd(get_active_theme()) }} --}}
          @foreach ($resources as $resource)
            {{-- {{ dd($resource) }} --}}
            <div class="card text-white">
              <img src="{{ $resource->thumbnail }}" class="card-img">
              <div class="card-img-overlay justify-content-between d-flex">
                <div>
                  <h5 class="card-title">{{ $resource->name }}</h5>
                  <p class="card-text">{{ $resource->description }}</p>
                </div>

                <div class="card-text mb-7">
                  @if ($resource->active)
                    <span class="bg-primary small p-2 rounded">Activated</span>
                  @else
                    <form action="{{ route('settings.store') }}" method="POST">
                      @csrf

                      @field('input', [
                        'label' => false,
                        'name' => 'active_theme',
                        'value' => $resource->code,
                        'type' => 'hidden',
                      ])

                      {{-- @submit('Activate', ['class' => 'btn btn-sm btn-secondary']) --}}
                      <button class="btn btn-secondary btn-sm">{{ __('Activate') }}</button>
                      <a href="{{ route('themes.preview', $resource->code) }}" class="btn btn-secondary btn-sm"><i class="fe fe-search"></i></a>
                    </form>
                  @endif
                </div>

                {{-- <div class="selectgroup selectgroup-pills">
                  <label class="selectgroup-item">
                    <input type="checkbox" name="icon-input" value="1" class="selectgroup-input" checked="">
                    <span class="selectgroup-button selectgroup-button-icon"><i class="fe fe-sun"></i></span>
                  </label>
                </div> --}}

                <div class="card-text d-flex justify-content-between" style="padding:.5rem;position:absolute;right:0;bottom:0;width:100%;">
                  @isset ($resource->preview->url)
                    <a href="{{ $resource->preview->url }}" target="_blank" class="small text-white">{{ $resource->preview->credit }}</a>
                  @else
                    <span class="small text-white">{{ $resource->preview->credit }}</span>
                  @endisset

                  <div>
                    <span title="{{ __('Primary') }}" class="colorinput-color rounded-circle" style="vertical-align:middle;background: {{ $resource->colors->_primary }}"></span>
                    <span title="{{ __('Secondary') }}" class="colorinput-color rounded-circle" style="vertical-align:middle;background: {{ $resource->colors->_secondary }}"></span>
                    <span title="{{ __('Accent') }}" class="colorinput-color rounded-circle" style="vertical-align:middle;background: {{ $resource->colors->_accent }}"></span>
                  </div>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
@endsection
