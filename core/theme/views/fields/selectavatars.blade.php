<div class="form-group {{ $group ?? $group_class ?? null }}">
  <label for="{{ $id ?? $name.'-select' }}" class="form-label">{{ __($label ?? ucfirst($name)) }}</label>
  <div class="d-block mb-4">
    <img id="{{ $id ?? $name.'-preview' }}" class="rounded" src="{{ $value ?? old($name ?? 'avatar') }}" data-src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mP8Xw8AAoMBgDTD2qgAAAAASUVORK5CYII=">
  </div>
  <select id="{{ $id ?? $name.'-select' }}" data-avatar-preview-target="#{{ $id ?? $name.'-preview' }}" {{ $attr ?? '' }} title="{{ $title ?? __('Icon') }}" name="{{ $name ?? 'avatar' }}" class="form-control {{ $class ?? '' }}">
    <optgroup label="{{ __('Avatars') }}">
      @foreach (config('avatar.avatars') as $avatar)
        <option {{ isset($value) ? ($value === assets($avatar['url']) ? 'selected="selected"' : '') : '' }} value="{{ assets($avatar['url']) }}" data-content="<img src='{{ assets($avatar['thumbnail']) }}' width='25' height='25'><span class='ml-3'>{{ __($avatar['text']) }}</span>">{{ __($avatar['text']) }}</option>
      @endforeach
    </optgroup>
  </select>

  @if ((($type ?? 'text') !== 'hidden'))
    @isset ($hint)
      @if (! $errors->has($field ?? $name ?? 'avatar'))
        @include('Theme::fields.hint', ['text' => $hint])
      @endif
    @endisset
    @include('Theme::errors.span', ['field' => $field ?? $name ?? 'avatar'])
  @endif
</div>
