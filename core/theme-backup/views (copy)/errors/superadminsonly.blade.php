@if (user() && user()->isSuperAdmin())
  <p class="page-title mt-5">{{ __('Psst! Hey!') }}</p>
  <p>{{ __("I see you're signed in as ".user()->displayrole." - which is, like, super awesome!") }}</p>
  <p>{{ __("Here's some additional info just for you:") }}</p>
  <pre><code class="php">{{ var_dump($error) }}</code></pre>
  <p><small>{{ __('Other non-superadmins will not see this message.') }}</small></p>
@endif
