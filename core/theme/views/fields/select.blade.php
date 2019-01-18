@php
  $key = $key ?? $id ?? 'id';
  $text = $text ?? 'text';
  $isMultiple = str_contains($name, '[]');
@endphp

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
        <span class="input-group-text">{{ __($prepend) }}</span>
      </span>
    @endisset

    <select id="{{ $name }}" {{ $attr ?? '' }} {{ $isMultiple ? 'multiple' : null }} name="{{ $name ?? 'selection' }}" title="{{ $title ?? $label ?? null }}" class="form-control {{ $errors->has($field ?? $name) ? 'is-invalid' : '' }}" aria-describedby="{{ $name }}">
      @foreach ($items as $item)

        @if ($isMultiple)
          <option {{ (in_array($item->{$key}, $value ?? $old ?? old($name) ?? []) ? 'selected="selected"' : null) }} value="{{ $item->{$key} }}">{{ $item->{$text} }}</option>
        @else
          <option {{ ($item->{$key} === ($old ?? old($name)) ? 'selected="selected"' : null) }} value="{{ $item->{$key} }}">{{ $item->{$text} }}</option>
        @endif

      @endforeach
    </select>
  </div>

  @isset ($hint)
    @if (! $errors->has($field ?? $name))
      @include('Theme::fields.hint', ['text' => $hint])
    @endif
  @endisset
  @include('Theme::errors.span', ['field' => $field ?? $name])
</div>
