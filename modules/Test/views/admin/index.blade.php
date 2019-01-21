@extends('Theme::layouts.admin')

@section('page:content')

  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-4">

        @field('datepicker', ['name' => 'date'])
        @field('timepicker', ['name' => 'time'])
        @field('daterangepicker', ['name' => 'daterange'])


        <div class="card mb-3">
          <div class="card-header">{{ __('Photo') }}</div>
          <div class="card-body text-center">
            @field('uploadavatar', ['name' => 'avatar'])
          </div>
        </div>

        <div class="card" data-avatar>
          <div class="card-header d-flex justify-content-between">
            {{ __('Photo') }}
            <a role="button"><i class="mdi mdi-chevron-down"></i></a>
          </div>
          <div class="card-body text-center">
            @field('selectavatars', ['title' => __('Select avatar'), 'label' => false, 'name' => 'avatar', 'attr' => 'data-selectpicker data-live-search=true'])
            {{-- <small class="text-muted">{{ __('or upload image') }}</small>
            @field('uploadavatar', ['name' => 'avatar']) --}}
          </div>
          <div class="card-footer text-right">
            <button data-avatar-preview-remove class="btn btn-link btn-sm">{{ __('Remove') }}</button>
            <button data-hotkey="ctrl+u" class="btn btn-secondary btn-sm">
              {{ __('Upload...') }}
              @if (settings('show_shortcut_keys', true))
                <code>ctrl+u</code>
              @endif
            </button>
          </div>
        </div>

      </div>
    </div>
  </div>

@endsection
