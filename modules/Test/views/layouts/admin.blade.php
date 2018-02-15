@extends("Test::layouts.master")

@section("pre-content")
    @include("Test::partials.sidebar")
    {{-- @include("Test::partials.utilitybar") --}}
    {{-- <sidebar></sidebar> --}}
    <utilitybar></utilitybar>
@endsection

@section("root")
    @yield("content")
@endsection
