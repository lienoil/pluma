  @include('Theme::partials.footer')

  <!-- start section#before:js -->
  @stack('before:js')
  <!-- end section#before:js -->

  <!-- start section#js -->
  @stack('js')
    <script src="{{ theme('dist/js/vendor.js') }}?v={{ app()->environment() === 'development' ? date('hi') : $application->version }}"></script>
    <script src="{{ theme('dist/js/app.js') }}?v={{ app()->environment() === 'development' ? date('hi') : $application->version }}"></script>
  @show
  <!-- end section#js -->

  <!-- start section#after:js -->
  @stack('after:js')
  <!-- end section#after:js -->
</body>
</html>
