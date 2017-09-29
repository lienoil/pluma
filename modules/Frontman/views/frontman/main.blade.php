<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $application->site->title }}</title>
    <!-- Add to homescreen for Chrome on Android -->
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="icon" sizes="192x192" href="images/android-desktop.png">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="_token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Material Design Lite">
    <link rel="apple-touch-icon-precomposed" href="images/ios-desktop.png">
    <meta name="msapplication-TileImage" content="images/touch/ms-touch-icon-144x144-precomposed.png">
    <meta name="msapplication-TileColor" content="#3372DF">
    <link rel="shortcut icon" href="images/favicon.png">

    <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ assets('frontman/dist/app.min.css') }}">
</head>
<body>

    <div id="app">
        <v-app standalone>

            <v-navigation-drawer enable-resize-watcher persistent overflow>
                <v-list dense>
                    <v-list-tile>
                        <v-list-tile-title>asdad</v-list-tile-title>
                    </v-list-tile>
                </v-list>
            </v-navigation-drawer>

            <main data-main>
                @yield("content")
            </main>

            @section("post-container")
                @include("Theme::partials.endnote")
            @show

            @yield("post-content")

        </v-app>
    </div>

    <script src="{{ assets('frontman/dist/app.min.js') }}"></script>
</body>
</html>
