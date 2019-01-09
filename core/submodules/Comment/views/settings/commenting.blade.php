@extends('Theme::layouts.settings')

@section('form:title', __('Commenting'))

@section('form:content')
  <input type="hidden" name="user_id" value="{{ user()->getKey() }}">
  To do
@endsection
