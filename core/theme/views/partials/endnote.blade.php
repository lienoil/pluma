<footer class="footer bg-transparent border-0 text-muted mt-6">
  @stack('before-endnote')
  @section('endnote')
    <div class="container p-3">
      <div class="row align-items-center flex-row-reverse">
          {{ $application->site->title }}
          {{ $application->version }}
      </div>
    </div>
  @show
  @stack('after-endnote')
</footer>
