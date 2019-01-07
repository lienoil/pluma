@if (user() && user()->isSuperAdmin())
  <div id="accordion">
    <div class="mt-4">
      <a href="#" data-toggle="collapse" data-target="#debug-message-body" aria-expanded="false" aria-controls="debug-message-body">{{ __('Psst, Hey!') }}&nbsp;<i class="mdi mdi-plus small"></i></a>

      <div id="debug-message-body" class="collapse" aria-labelledby="debug-message-header" data-parent="#accordion">
        <p>{{ __("I see you're signed in as ".user()->displayrole." - which is, like, super awesome!") }}</p>
        <p>{{ __("Here's some additional info just for you:") }}</p>
        <pre><code class="php">{{ var_dump($error) }}</code></pre>
        <p><small>{{ __('Other non-superadmins will not see this message.') }}</small></p>
      </div>
    </div>
  </div>
@endif
