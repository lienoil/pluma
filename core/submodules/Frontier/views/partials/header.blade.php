<!DOCTYPE html>
<html lang="en">
<head>
    @stack("pre-meta")
    @stack("meta")
    <meta charset="UTF-8">
    <title>
        @section("head.title"){{ isset($application) && isset($application->head->title) ? $application->head->title : '' }}@show
        @section("head.subtitle"){{ isset($application) && isset($application->page->subtitle) ? $application->page->subtitle : '' }}@show
    </title>
    <meta name="description" content="{{ @$application->head->description }}">
    @stack("post-meta")

    @stack("pre-css")
    @stack("css")
    @stack("post-css")
</head>
<body>
