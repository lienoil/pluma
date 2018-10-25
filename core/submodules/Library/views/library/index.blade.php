@extends('Theme::layouts.admin')

@section('page:content')
  <div class="container-fluid">
    <form action="#" method="POST">
      {{ csrf_field() }}
      <div data-sticky="#page-header"></div>
      <nav id="page-header" data-sticky-class="sticky bg-workspace shadow-sm" class="navbar row px-3">
        {{-- <h1 class="page-title">{{ __('Library') }}</h1> --}}
        <button type="submit" class="btn btn-primary btn-lg"><i class="fe fe-upload"></i> {{ __('Upload') }}</button>
      </nav>
    </form>
    <div class="row">
      <div class="col-lg col-sm-3">
        <div class="card">
          <img class="card-img-top" src="https://lorempixel.com/300/200/?82197" alt="placeholder">
          <div class="card-body">
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
          </div>
        </div>
      </div>
      <div class="col-lg col-sm-3">
        <div class="card">
          <img class="card-img-top" src="https://lorempixel.com/300/200/?79128" alt="placeholder">
          <div class="card-body">
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
          </div>
        </div>
      </div>
      <div class="col-lg col-sm-3">
        <div class="card">
          <img class="card-img-top" src="https://lorempixel.com/300/200/?12897" alt="placeholder">
          <div class="card-body">
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
          </div>
        </div>
      </div>
      <div class="col-lg col-sm-3">
        <div class="card">
          <img class="card-img-top" src="https://lorempixel.com/300/200/?89217" alt="placeholder">
          <div class="card-body">
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
