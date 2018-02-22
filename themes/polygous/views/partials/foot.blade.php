  @stack('pre-foot')
  @stack('foot')

  <script type="text/javascript" src="{{ theme('assets/js/app.js').(config("debugging.debug")?'?t='.date('ymdhis'):'') }}"></script>

  @stack('post-foot')
</body>
</html>
