@extends('Theme::layouts.settings')

@section('form:title', __('Displaying Data'))

@section('form:content')
  <h6 class="form-label text-uppercase text-muted mb-4">{{ __('Formats') }}</h1>
  @field('input', ['name' => 'date_format', 'value' => settings('date_format'), 'label' => __('Global Date Format')])

  @field('input', ['name' => 'items_per_page', 'type' => 'number', 'value' => settings('items_per_page'), 'label' => __('Items per Page')])

  <h6 class="form-label text-uppercase text-muted mt-5 mb-4">{{ __('Grid Display') }}</h1>
  @field('checkbox', ['name' => 'center_main_content', 'text' => __('Center the main content when possible.'), 'checked' => settings('center_main_content'), 'value' => settings('center_main_content', false)])
@endsection
