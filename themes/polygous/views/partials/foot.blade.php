  @stack('pre-foot')
  @stack('foot')

  {{-- (config("debugging.debug")?'?t='.date('ymdhis'):'') --}}
  <script type="text/javascript" src="{{ theme('assets/js/app.js') }}"></script>

  @stack('post-foot')
</body>
</html>
