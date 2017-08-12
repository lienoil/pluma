@include("Theme::partials.header")

@section("css", "")

@yield("pre-content")
@yield("content")
@yield("post-content")

@include("Theme::partials.footer")
