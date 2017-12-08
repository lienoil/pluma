@extends("Frontier::partials.header")

@section("theme-css")
    <link href="{{ theme('css/style.css') }}?v={{ $application->version }}" rel="stylesheet">
@endsection
