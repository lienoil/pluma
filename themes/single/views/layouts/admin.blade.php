@extends("Theme::app")

@push("before-content")
  @include("Theme::partials.sidebar")
  @include("Theme::partials.utilitybar")
@endpush

@push("before-inner-content")
  @include("Theme::partials.breadcrumbs")
@endpush

@push("after-inner-content")
  @include("Theme::partials.rightsidebar")
@endpush

@push("after-content")
  @include("Theme::partials.flash")
  @include("Theme::partials.footer")
@endpush

@push("foot")
  {{-- DELETE THIS --}}
  <script src="{{ assets('course/scorm/scorm.adapter.api-1.2-2004.js') }}"></script>
@endpush
