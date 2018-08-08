@extends("Theme::layouts.master")

@section("pre-content")
  @include("Theme::partials.sidebar")
  @include("Theme::partials.utilitybar")
@endsection

@section("root")
  @yield("content")
@endsection

@section("post-content")
  @include("Theme::partials.rightsidebar")
  @include("Theme::partials.dialog")
@endsection

@section("endnote")
  endnote
@endsection
