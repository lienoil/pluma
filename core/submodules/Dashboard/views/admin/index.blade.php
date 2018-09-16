@extends('Theme::layouts.admin')

@section('page-content')
  <div class="container-fluid">
    <div class="row">
      {{-- @include("Theme::widgets.glance", ['widgets' => widgets('dashboard.glance', 'location')]) --}}
    </div>
    <div class="row">
      @foreach (widgets('dashboard.2', 'location') as $widget)
        <div class="col-sm-4">
          @include($widget->view, compact('widget'))
        </div>
      @endforeach
    </div>
  </div>
@endsection
