@extends("Theme::app")

@push("before-content")
  @include("Theme::partials.sidebar")
  @include("Theme::partials.utilitybar")
@endpush

@push("before-inner-content")
  @include("Theme::partials.breadcrumbs")
@endpush

@push("after-content")
  @include("Theme::partials.footer")
@endpush
