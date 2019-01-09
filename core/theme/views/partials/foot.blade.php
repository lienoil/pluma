  @include('Theme::partials.footer')

  <!-- start section#before:js -->
  @stack('before:js')
  <!-- end section#before:js -->

  <!-- start section#js -->
  @push('js')
    <script src="{{ theme('dist/vendor.min.js') }}?v={{ app()->environment() === 'development' ? date('hi') : $application->version }}"></script>
    <script src="{{ theme('dist/app.min.js') }}?v={{ app()->environment() === 'development' ? date('hi') : $application->version }}"></script>
  @show
  <!-- end section#js -->

  <!-- start section#after:js -->
  @stack('after:js')
  <!-- end section#after:js -->
</body>
</html>
