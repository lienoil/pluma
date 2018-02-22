<!DOCTYPE html>
<html lang="{{ app()->getLocale() ?? 'en' }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>{{ $application->site->fulltitle }}</title>
  <meta name="description" content="{{ __(@$application->head->description) }}">

  <!-- Add to homescreen for Chrome on Android -->
  <meta name="mobile-web-app-capable" content="yes">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="_token" content="{{ csrf_token() }}">

  <!-- Favicon -->
  <link rel="apple-touch-icon" sizes="180x180" href="{{ url('favicons/apple-touch-icon.png') }}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ url('favicons/favicon-32x32.png') }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ url('favicons/favicon-16x16.png') }}">
  <link rel="manifest" href="{{ url('favicons/manifest.json') }}">
  <link rel="mask-icon" color="#f1b53c" href="{{ url('favicons/safari-pinned-tab.svg') }}">
  <meta name="theme-color" content="#ffffff">

  <!-- SEO: If your mobile URL is different from the desktop URL, add a canonical link to the desktop page https://developers.google.com/webmasters/smartphone-sites/feature-phones -->
  <!--
  <link rel="canonical" href="http://www.example.com/">
  -->

  @stack("post-meta")

  @stack("pre-css")

  @stack('fonts')
    <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet">
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    {!! font_link_tags() !!}
  @show

  @stack("css")
    <link rel="preload" href="{{ theme('assets/static/js/vendor.min.js') }}" as="script">
    <link rel="preload" href="{{ theme('assets/static/js/app.min.js') }}" as="script">
    <link rel="preload" href="{{ theme('assets/static/css/app.min.css') }}" as="style">
    <link rel="preload" href="{{ theme('assets/js/manifest.min.js') }}" as="script">

    <link rel="stylesheet" href="{{ theme('dist/static/css/app.min.css') }}">
  @show
</head>
<body>
