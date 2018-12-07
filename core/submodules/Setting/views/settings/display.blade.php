@extends('Theme::layouts.settings')

@section('form:content')
  <div class="card">
    <div class="card-header">
      <legend class="card-title">{{ __('Displaying Data') }}</legend>
    </div>
    <div class="card-body">

      @field('input', ['name' => 'date_format', 'value' => settings('date_format'), 'label' => __('Global Date Format')])

      @field('input', ['name' => 'items_per_page', 'type' => 'number', 'value' => settings('items_per_page'), 'label' => __('Items per Page')])

    </div>

    <div class="card-footer d-flex justify-content-end">
      @submit('Save')
    </div>
  </div>
@endsection
