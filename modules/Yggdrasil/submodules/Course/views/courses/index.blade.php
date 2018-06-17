@extends("Theme::layouts.admin")

@section("content")
  @foreach ($resources as $course)
    {{ $course->title }}<br>
  @endforeach
@endsection
