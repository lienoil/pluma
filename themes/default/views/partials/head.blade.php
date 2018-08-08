<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>
    @section("head-title")
      {{ $application->site->title }} | {{ $application->site->tagline }}
    @show
    @stack("head-subtitle")
  </title>
  <meta name="description" content="{{ __(@$application->head->description) }}">

  <!-- Add to homescreen for Chrome on Android -->
  <meta name="mobile-web-app-capable" content="yes">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="_token" content="{{ csrf_token() }}">
  <meta name="base-url" content="{{ home() }}">

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
    <!-- Display the fonts specified in config/fonts.php  -->
    {!! font_link_tags(config('stylesheets')) !!}
  @show

  @stack("pre-css")
    <link rel="preload" href="{{ theme('css/style.css') }}" as="style">
  @show

  @stack("css")
    <link rel="stylesheet" href="{{ theme('css/style.css') }}">
  @show
</head>
<body>
