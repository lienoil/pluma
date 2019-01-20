@extends('Theme::layouts.admin')

@section('page:content')

  <div class="container-fluid">
    <div class="row">
      <div class="col-4">

        @field('datepicker', ['name' => 'date'])
        @field('timepicker', ['name' => 'time'])
        @field('daterangepicker', ['name' => 'daterange'])

      </div>
    </div>
  </div>

@endsection
