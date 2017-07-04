<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Add to homescreen for Chrome on Android -->
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="icon" sizes="192x192" href="images/android-desktop.png">

    <!-- Add to homescreen for Safari on iOS -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Material Design Lite">
    <link rel="apple-touch-icon-precomposed" href="images/ios-desktop.png">

    <!-- Tile icon for Win8 (144x144 + tile color) -->
    <meta name="msapplication-TileImage" content="images/touch/ms-touch-icon-144x144-precomposed.png">
    <meta name="msapplication-TileColor" content="#3372DF">

    <link rel="shortcut icon" href="images/favicon.png">

    <!-- SEO: If your mobile URL is different from the desktop URL, add a canonical link to the desktop page https://developers.google.com/webmasters/smartphone-sites/feature-phones -->
    <!--
    <link rel="canonical" href="http://www.example.com/">
    -->
    <title>S</title>
    <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet" type="text/css">
    <script src="https://unpkg.com/vue"></script>
    <link href="https://unpkg.com/vuetify/dist/vuetify.min.css" rel="stylesheet" type="text/css">
    <script src="https://unpkg.com/vuetify/dist/vuetify.min.js"></script>

    @stack('css')
</head>
<body>

    <div data-root-app>
        @include("Single::partials.sidebar")
        <v-toolbar></v-toolbar>
        <main>
            <v-container fluid>

            </v-container>
        </main>
        @include("Single::partials.footer")
    </div>

    <script>
        var app = new Vue({
            el: '[data-root-app]',
            data: {
                application: JSON.parse('{!! json_encode($application) !!}'),
                sidebar: JSON.parse('{!! json_encode($navigation->sidebar->collect) !!}'),
            }
        });
    </script>

    @stack('js')
</body>
</html>
