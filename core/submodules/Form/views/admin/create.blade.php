@extends('Theme::layouts.admin')

@push('after:css')
  <link rel="stylesheet" href="{{ theme('dist/form.min.css') }}">
  <script src="{{ theme('dist/form.min.js') }}"></script>
@endpush

@section('page:content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">

        <div data-form-builder='{"fields":["textarea","input"]}'>
          <div class="sd">d</div>
        </div>

      </div>
    </div>
  </div>
@endsection
