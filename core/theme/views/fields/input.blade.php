<div class="form-group {{ $group ?? null }}">
  @if (isset($label) && $label)
    <label for="{{ $name }}" class="form-label">{{ __($label ?? ucfirst($name)) }}</label>
  @endif
  <div class="{{ isset($icon) ? 'input-icon' : null }} {{ isset($prepend) ? 'input-group' : null }}">

    @isset ($icon)
      <span class="input-icon-addon">
        <i class="{{ $icon }}"></i>
      </span>
    @endisset

    @isset ($prepend)
      <span class="input-group-prepend">
        <span class="input-group-text">{{ $prepend }}</span>
      </span>
    @endisset

    <input id="{{ $name }}" {{ $attr ?? '' }} type="{{ $type ?? 'text' }}" name="{{ $name }}" class="form-control {{ $class ?? null }} {{ $errors->has($field ?? $name) ? 'is-invalid' : '' }}" value="{{ $value ?? old($name) }}" placeholder="{{ $placeholder ?? null }}">

  </div>

  @if ((($type ?? 'text') !== 'hidden'))

    @isset ($hint)
      @if (! $errors->has($field ?? $name))
        @include('Theme::fields.hint', ['text' => $hint])
      @endif
    @endisset
    @include('Theme::errors.span', ['field' => $field ?? $name])

  @endif
</div>
