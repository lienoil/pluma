<!DOCTYPE html>
<html lang="{{ app()->getLocale() ?? 'en' }}">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>
    @section("head-title")
      {{ $application->site->fulltitle }}
    @show
  </title>
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

  @stack("seo")
    <!-- SEO: If your mobile URL is different from the desktop URL, add a canonical link to the desktop page https://developers.google.com/webmasters/smartphone-sites/feature-phones -->
    <!--
    <link rel="canonical" href="{{ home() }}">
    -->
  @show

  @stack("post-meta")

  @stack('fonts')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Palanquin:400,600,700|Raleway:400,700,900|Roboto:300,400,500,700|Material+Icons&style=twotone">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    {!! font_link_tags() !!}
  @show

  @stack("pre-css")
    <link rel="preload" href="{{ theme('dist/static/css/app.min.css') }}" as="style">
    <link rel="preload" href="{{ theme('dist/static/js/app.min.js') }}" as="script">
    <link rel="preload" href="{{ theme('dist/static/js/manifest.min.js') }}" as="script">
    <link rel="preload" href="{{ theme('dist/static/js/vendor.min.js') }}" as="script">
  @show

  @stack("css")
    <link rel="stylesheet" href="{{ theme('dist/static/css/app.min.css') }}">
  @show
</head>
<body>
