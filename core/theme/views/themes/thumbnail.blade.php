<div class="card border-0 m-0">
  <div class="card-body">
    <h3 class="card-title">{{ $item->name }}</h3>
    <div class="card-text">
      <blockquote class="text-muted">
        <div>{{ __('Simplicity is the ultimate sophistication.') }}</div>
        <cite>{{ __('Leonardo da Vinci') }}</cite>
      </blockquote>
      {!! $item->description !!}
    </div>
  </div>
</div>

