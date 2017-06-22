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
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700" type="text/css">
    <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
    @stack("css")
    @stack("post-css")
</head>
<body>
