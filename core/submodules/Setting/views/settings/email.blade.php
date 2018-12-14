@extends('Theme::layouts.settings')

@section('page:title', __('Branding'))
@section('form:title', __('Email Options'))

@section('form:content')
  <legend class="form-label">{{ __('Email') }}</legend>
  @field('input', ['name' => 'MAIL_FROM_NAME', 'label' => __('From name'), 'value' => settings('MAIL_FROM_NAME')])
  @field('input', ['name' => 'MAIL_FROM_ADDRESS', 'label' => __('From address'), 'value' => settings('MAIL_FROM_ADDRESS')])
  @field('input', ['name' => 'MAIL_DRIVER', 'label' => __('Driver'), 'value' => settings('MAIL_DRIVER')])
  @field('input', ['name' => 'MAIL_HOST', 'label' => __('Host'), 'value' => settings('MAIL_HOST')])
  @field('input', ['name' => 'MAIL_PORT', 'label' => __('Port'), 'value' => settings('MAIL_PORT')])
  @field('input', ['name' => 'MAIL_USERNAME', 'label' => __('Username'), 'value' => settings('MAIL_USERNAME')])
  @field('input', ['name' => 'MAIL_PASSWORD', 'label' => __('Password'), 'value' => settings('MAIL_PASSWORD'), 'type' => 'password'])
  @field('input', ['name' => 'MAIL_ENCRYPTION', 'label' => __('Encryption'), 'value' => settings('MAIL_ENCRYPTION')])
  @field('input', ['name' => 'site_title', 'label' => __('Site Title'), 'value' => settings('site_title')])

  @field('input', ['name' => 'site_tagline', 'label' => __('Site Tagline'), 'value' => settings('site_tagline')])

  @field('input', ['name' => 'site_author', 'label' => __('Site Author'), 'value' => settings('site_author')])

  @field('input', ['name' => 'site_email', 'label' => __('Site Email'), 'value' => settings('site_email')])

  @field('input', ['name' => 'site_year', 'label' => __('Year Established'), 'value' => settings('site_year')])
@endsection
