<!DOCTYPE html>
<html lang="en">
<head>
    @stack("pre-meta")
    @stack("meta")
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Add to homescreen for Chrome on Android -->
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="icon" sizes="192x192" href="images/android-desktop.png">

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
    <title>
        @section("head-title"){{ isset($application) && isset($application->head->title) ? __($application->head->title ): '' }}@show
        @section("head-subtitle"){{ isset($application) && isset($application->head->subtitle) ? __($application->head->subtitle) : '' }}@show
    </title>
    <meta name="description" content="{{ __(@$application->head->description) }}">
    @stack("post-meta")

    @stack("pre-css")

    @stack('fonts')
        <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        {!! font_link_tags() !!}
    @show

    {{-- Main CSS --}}
    <link rel=preload href="{{ assets('test/dist/static/js/vendor.js') }}" as=script>
    <link rel=preload href="{{ assets('test/dist/static/js/app.js') }}" as=script>
    <link rel=preload href="{{ assets('test/dist/static/css/app.css') }}" as=style>
    <link rel=preload href="{{ assets('test/dist/static/js/manifest.js') }}" as=script>
</head>
<body>


<!DOCTYPE html>
<html lang=en>
<head>
    <meta charset=utf-8>
    <meta http-equiv=X-UA-Compatible content="IE=edge">
    <meta name=viewport content="width=device-width,initial-scale=1">
    <title>{{ $application->site->title }}</title>
    <link rel=icon type=image/png sizes=32x32 href="{{ assets('test/dist/static/img/icons/favicon-32x32.png') }}">
    <link rel=icon type=image/png sizes=16x16 href="{{ assets('test/dist/static/img/icons/favicon-16x16.png') }}">
    <!--[if IE]>
    <link rel="shortcut icon" href="/static/img/icons/favicon.ico">
    <![endif]-->
    <link rel=manifest href="{{ assets('test/dist/statics/manifest.json') }}">
    <meta name=theme-color content=#4DBA87>
    <meta name=apple-mobile-web-app-capable content=yes>
    <meta name=apple-mobile-web-app-status-bar-style content=black>
    <meta name=apple-mobile-web-app-title content=vue>
    <link rel=apple-touch-icon href=/static/img/icons/apple-touch-icon-152x152.png>
    <link rel=mask-icon href=/static/img/icons/safari-pinned-tab.svg color=#4DBA87>
    <meta name=msapplication-TileImage content=/static/img/icons/msapplication-icon-144x144.png>
    <meta name=msapplication-TileColor content=#000000>



    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons" rel=stylesheet>
    <link href="{{ assets('test/dist/static/css/app.css') }}" rel=stylesheet>
</head>
<body>
    <noscript>This is your fallback content in case JavaScript fails to load.</noscript>

    <div id=app></div>

    <script>!function(){"use strict";var o=Boolean("localhost"===window.location.hostname||"[::1]"===window.location.hostname||window.location.hostname.match(/^127(?:\.(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)){3}$/));window.addEventListener("load",function(){"serviceWorker"in navigator&&("https:"===window.location.protocol||o)&&navigator.serviceWorker.register("service-worker.js").then(function(o){o.onupdatefound=function(){if(navigator.serviceWorker.controller){var n=o.installing;n.onstatechange=function(){switch(n.state){case"installed":break;case"redundant":throw new Error("The installing service worker became redundant.")}}}}}).catch(function(o){console.error("Error during service worker registration:",o)})})}();</script>

    <script type=text/javascript src="{{ assets('test/dist/static/js/manifest.js') }}">
    </script>
    <script type=text/javascript src="{{ assets('test/dist/static/js/vendor.js') }}">
    </script>
    <script type=text/javascript src="{{ assets('test/dist/static/js/app.js') }}">
    </script>
</body>
</html>
