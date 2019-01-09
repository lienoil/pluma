<div class="card card-aside mb-3">
  <a href="{{ route('profile.show', user()->username) }}" class="card-aside-column" style="background-image: url({{ user()->photo }});background-size: contain;"></a>
  <div class="card-body d-flex flex-column">
    <h4><a href="{{ route('profile.show', user()->username) }}">{{ user()->displayname }}</a></h4>
    <div class="text-muted">{{ user()->bio }}</div>
    <div>
      <div class="text-muted"><i class="mdi mdi-at">&nbsp;</i>{{ user()->username }}</div>
      <div class="text-muted"><i class="mdi mdi-email-outline">&nbsp;</i>{{ user()->email }}</div>
    </div>
  </div>
</div>
