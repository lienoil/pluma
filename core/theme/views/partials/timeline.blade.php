<ul class="timeline">
  @foreach ($activities as $i => $activity)
    <li class="timeline-item">
      <div class="timeline-badge text-orange"></div>
      <div class="pl-2 list-inline list-inline-dots">
        <span class="list-inline-item">{{ $activity->logged }}</span>
        <small class="timeline-time">{{ $activity->created }}</small>
      </div>
    </li>
  @endforeach
</ul>
