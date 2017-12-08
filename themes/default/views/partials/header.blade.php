@extends("Frontier::partials.header")

@section("theme-css")
    {{-- Essentially the same as Frontier's header file --}}
    <link href="{{ theme('css/style.css') }}?v={{ $application->version }}" rel="stylesheet">
@endsection
