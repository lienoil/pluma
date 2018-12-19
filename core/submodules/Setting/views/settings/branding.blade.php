@extends('Theme::layouts.settings')

@section('page:title', __('Branding'))
@section('form:title', __('Site Branding'))

@section('form:content')
  <div class="row">
    <div class="col-lg-8">
      @field('input', ['name' => 'site_title', 'label' => __('Site Name'), 'value' => settings('site_title')])

      @field('input', ['name' => 'site_tagline', 'label' => __('Site Tagline/Description'), 'value' => settings('site_tagline')])

      @field('input', ['name' => 'site_author', 'label' => __('Site Author'), 'value' => settings('site_author')])

      @field('input', ['name' => 'site_email', 'label' => __('Site Email'), 'value' => settings('site_email')])

      @field('input', ['name' => 'site_year', 'label' => __('Year Established'), 'value' => settings('site_year')])
    </div>
    <div class="col-lg-4">
      <label class="form-label">{{ __('Site Logo') }}</label>
      @field('upload', [
        'dropzone' => true,
        'name' => 'site_logo',
        'label' => __('Site Logo'),
        'options' => [
          'maxFiles' => 1,
        ],
      ])
    </div>
  </div>
@endsection
