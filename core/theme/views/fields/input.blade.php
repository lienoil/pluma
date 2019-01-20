<div class="form-group {{ $group ?? $group_class ?? null }}">
  @if (isset($label) && $label)
    <label for="{{ $name }}" class="form-label">{{ __($label ?? ucfirst($name)) }}</label>
  @endif
  <div class="{{ $input_class ?? null }} {{ isset($icon) ? 'input-icon' : null }} {{ isset($prepend) || isset($append) || isset($dropdown) ? 'input-group' : null }}">

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

    @isset ($append)
      <span class="input-group-append">
        <span class="input-group-text">{{ $append }}</span>
      </span>
    @elseif (isset($dropdown))
      <span class="input-group-append">
        <span class="input-group-text">
          <span class="dropdown">
            <span data-toggle="dropdown" aria-expanded="false"><i class="{{ $dropdown }}"></i></span>
            <div class="dropdown-menu mt-2 dropdown-menu-right dropdown-menu-arrow">
              <div class="p-3 text-muted text-center">
                <i class="mdi mdi-calendar display-4"></i>
                <div>Calendar</div>
              </div>
            </div>
          </span>
        </span>
      </span>
    @endisset

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
