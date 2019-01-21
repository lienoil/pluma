@extends('Theme::layouts.admin')

@section('page:content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">

        <form action="{{ route('widgets.refresh') }}" method="POST">
          @csrf

          <div class="card">
            <div class="card-header">
              <p class="card-title">{{ __('Refresh Widgets') }}</p>
            </div>
            <div class="card-body">{{ __('Refreshing will update existing or install new widgets from the modules list.') }}</div>
            <div class="card-footer">
              <button type="submit" class="btn btn-secondary btn-block">{{ __('Refresh Widgets') }}</button>
            </div>
          </div>
        </form>

      </div>
      <div class="col-lg-12">
        <div class="row">
          @foreach ($widgets as $widget)
            <div class="col-md-4">
              <div class="card mb-3">
                <div class="card-header">{{ $widget->name }}</div>
                <div class="card-body">{{ $widget->description }}</div>
              </div>
            </div>

            {{-- <a href="{{ route('widgets.edit', $widget->id) }}">
              {{ $widget->icon }}
              <div>{{ $widget->name }}</div>
              <div>{{ $widget->roles->count() }}</div>
            </a> --}}
          @endforeach
        </div>
      </div>
    </div>
  </div>
@endsection
