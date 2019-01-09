<div class="form-group">
  @isset ($label)
    <label role="button" for="{{ $name }}" class="form-label">{{ __($label ?? ucfirst($name)) }}</label>
  @endisset
  <div class="custom-control custom-checkbox">
    <input
      id="{{ $name }}"
      {{ $attr ?? '' }}
      type="{{ $type ?? 'checkbox' }}"
      name="{{ $name }}"
      class="custom-control-input {{ $errors->has($name) ? 'is-invalid' : '' }}"
      {{ (($checked ?? false) == $value) ? 'checked=checked' : null }}
      value="{{ $value ?? old($name) }}"
      >
    <label role="button" for="{{ $name }}" class="custom-control-label">{{ __($text ?? $label ?? ucfirst($name)) }}</label>
  </div>
  @isset ($hint)
    @if (! $errors->has($field ?? $name))
      @include('Theme::fields.hint', ['text' => $hint])
    @endif
  @endisset
  @include('Theme::errors.span', ['field' => $field ?? $name])
</div>
