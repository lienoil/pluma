@extends("Theme::app")

@push('before-content')
  @include("Theme::partials.sidebar")
  @include("Theme::partials.utilitybar")
  @include("Theme::partials.breadcrumbs")
@endpush
