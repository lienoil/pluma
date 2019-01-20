@extends('Theme::layouts.admin')

@section('page:title', __('Preferences'))

@section('page:content')
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <form class="card" action="{{ route('settings.store') }}" method="POST">
          @csrf
          <input type="hidden" name="user_id" value="{{ user()->getKey() }}">
          <div class="card-body">
            <h6 class="form-label text-uppercase text-muted mb-4">{{ __('Account') }}</h1>

            @field('input', ['name' => 'date_format', 'value' => settings('date_format'), 'label' => __('Global Date Format')])

            @field('input', ['name' => 'items_per_page', 'type' => 'number', 'value' => settings('items_per_page'), 'label' => __('Items per Page')])

            <p class="form-label">{{ __('Grid Display') }}</p>
            @field('checkbox', ['name' => 'center_main_content', 'label' => __('Center the main content when possible.'), 'checked' => settings('center_main_content'), 'value' => settings('center_main_content', false)])
          </div>
          <div class="card-footer d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
