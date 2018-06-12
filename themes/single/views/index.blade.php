<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Single</title>
    <link rel="icon" type="image/png" sizes="32x32" href="<%= htmlWebpackPlugin.files.publicPath %>static/img/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<%= htmlWebpackPlugin.files.publicPath %>static/img/icons/favicon-16x16.png">
    <!--[if IE]><link rel="shortcut icon" href="<%= htmlWebpackPlugin.files.publicPath %>/static/img/icons/favicon.ico"><![endif]-->
    <!-- Add to home screen for Android and modern mobile browsers -->
    <link rel="manifest" href="<%= htmlWebpackPlugin.files.publicPath %>static/manifest.json">
    <meta name="theme-color" content="<%= htmlWebpackPlugin.$primary %>">

    <!-- Add to home screen for Safari on iOS -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Single">
    <link rel="apple-touch-icon" href="<%= htmlWebpackPlugin.files.publicPath %>static/img/icons/apple-touch-icon-152x152.png">
    <link rel="mask-icon" href="<%= htmlWebpackPlugin.files.publicPath %>static/img/icons/safari-pinned-tab.svg" color="#4DBA87">
    <!-- Add to home screen for Windows -->
    <meta name="msapplication-TileImage" content="<%= htmlWebpackPlugin.files.publicPath %>static/img/icons/msapplication-icon-144x144.png">
    <meta name="msapplication-TileColor" content="#000000">
    <% for (var chunk of webpack.chunks) {
        for (var file of chunk.files) {
          if (file.match(/\.(js|css)$/)) { %>
    <link rel="<%= chunk.initial?'preload':'prefetch' %>" href="<%= htmlWebpackPlugin.files.publicPath + file %>" as="<%= file.match(/\.css$/)?'style':'script' %>"><% }}} %>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Palanquin:400,600,700|Raleway:400,700,900|Roboto:300,400,500,700|Material+Icons&style=twotone">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  </head>
  <body>
    <noscript>
      This is your fallback content in case JavaScript fails to load.
    </noscript>

    <div id="app" v-cloak></div>

    <!-- Todo: only include in production -->
    <%= htmlWebpackPlugin.options.serviceWorkerLoader %>
    <!-- built files will be auto injected -->
  </body>
</html>
