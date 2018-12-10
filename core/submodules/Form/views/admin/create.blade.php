@extends('Theme::layouts.admin')

@push('after:css')
  <script src="{{ theme('dist/form.min.js') }}"></script>
@endpush

@section('page:content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">

        <div data-form-builder='{}'>
          <div class="sd">d</div>
        </div>

      </div>
    </div>
  </div>
@endsection
