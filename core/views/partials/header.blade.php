<!DOCTYPE html>
<html lang="en">
<head>
    @stack("pre-meta")
    @stack("meta")
    <meta charset="UTF-8">
    <title>{{ isset($application) && isset($application->title) ? $application->title : '' }}</title>
    @stack("post-meta")

    @stack("pre-css")
    @stack("css")
    @stack("post-css")
</head>
<body>
