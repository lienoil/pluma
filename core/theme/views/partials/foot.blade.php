  @include('Theme::partials.footer')

  @stack("pre-js")

  @stack("js")
    <script src="{{ theme('dist/app.min.js') }}"></script>
  @show

  @stack("post-js")
</body>
</html>
