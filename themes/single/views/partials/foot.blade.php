  @stack('pre-foot')
  @stack('foot')

  <script>!function(){"use strict";var o=Boolean("localhost"===window.location.hostname||"[::1]"===window.location.hostname||window.location.hostname.match(/^127(?:\.(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)){3}$/));window.addEventListener("load",function(){"serviceWorker"in navigator&&("https:"===window.location.protocol||o)&&navigator.serviceWorker.register("../../dist/service-worker.js").then(function(o){o.onupdatefound=function(){if(navigator.serviceWorker.controller){var n=o.installing;n.onstatechange=function(){switch(n.state){case"installed":break;case"redundant":throw new Error("The installing service worker became redundant.")}}}}}).catch(function(o){console.error("Error during service worker registration:",o)})})}();</script>
  <script type="text/javascript" src="{{ theme('dist/static/js/manifest.min.js') }}"></script>
  <script type="text/javascript" src="{{ theme('dist/static/js/vendor.min.js') }}"></script>
  <script type="text/javascript" src="{{ theme('dist/static/js/app.min.js').'?v='.date('Ymd') }}"></script>

  @stack('post-foot')
</body>
</html>
