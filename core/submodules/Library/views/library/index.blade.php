@extends('Theme::layouts.admin')

@section('head:title', __('Library'))
@section('main:title', '')

@section('page:content')
  <div class="container-fluid">
    <form action="#" method="POST">
      {{-- {{ csrf_field() }} --}}
      <div data-sticky="#page-header"></div>
      <nav id="page-header" data-sticky-class="sticky bg-workspace shadow-sm" class="navbar row px-3">
        <h1 class="page-title">{{ __('Library') }}</h1>
        <button type="submit" class="btn btn-primary btn-lg"><i class="fe fe-upload"></i> {{ __('Upload') }}</button>
      </nav>
    </form>
  </div>

@endsection
