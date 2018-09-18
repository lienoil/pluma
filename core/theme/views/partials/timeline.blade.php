<ul class="timeline">
  @foreach ($activities as $activity)
    <li class="timeline-item">
      <div class="timeline-badge bg-primary"></div>
      <div>
        <em>{{ $activity->subject }}</em>
        <div class="d-block text-muted">{{ $activity->ip_address }} * Home</div>
        <small class="d-block text-muted">{{ $activity->agent }}</small>
      </div>
      <div class="timeline-time"><em class="small">{{ __($activity->created) }}</em></div>
    </li>
  @endforeach
</ul>
