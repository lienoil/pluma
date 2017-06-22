<!DOCTYPE html>
<html lang="en">
<head>
    @stack("pre-meta")
    @stack("meta")
    <meta charset="UTF-8">
    <title>
        @section("head.title"){{ isset($application) && isset($application->head->title) ? $application->head->title : '' }}@show
        @section("head.subtitle"){{ $application->head->separator }} {{ isset($application) && isset($application->head->tagline) ? $application->head->tagline : '' }}@show
    </title>
    <meta name="description" content="{{ @$application->head->description }}">
    @stack("post-meta")

    @stack("pre-css")
    @stack("css")
    @stack("post-css")
</head>
<body>

    @yield("content")

    @stack("pre-footer")
    @stack("footer")
    @stack("post-footer")

    @stack("pre-js")
    @stack("js")
    @stack("post-js")
</body>
</html>