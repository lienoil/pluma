@extends("Theme::app")

@push("before-content")
  @include("Theme::partials.sidebar")
  @include("Theme::partials.utilitybar")
@endpush

@push("before-inner-content")
  @include("Theme::partials.breadcrumbs")
@endpush

@push("after-inner-content")
  @include("Theme::partials.rightsidebar")
@endpush

@push("after-content")
  @include("Theme::partials.flash")
  @include("Theme::partials.dialogbox")
  @include("Theme::partials.bottomsheet")
  @include("Theme::partials.footer")
@endpush

@push("foot")
  <script>!function(){"use strict";var o=Boolean("localhost"===window.location.hostname||"[::1]"===window.location.hostname||window.location.hostname.match(/^127(?:\.(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)){3}$/));window.addEventListener("load",function(){"serviceWorker"in navigator&&("https:"===window.location.protocol||o)&&navigator.serviceWorker.register("/../themes/dist/service-worker.js").then(function(o){o.onupdatefound=function(){if(navigator.serviceWorker.controller){var n=o.installing;n.onstatechange=function(){switch(n.state){case"installed":break;case"redundant":throw new Error("The installing service worker became redundant.")}}}}}).catch(function(o){console.error("Error during service worker registration:",o)})})}();</script>
  <script>
    window.$user = {
      token: '{{ user()->token }}',
      permission: {
        code: '{{ request()->route()->getName() }}'
      },
      isRoot: JSON.parse('{{ json_encode(user()->isRoot()) }}'),
      permissions: JSON.parse('{!! json_encode(user()->permissions->pluck('code')) !!}')
    }
  </script>
  <script type="text/javascript" src="{{ theme('dist/static/js/manifest.min.js') }}"></script>
  <script type="text/javascript" src="{{ theme('dist/static/js/vendor.min.js') }}"></script>
  <script type="text/javascript" src="{{ theme('dist/static/js/app.min.js') }}"></script>
@endpush

@push('debug.head')
  <!-- ====================================/DEBUG/==================================== -->
  <link rel="icon" type="image/png" sizes="32x32" href="http://localhost:8080/static/img/icons/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="http://localhost:8080/static/img/icons/favicon-16x16.png">
  <!--[if IE]><link rel="shortcut icon" href="http://localhost:8080//static/img/icons/favicon.ico"><![endif]-->
  <!-- Add to home screen for Android and modern mobile browsers -->
  <link rel="manifest" href="http://localhost:8080/static/manifest.json">
@endpush
