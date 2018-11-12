@extends('Theme::layouts.admin')

@section('head:title', __('Theme: ').$resource->name)
@section('page:title', __('Theme: ').$resource->name)

@push('after:css')
  <link rel="stylesheet" href="{{ url('anytheme/'.$resource->code.'/dist/app.min.css') }}">
@endpush

@section('page:content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-6">
        <div class="card bg-transparent border-0 shadow-none">
          <div class="card-header border-0">
            <h3 class="card-title">{{ __('Components') }}</h3>
          </div>
          <div class="card-body border-0">
            <div class="list-group list-group-transparent">
              <a href="#" class="list-group-item">{{ __('Alerts') }}</a>
              <a href="#" class="list-group-item">{{ __('Badge') }}</a>
              <a href="#" class="list-group-item">{{ __('Breadcrumb') }}</a>
              <a href="#" class="list-group-item">{{ __('Buttons') }}</a>
              <a href="#" class="list-group-item">{{ __('Button Group') }}</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
