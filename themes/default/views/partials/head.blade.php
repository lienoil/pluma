@extends("Frontier::partials.header")

@section("theme-css")
    {{-- Essentially the same as Frontier's header file --}}
    <link href="{{ theme('css/style.css') }}?timestamp={{ $application->timestamp }}" rel="stylesheet">
@endsection
