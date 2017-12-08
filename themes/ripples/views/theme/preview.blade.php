@extends("Theme::theme.preview")

@section("theme-css")
    <link rel="stylesheet" href="{{ theme("{$resource->code}/css/style.css", true) }}?random={{ date('Y-m-d_H:i:s') }}">
@endsection

@section("content")
    <h1>Ripples Theme</h1>
    <p class="caption">{{ __('Work in progress, this preview, it is.') }}</p>
    <v-btn class="primary" raised>{{ __('Primary Button') }}</v-btn>
@endsection
