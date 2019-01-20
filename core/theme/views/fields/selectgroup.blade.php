@php
  $key = $key ?? $id ?? 'id';
  $text = $text ?? 'text';
  $subitems = $subitems ?? 'subitems';
  $subkey = $key ?? $id ?? 'id';
  $subtext = $subtext ?? 'text';
  $isMultiple = str_contains($name, '[]');
@endphp

<div class="form-group">
  <label for="{{ $name }}" class="form-label">{{ __($label ?? ucfirst($name)) }}</label>
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
    <select id="{{ $name }}" {{ $attr ?? '' }} {{ $isMultiple ? 'multiple' : null }} name="{{ $name ?? 'selection' }}" title="{{ $title ?? $label ?? null }}" class="form-control {{ isset($errors) && $errors->has($field ?? $name) ? 'is-invalid' : '' }}" aria-describedby="{{ $name }}">
      @foreach ($items ?? [] as $item)
        <optgroup label="{{ $item->{$text} }}">
          @foreach ($item->{$subitems} ?? [] as $subitem)

            @if ($isMultiple)
              <option data-tokens="{{ $item->{$text} }} {{ $subitem->{$subtext} }}" {{ (in_array($subitem->{$subkey}, $value ?? $old ?? old($name) ?? []) ? 'selected="selected"' : null) }} value="{{ $subitem->{$subkey} }}">{{ $subitem->{$subtext} }}</option>
            @else
              <option data-tokens="{{ $item->{$text} }} {{ $subitem->{$subtext} }}" {{ ($subitem->{$subkey} === ($old ?? old($name)) ? 'selected="selected"' : null) }} value="{{ $subitem->{$subkey} }}">{{ $subitem->{$subtext} }}</option>
            @endif

          @endforeach
        </optgroup>
      @endforeach
    </select>
  </div>

  @isset ($hint)
    @if (isset($errors) && ! $errors->has($field ?? $name))
      @include('Theme::fields.hint', ['text' => $hint])
    @endif
  @endisset
  @include('Theme::errors.span', ['field' => $field ?? $name])
</div>
