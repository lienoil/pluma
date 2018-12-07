<div class="form-group">
  <span class="form-label">{{ __($label ?? ucfirst($name)) }}</span>
  <input type="hidden" name="{{ $name ?? 'editor' }}" value="{{ $value ?? old($name ?? 'editor') }}">
  <div class="editor" data-editor="{{ json_encode($options ?? []) }}" data-target="[name={{ $name ?? 'editor' }}]"></div>
  @include('Theme::errors.span', ['field' => $field ?? $name])
</div>
