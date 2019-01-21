<div class="form-group {{ $group ?? $group_class ?? null }}">
  @isset ($label)
    <label for="selecticon-{{ $name }}" class="form-label">{{ $label }}</label>
  @endisset
  <select id="selecticon-{{ $name }}" {{ $attr ?? '' }} title="{{ __('Icon') }}" name="{{ $name ?? 'details[#][icon]' }}" class="form-control">
    <optgroup label="{{ __('Editor') }}">
      <option {{ isset($value) ? ($value === 'mdi mdi-pen' ? 'selected="selected"' : '') : '' }} value="mdi mdi-pen" data-icon="mdi mdi-pen">{{ __('Pen') }}</option>
    </optgroup>
    <optgroup label="{{ __('Files') }}">
      <option {{ isset($value) ? ($value === 'mdi mdi-file-excel' ? 'selected="selected"' : '') : '' }} value="mdi mdi-file-excel" data-icon="mdi mdi-file-excel">{{ __('MS Excel') }}</option>
      <option {{ isset($value) ? ($value === 'mdi mdi-google-spreadsheet' ? 'selected="selected"' : '') : '' }} value="mdi mdi-google-spreadsheet" data-icon="mdi mdi-google-spreadsheet">{{ __('Google Spreadsheet') }}</option>
    </optgroup>
    <optgroup label="{{ __('Misc') }}">
      <option {{ isset($value) ? ($value === 'mdi mdi-heart-pulse' ? 'selected="selected"' : '') : '' }} value="mdi mdi-heart-pulse" data-icon="mdi mdi-heart-pulse">{{ __('Activity') }}</option>
      <option {{ isset($value) ? ($value === 'mdi mdi-star-outline' ? 'selected="selected"' : '') : '' }} value="mdi mdi-star-outline" data-icon="mdi mdi-star-outline">{{ __('Star') }}</option>
      <option {{ isset($value) ? ($value === 'mdi mdi-cellphone-android' ? 'selected="selected"' : '') : '' }} value="mdi mdi-cellphone-android" data-icon="mdi mdi-cellphone-android">{{ __('Mobile Phone') }}</option>
      <option {{ isset($value) ? ($value === 'mdi mdi-phone' ? 'selected="selected"' : '') : '' }} value="mdi mdi-phone" data-icon="mdi mdi-phone">{{ __('Phone') }}</option>
      <option {{ isset($value) ? ($value === 'mdi mdi-cake' ? 'selected="selected"' : '') : '' }} value="mdi mdi-cake" data-icon="mdi mdi-cake">{{ __('Birthday') }}</option>
      <option {{ isset($value) ? ($value === 'mdi mdi-map-marker' ? 'selected="selected"' : '') : '' }} value="mdi mdi-map-marker" data-icon="mdi mdi-map-marker">{{ __('Map Pin') }}</option>
      <option {{ isset($value) ? ($value === 'mdi mdi-heart' ? 'selected="selected"' : '') : '' }} value="mdi mdi-heart" data-icon="mdi mdi-heart">{{ __('Heart') }}</option>
    </optgroup>
    <optgroup label="{{ __('Social') }}">
      <option {{ isset($value) ? ($value === 'mdi mdi-github-circle' ? 'selected="selected"' : '') : '' }} value="mdi mdi-github-circle" data-icon="mdi mdi-github-circle">{{ __('Github') }}</option>
      <option {{ isset($value) ? ($value === 'mdi mdi-instagram' ? 'selected="selected"' : '') : '' }} value="mdi mdi-instagram" data-icon="mdi mdi-instagram">{{ __('Instagram') }}</option>
      <option {{ isset($value) ? ($value === 'mdi mdi-facebook' ? 'selected="selected"' : '') : '' }} value="mdi mdi-facebook" data-icon="mdi mdi-facebook">{{ __('Facebook') }}</option>
      <option {{ isset($value) ? ($value === 'mdi mdi-twitter' ? 'selected="selected"' : '') : '' }} value="mdi mdi-twitter" data-icon="mdi mdi-twitter">{{ __('Twitter') }}</option>
      <option {{ isset($value) ? ($value === 'mdi mdi-linkedin' ? 'selected="selected"' : '') : '' }} value="mdi mdi-linkedin" data-icon="mdi mdi-linkedin">{{ __('Linkedin') }}</option>
      <option {{ isset($value) ? ($value === 'mdi mdi-slack' ? 'selected="selected"' : '') : '' }} value="mdi mdi-slack" data-icon="mdi mdi-slack">{{ __('Slack') }}</option>
    </optgroup>
  </select>
</div>
