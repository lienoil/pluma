@extends('Theme::layouts.settings')

@section('page:title', __('Branding'))
@section('form:title', __('Site Branding'))

@section('form:content')
  @field('input', ['name' => 'site_title', 'label' => __('Site Title'), 'value' => settings('site_title')])

  @field('input', ['name' => 'site_tagline', 'label' => __('Site Tagline'), 'value' => settings('site_tagline')])

  @field('input', ['name' => 'site_author', 'label' => __('Site Author'), 'value' => settings('site_author')])

  @field('input', ['name' => 'site_email', 'label' => __('Site Email'), 'value' => settings('site_email')])

  @field('input', ['name' => 'site_year', 'label' => __('Year Established'), 'value' => settings('site_year')])
@endsection
