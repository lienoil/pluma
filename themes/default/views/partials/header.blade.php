@extends("Frontier::partials.header")

@section("theme-css")
    <link href="{{ theme('css/styles.css') }}?v={{ $application->version }}" rel="stylesheet">
@endsection
