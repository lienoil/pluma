<div class="form-group {{ $group ?? $group_class ?? null }}">
  @isset ($label)
    <label for="{{ $name }}" class="form-label">{{ __($label ?? ucfirst($name)) }}</label>
  @endisset
  <textarea id="{{ $name }}" {{ $attr ?? '' }} type="{{ $type ?? 'text' }}" name="{{ $name }}" class="form-control {{ $errors->has($name) ? 'is-invalid' : '' }}">{{ $value ?? old($name) }}</textarea>
  @include('Theme::errors.span', ['field' => $field ?? $name])
</div>
