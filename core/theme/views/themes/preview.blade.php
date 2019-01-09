@extends('Theme::layouts.admin')

@section('head:title', __('Theme: ').$resource->name)
@section('page:title', __('Theme: ').$resource->name)

@push('after:css')
  <link rel="stylesheet" href="{{ url('anytheme/'.$resource->code.'/dist/app.min.css') }}">
@endpush

@section('page:content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-3">
        <nav id="navbar-components" class="navbar nav-pills flex-column navbar-{{ $application->theme->variant }} bg-{{ $application->theme->variant }}">
          <a data-name="{{ __('Alerts') }}" href="#alerts-components" class="w-100 nav-link"><i class="mdi mdi-alert">&nbsp;</i>{{ __('Alerts') }}</a>
          <a data-name="{{ __('Badges') }}" href="#badges-components" class="w-100 nav-link"><i class="mdi mdi-flash-circle">&nbsp;</i>{{ __('Badges') }}</a>
          <a data-name="{{ __('Breadcrumb') }}" href="#breadcrumb-components" class="w-100 nav-link"><i class="mdi mdi-leaf">&nbsp;</i>{{ __('Breadcrumb') }}</a>
        </nav>
      </div>
      <div class="col-lg-9">
        <div data-spy="scroll" data-target="#navbar-components" data-offset="0">
          <div id="alerts-components">
            {{--  --}}
          </div>
          <div id="badges-components">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis odio natus repellat accusamus incidunt alias doloremque provident, sit magni laborum, commodi cupiditate dignissimos atque minus aliquid velit ullam nam, totam.
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
