<sidebar
  logo="{{ $application->site->logo }}"
  tagline="{{ $application->site->tagline }}"
  title="{{ $application->site->title }}"
  :items="{{ json_encode($sidebar) }}"
  >
</sidebar>
